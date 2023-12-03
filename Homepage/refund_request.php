

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Refund Request</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f7f7f7; /* Light grey background */
            padding-top: 100px; /* Adjust this value to ensure content starts below the navbar */
        }
        .container {
            background: #fff; /* White background for the form area */
            border-radius: 8px; /* Rounded corners for the form container */
            padding: 20px; /* Spacing inside the container */
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Subtle shadow for depth */
            max-width: 600px; /* Maximum width of the form */
            margin: auto; /* Center the form in the page */
        }
        h1 {
            color: #333; /* Dark grey color for the heading */
            text-align: center; /* Center the heading */
            margin-bottom: 30px; /* Spacing below the heading */
        }
        .form-label {
            color: #555; /* Slightly lighter grey for the label text */
        }
        .btn-primary {
            background-color: #0056b3; /* Custom primary color */
            border: none; /* Remove the border */
            padding: 10px 20px; /* Padding for the button */
            margin-top: 20px; /* Spacing above the button */
        }
        .btn-primary:hover {
            background-color: #003d82; /* Darker shade for hover effect */
        }
        /* Additional custom styles */
    </style>
</head>
<body>
<div class="">
            <br><br><br>
            <?php include("../include/navigation.php"); ?>
        </div>

        <?php
// refund_request.php
include "../include/DBconn.php";

$order_id = $_GET['order_id'] ?? null; // Get the order ID from the URL

// You would also want to verify that the order belongs to the user here
?>

    <div class="container">
        <h1>Refund Request</h1>
        <form action="submit_refund_request.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
            <div class="mb-3">
                <label for="reason" class="form-label">Reason for Refund:</label>
                <select name="reason" id="reason" class="form-select">
                    <option value="Damaged item">Damaged item</option>
                    <option value="Incorrect item">Incorrect item</option>
                    <option value="Late delivery">Late delivery</option>
                    <!-- Add more reasons as needed -->
                </select>
            </div>
            <div class="mb-3">
                <label for="details" class="form-label">Details:</label>
                <textarea name="details" id="details" class="form-control" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="images" class="form-label">Upload Images:</label>
                <input type="file" name="images[]" id="images" class="form-control" multiple>
            </div>
            <button type="submit" class="btn btn-primary">Submit Request</button>
        </form>
    </div>

    <!-- Your footer content -->
</body>
</html>
