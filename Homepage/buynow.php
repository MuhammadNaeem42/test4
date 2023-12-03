<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Booking Appointment System</title>

    <!-- CSS -->
    <link href="../../style/Homepage.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <style>
        /* Add your custom styles here */
        .product-info h5 {
            font-size: 24px;
        }
        .product-info p {
            font-size: 18px;
        }
        .horizontal-product-card {
            display: flex;
            align-items: center;
            border: 1px solid #ddd; /* Adjust color as needed */
            padding: 20px;
            margin-bottom: 20px; /* Adjust space between cards */
        }
        .horizontal-product-card img {
            max-width: 100px; /* Adjust as needed */
            max-height: 100px; /* Adjust as needed */
            margin-right: 20px; /* Space between image and text */
        }
        .product-info {
            flex-grow: 1;
        }
    </style>
</head>
<body>

    <!-- Nav bar -->
    <div class="">
        <br><br><br>
        <?php 
        require_once('../libs/tcpdf/tcpdf.php');
        include("../include/navigation.php"); ?>
    </div>

    <?php
    // Start a session and include your database connection file
    include "../include/DBconn.php";

    $userId = $_SESSION['id'];

    // Fetch the user's selected products and quantities
    if (isset($_POST['selectedProducts']) && isset($_POST['quantities'])) {
        $selectedProducts = array_unique($_POST['selectedProducts']); // This should be an array of selected product IDs
        $quantities = $_POST['quantities']; // This should be an array with product IDs as keys and quantities as values
        error_log('Selected Products: ' . print_r($selectedProducts, true)); // This will print the array to your error log
        error_log('Quantities: ' . print_r($quantities, true));
        // Fetch details of selected products
        $products = [];
        $totalCost = 0;
        foreach ($selectedProducts as $productId) {
            // Your query to get product details by ID
            $stmt = $conn->prepare("SELECT * FROM Products WHERE product_ID = ?");
            $stmt->bind_param("i", $productId);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();

            $product['quantity'] = $quantities[$productId]; // Store quantity with product details
            $products[] = $product;
            $totalCost += $product['product_price'] * $product['quantity']; // Calculate total cost based on quantity
        }

        // Fetch user address
        $stmt = $conn->prepare("SELECT address FROM Users WHERE id = ?"); // Assuming you have an 'address' column in your Users table
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $address = $user['address'];

        // Close statement
        $stmt->close();
    } else {
        // Redirect back to cart or show error if no products selected
        
        exit();
    }
    ?>

    <div class="container mt-5">
        <h2 class="text-center" style="font-size: 45px;">Selected Products</h2>
        <hr class="col-9 mx-auto" style="border-top: 3px double;">

        <!-- Products display -->
        <?php foreach ($products as $product): ?>
            <div class="horizontal-product-card">
                <img src="../Homepage/Homepage_Images/<?php echo $product['product_image']; ?>" alt="...">
                <div class="product-info">
                    <h5><?php echo htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8'); ?></h5>
                    <p>Quantity: <?php echo htmlspecialchars($product['quantity'], ENT_QUOTES, 'UTF-8'); ?></p> <!-- Display quantity -->
                    <p>$<?php echo htmlspecialchars($product['product_price'], ENT_QUOTES, 'UTF-8'); ?></p>
                    
                </div>
            </div>
        <?php endforeach; ?>

        <p><strong>Total Cost:</strong> $<?php echo htmlspecialchars($totalCost, ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Delivery Address:</strong> <?php echo htmlspecialchars($address, ENT_QUOTES, 'UTF-8'); ?></p>

        <h2>Payment Method:</h2>
        <form action="checkedOut.php" method="post">
            <!-- Pass product IDs to the next script -->
            <?php foreach ($selectedProducts as $productId): ?>
                <input type="hidden" name="selectedProducts[]" value="<?php echo htmlspecialchars($productId, ENT_QUOTES, 'UTF-8'); ?>">
            <?php endforeach; ?>

            <select name="paymentMethod" class="form-select mb-3">
                <option value="CashNGo">Cash N Go</option>
                <option value="CashOnDelivery">Cash on Delivery</option>
                <option value="VISA">VISA</option>
                <option value="MasterCard">MasterCard</option>
                <option value="GrabPay">GrabPay</option>
            </select>
            <button type="submit" class="btn btn-primary">Check Out</button>
        </form>
    </div>

    <!-- Footer -->
    <?php include('../include/footer.php') ?>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
