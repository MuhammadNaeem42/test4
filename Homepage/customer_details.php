<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../style/Homepagex.css" rel="stylesheet">
</head>
<body>

    <!-- Navigation Bar -->
    <div>
        <?php include("../include/navigation.php"); ?>
    </div>

    <?php
    include "../include/DBconn.php";

    // Initialize an empty array to store customer details and orders
    $customerDetails = [];
    $customerOrders = [];
    $error_message = '';

    // Check if the customerId is set in the URL
    if(isset($_GET['customerId'])) {
        $customerId = $_GET['customerId'];
        $sellerId = $_SESSION['id']; // Retrieve current seller ID from session

        // Fetch customer details
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $customerId);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            $customerDetails = $result->fetch_assoc();
        } else {
            $error_message = "No customer found with the provided ID.";
        }
        $stmt->close();

        // Fetch orders made by the customer from this seller
        $stmt = $conn->prepare("
            SELECT o.order_id, o.order_date, o.total_price, o.order_status, p.product_name, od.quantity, od.price
            FROM orders o
            JOIN orderdetails od ON o.order_id = od.order_id
            JOIN products p ON od.product_id = p.product_ID
            WHERE o.user_id = ? AND p.seller_id = ?
        ");
        $stmt->bind_param("ii", $customerId, $sellerId);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()) {
            $customerOrders[] = $row;
        }
        $stmt->close();
    } else {
        $error_message = "Customer ID is not provided.";
    }
    ?>

    <div class="container mt-4">
        <h2>Customer Details</h2>
        <?php if(!empty($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <?php if(!empty($customerDetails)): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($customerDetails['first_name'] . ' ' . $customerDetails['last_name']); ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($customerDetails['email']); ?></p>
                    <p class="card-text"><?php echo htmlspecialchars($customerDetails['phone_number']); ?></p>
                    <p class="card-text"><?php echo htmlspecialchars($customerDetails['address']); ?></p>
                    <!-- Add more customer details here -->
                </div>
            </div>
        <?php endif; ?>

        <h3>Orders from This Customer</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Order Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($customerOrders as $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                        <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                        <td>$<?php echo htmlspecialchars($order['price']); ?></td>
                        <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                        <td>$<?php echo htmlspecialchars($order['total_price']); ?></td>
                        <td><?php echo htmlspecialchars($order['order_status']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvx6vNjK9UpQqKfJAF4JwNf6k5e2l5u7JpBb7k7lvoJtjRvJQaSF2p1w8jL" crossorigin="anonymous"></script>
</body>
</html>
