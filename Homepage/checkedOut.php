<?php
ob_start();
// Start a session and include your database connection file
session_start();
include "../include/DBconn.php";

// Include TCPDF and AWS SDK for PHP
require_once('../libs/tcpdf/tcpdf.php');
require '../libs/tcpdf/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '..\vendor\phpmailer\phpmailer\src\Exception.php';
require '..\vendor\phpmailer\phpmailer\src\PHPMailer.php';
require '..\vendor\phpmailer\phpmailer\src\SMTP.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user ID from the session
    $userId = $_SESSION['id'];
    $selectedProducts = $_POST['selectedProducts'];
    $paymentMethod = $_POST['paymentMethod'];

    $conn->begin_transaction();

    try {

        
        $mail = new PHPMailer();

        $mail->isSMTP(); // using SMTP protocol       
        $mail->Mailer = "smtp";                        
        $mail->Host = 'smtp.gmail.com'; // SMTP host as gmail 
        $mail->SMTPDebug  = 2;
        $mail->SMTPAuth = true;  // enable smtp authentication                             
        $mail->Username = 'cache5834@gmail.com';  // sender gmail host              
        $mail->Password = 'jhgqzooufkitpcho'; // sender gmail host password     
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;   // port for SMTP


        // Fetch the cart_id for the current user
        $stmt = $conn->prepare("SELECT cart_id FROM cart WHERE customer_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $cart = $result->fetch_assoc();
        $cartId = $cart['cart_id'];
        $stmt->close();

        // Fetch Customer Email
        $stmt = $conn->prepare("SELECT email FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $customerEmail = $user['email'];
        $stmt->close();

        // Array to hold sellers' emails
        $sellersEmails = [];


        // Insert a new order into the orders table
        $stmt = $conn->prepare("INSERT INTO orders (user_id, payment_method, order_status) VALUES (?, ?, 'confirmed')");
        $stmt->bind_param("is", $userId, $paymentMethod);
        $stmt->execute();
        $orderId = $stmt->insert_id; // Get the ID of the newly created order
        $stmt->close();


        // Insert order details and remove products from cart
        foreach ($selectedProducts as $productId) {
            // Get the quantity from the cartitems table
            $stmt = $conn->prepare("SELECT quantity FROM cart_items WHERE product_id = ? AND cart_id = ?");
            $stmt->bind_param("ii", $productId, $cartId);
            $stmt->execute();
            $result = $stmt->get_result();
            $item = $result->fetch_assoc();
            $quantity = $item['quantity'];
            $stmt->close();

            // Get the price from the Products table
            $stmt = $conn->prepare("SELECT product_price FROM Products WHERE product_ID = ?");
            $stmt->bind_param("i", $productId);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();
            $price = $product['product_price'];
            $stmt->close();

            // Insert into orderdetails table
            $stmt = $conn->prepare("INSERT INTO orderdetails (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiid", $orderId, $productId, $quantity, $price);
            $stmt->execute();
            $stmt->close();

            // Remove the product from the cartitems table
            $stmt = $conn->prepare("DELETE FROM cart_items WHERE product_id = ? AND cart_id = ?");
            $stmt->bind_param("ii", $productId, $cartId);
            $stmt->execute();
            $stmt->close();
        }

        $products = []; // Array to hold product details
        $totalCost = 0;
        foreach ($selectedProducts as $productId) {
            // Assuming quantity and price are already fetched above
            $stmt = $conn->prepare("SELECT product_name, product_image FROM products WHERE product_ID = ?");
            $stmt->bind_param("i", $productId);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();

            // Add product details to the products array
            $products[] = [
                'name' => $product['product_name'],
                'image' => $product['product_image'],
                'quantity' => $quantity,
                'price' => $price
            ];

            $totalCost += $price * $quantity;
        }


        // If everything is successful, commit the transaction
        $conn->commit();

        // Generate PDF receipt
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Company Name');
        $pdf->SetTitle('Receipt');
        $pdf->SetSubject('Purchase Receipt');
        $pdf->AddPage();

        // Set content for the PDF
        $htmlContent = "<h1>Receipt for Your Purchase</h1>"
                     . "<p><strong>Date:</strong> " . date("Y-m-d H:i:s") . "</p>"
                     . "<p><strong>User ID:</strong> {$userId}</p>"
                     . "<p><strong>Total Cost:</strong> \${$totalCost}</p>"
                     . "<h2>Product Details:</h2>";

        foreach ($products as $product) {
            $htmlContent .= "<p><strong>Product Name:</strong> {$product['name']} - <strong>Quantity:</strong> {$product['quantity']} - <strong>Price:</strong> \${$product['price']}</p>";
        }

        $pdf->writeHTML($htmlContent, true, false, true, false, '');

        // Save the PDF to a file
        $pdfFileName = 'receipt-' . time() . '.pdf';
        $pdf->Output(__DIR__ . '/' . $pdfFileName, 'F');
        $pdfFilePath = __DIR__ . '/' . $pdfFileName;


        // AWS S3 upload
        $s3Client = new S3Client([
            'version'     => 'latest',
            'region'      => 'us-east-1', // Example: 'us-west-2'
            'credentials' => [
                'key'    => 'AKIAZ6RUNNND6TSFDNVN',
                'secret' => 'VonLqrS3SXU5bdSWuqDSllKwr/hgEzyCKElsFyf0',
            ],
        ]);

        $bucketName = 'mywebsite5601';
        $key = 'receipts/' . $pdfFileName;

        try {
            $result = $s3Client->putObject([
                'Bucket'     => $bucketName,
                'Key'        => $key,
                'SourceFile' => $pdfFileName,
                'ACL'        => 'private'
            ]);
        } catch (AwsException $e) {
            echo 'Error uploading to S3: ' . $e->getMessage();
        }

        // Attach PDF to email
$mail->addAttachment($pdfFilePath); // Attach PDF receipt

// Set sender and recipient
$mail->setFrom('your-email@example.com', 'Your Name');
$mail->addAddress($customerEmail); // Send to customer

// Fetch and add sellers' emails
foreach ($selectedProducts as $productId) {
    $stmt = $conn->prepare("SELECT s.email FROM users s JOIN products p ON s.id = p.seller_id WHERE p.product_ID = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($seller = $result->fetch_assoc()) {
        $sellerEmail = $seller['email'];
        if (!in_array($sellerEmail, $sellersEmails)) {
            $mail->addAddress($sellerEmail); // Add each seller's email
            $sellersEmails[] = $sellerEmail;
        }
    }
    $stmt->close();
}

// Email subject and body
$mail->Subject = 'Order Confirmation';
$mail->isHTML(true); // Set email format to HTML
$mail->Body = '<p>Thank you for your order. Your receipt is attached.</p>';

        // Send the email
// Send the email
if (!$mail->send()) {
    echo 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
} else {
    header("Location: toShip.php"); // Change this to the path of your success page
    exit();
}
     
    } catch (Exception $e) {
        $errorMessage = $e->getMessage();
    echo "<script>console.error('PHP Error: " . addslashes($errorMessage) . "');</script>";
    echo 'Email error: ' . $e->getMessage();
    
} 
} else {
    // The form was not submitted, redirect back to the cart page
    header("Location: mycart.php"); // Change this to the path of your cart page
    exit();
}
ob_end_flush();
?>
