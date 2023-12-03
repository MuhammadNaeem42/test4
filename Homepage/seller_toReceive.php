<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="Homepage" content="Homepage">
    <title>Seller Dashboard</title>

    <!-- CSS -->
    <link href="../style/Homepagex.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .product-img {
            width: 100px; /* Adjust as needed */
        }
        /* Add any additional custom styles here */
    </style>
</head>

<body>

    <!-- Nav bar -->
    <div class="">
        <br><br><br>
        <?php include("../include/navigation.php"); ?>
    </div>

    <?php
    
include "../include/DBconn.php";

$sellerId = $_SESSION['id']; // Retrieve current seller ID from session
$orders = [];
$error_message = '';

try {
    // Fetch all shipped orders for the current seller
    $stmt = $conn->prepare("
        SELECT 
            Orders.order_id as order_id,  
            Orders.order_status, 
            OrderDetails.product_id, 
            OrderDetails.quantity, 
            Products.product_name, 
            Products.product_price 
        FROM Orders 
        JOIN OrderDetails ON Orders.order_id = OrderDetails.order_id 
        JOIN Products ON OrderDetails.product_id = Products.product_ID 
        WHERE Products.seller_id = ? AND Orders.order_status = 'shipped'
    ");
    $stmt->bind_param("i", $sellerId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch data
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }

    $stmt->close();

} catch (Exception $e) {
    $error_message = "Error: Could not retrieve orders. " . $e->getMessage();
}
?>

<div class="container">
        <br><br>
        <hr class="col-9 mx-auto" style="border-top: 3px double;">
        <h1 class="text-center" style=" font-size: 45px; font-style: normal; text-rendering: optimizeLegibility; padding-top: 30px;">Orders to Deliver</h1>
        <hr class="col-9 mx-auto" style="border-top: 3px double;">

        <?php if(!empty($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <!-- Display shipped orders -->
        <?php if(count($orders) > 0): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['product_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($order['quantity'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>$<?php echo htmlspecialchars($order['product_price'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($order['order_status'], ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No shipped orders to display.</p>
        <?php endif; ?>
    </div>

</body>
</html>