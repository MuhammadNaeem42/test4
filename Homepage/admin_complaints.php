

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


    <!-- Nav bar -->
    <div class="">
        <br><br><br>
        <?php include("../include/navigation.php"); ?>
    </div>
    <?php
include "../include/DBconn.php";
// Fetch all refund requests with product name and image
$refund_requests_query = "SELECT refundrequests.*, users.email, orders.order_date, products.product_name, orderdetails.quantity 
                          FROM refundrequests 
                          JOIN users ON refundrequests.user_id = users.id 
                          JOIN orders ON refundrequests.order_id = orders.order_id 
                          JOIN orderdetails ON orders.order_id = orderdetails.order_id 
                          JOIN products ON orderdetails.product_id = products.product_id 
                          WHERE refundrequests.status = 'pending'";
$refund_requests_result = mysqli_query($conn, $refund_requests_query);

?>
    <div class="container">
        <h1>Refund Requests</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Request ID</th>
                    <th>User Email</th>
                    <th>Order Date</th>
                    <th>Product Name</th>
                    <th>Refund Image</th>
                    <th>Quantity</th>
                    <th>Reason</th>
                    <th>Details</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($request = mysqli_fetch_assoc($refund_requests_result)) { ?>
                    <tr>
                        <td><?php echo $request['request_id']; ?></td>
                        <td><?php echo $request['email']; ?></td>
                        <td><?php echo $request['order_date']; ?></td>
                        <td><?php echo $request['product_name']; ?></td>
                        <td>
                            <?php if($request['images']): ?>
                                <img src="<?php echo $request['images']; ?>" alt="Refund Image" class="refund-img">
                            <?php else: ?>
                                No Image
                            <?php endif; ?>
                        </td>
                        <td><?php echo $request['quantity']; ?></td>
                        <td><?php echo $request['reason']; ?></td>
                        <td><?php echo $request['details']; ?></td>
                        <td><?php echo $request['status']; ?></td>
                        <td>
                        <form method="post" action="process_refund_request.php">
                            <input type="hidden" name="request_id" value="<?php echo $request['request_id']; ?>">
                            <button type="submit" name="action" value="approve">Approve</button>
                            <button type="submit" name="action" value="reject">Reject</button>
                            <button type="submit" name="action" value="forward">Forward to Seller</button>
                            <textarea name="admin_response" placeholder="Optional admin response"></textarea>
                        </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


<!-- Your footer here -->

</body>
</html>
