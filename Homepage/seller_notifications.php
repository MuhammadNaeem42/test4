<?php
include("../include/navigation.php"); 
include "../include/DBconn.php";



$seller_id = $_SESSION['id']; // Retrieve the seller's ID from the session

// Fetch all refund requests forwarded to this seller
$refund_requests_query = "SELECT refundrequests.request_id, refundrequests.reason, refundrequests.details, refundrequests.images, 
                                 users.email, orders.order_date, products.product_name, orderdetails.quantity, orderdetails.price 
                          FROM refundrequests 
                          INNER JOIN orders ON refundrequests.order_id = orders.order_id 
                          INNER JOIN orderdetails ON orders.order_id = orderdetails.order_id 
                          INNER JOIN products ON orderdetails.product_id = products.product_id 
                          INNER JOIN users ON refundrequests.user_id = users.id 
                          WHERE products.seller_id = ? AND refundrequests.status = 'forwarded'";

$stmt = mysqli_prepare($conn, $refund_requests_query);
mysqli_stmt_bind_param($stmt, "i", $seller_id);
mysqli_stmt_execute($stmt);
$refund_requests_result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Refund Requests</title>
    <!-- CSS -->
    <link href="../style/Homepagex.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            padding-top: 80px; /* Adjust this value to match the height of your navigation bar */
            background-color: #f7f7f7; /* Light grey background */
            font-family: 'Arial', sans-serif; /* Standard web-safe font */
        }

        .container {
            background-color: #fff; /* White background for content */
            border-radius: 8px; /* Rounded corners for container */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
            padding: 20px; /* Spacing inside the container */
            margin-bottom: 30px; /* Spacing below the container */
        }

        h1 {
            color: #333; /* Dark grey color for headings */
            margin-bottom: 20px; /* Spacing below the heading */
        }

        .table {
            margin-top: 20px; /* Spacing above the table */
        }

        .table thead {
            background-color: #f1f1f1; /* Light grey background for table header */
        }

        .table th, .table td {
            border: 1px solid #ddd; /* Light grey border for table cells */
        }

        form {
            display: flex;
            gap: 10px; /* Spacing between form elements */
            align-items: center; /* Align form elements vertically */
        }

        button {
            padding: 5px 10px; /* Padding inside buttons */
            border: none; /* Remove default border */
            border-radius: 4px; /* Rounded corners for buttons */
            cursor: pointer; /* Pointer cursor on hover */
        }

        button[type="submit"] {
            background-color: #5cb85c; /* Green background for submit buttons */
            color: white; /* White text for submit buttons */
        }

        button[type="submit"]:hover {
            background-color: #4cae4c; /* Darker green on hover */
        }

        textarea {
            border: 1px solid #ddd; /* Light grey border for textarea */
            border-radius: 4px; /* Rounded corners for textarea */
            padding: 5px; /* Padding inside textarea */
            resize: vertical; /* Allow vertical resizing of textarea */
        }
    </style>
</head>
<body>
    <h1>Refund Requests</h1>
    <table>
        <thead>
            <tr>
                <th>Request ID</th>
                <th>User Email</th>
                <th>Order Date</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Reason</th>
                <th>Details</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($request = mysqli_fetch_assoc($refund_requests_result)) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($request['request_id']); ?></td>
                    <td><?php echo htmlspecialchars($request['email']); ?></td>
                    <td><?php echo htmlspecialchars($request['order_date']); ?></td>
                    <td><?php echo htmlspecialchars($request['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($request['quantity']); ?></td>
                    <td><?php echo htmlspecialchars($request['price']); ?></td>
                    <td><?php echo htmlspecialchars($request['reason']); ?></td>
                    <td><?php echo htmlspecialchars($request['details']); ?></td>
                    <td>
                        <?php if ($request['images']) : ?>
                            <img src="<?php echo htmlspecialchars($request['images']); ?>" alt="Refund Image" style="width: 100px; height: auto;">
                        <?php else : ?>
                            No Image
                        <?php endif; ?>
                    </td>
                    <td>
                        <form method="post" action="seller_process_refund_request.php">
                            <input type="hidden" name="request_id" value="<?php echo $request['request_id']; ?>">
                            <button type="submit" name="action" value="accept">Accept</button>
                            <button type="submit" name="action" value="deny">Deny</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
