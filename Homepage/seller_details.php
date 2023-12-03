<?php
include "../include/DBconn.php";

// Get the seller ID from the URL
$seller_id = $_GET['id'];

// Fetch seller information
$seller_query = "SELECT * FROM users WHERE id = '$seller_id'";
$seller_result = mysqli_query($conn, $seller_query);
$seller_details = mysqli_fetch_assoc($seller_result);

// Fetch products by this seller
$product_query = "SELECT * FROM products WHERE seller_id = '$seller_id'";
$product_result = mysqli_query($conn, $product_query);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!-- Include your CSS file here -->
    <link rel="stylesheet" href="path_to_your_css_file.css">
    <title>Seller Details</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="">
        <br><br><br>
        <?php include("../include/navigation.php"); ?>
    </div>

    <div class="container">
        <div class="main-section">
            <!-- Seller Information -->
            <div class="seller-section">

            <br><br>
        <hr class="col-9 mx-auto" style="border-top: 3px double;">
        <h2 class="text-center" style=" font-size: 45px; font-family: 'Untitled Serif',Georgia,Moderat,Helvetica Neue,Helvetica,Arial,sans-serif; font-weight: 700; font-style: normal; text-rendering: optimizeLegibility; padding-top: 30px;"><?php echo $seller_details['first_name'] . " " . $seller_details['last_name']; ?></h2>
        <hr class="col-9 mx-auto" style="border-top: 3px double;">

                <p><strong>Location:</strong> <?php echo $seller_details['seller_location']; ?></p>
                <p><strong>Address:</strong> <?php echo $seller_details['address']; ?></p>
                <!-- Add more seller details here -->
            </div>
            <hr>

            <!-- Products by Seller -->
            <div class="product-section">
                <h2>Products by this Seller</h2>
                <div class="row">
                    <?php while($product = mysqli_fetch_assoc($product_result)) { ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100">
                                <a href="product_details.php?id=<?php echo $product['product_ID']; ?>"><img class="card-img-top" src="../Homepage/Homepage_Images/<?php echo $product['product_image']; ?>" alt=""></a>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="product_details.php?id=<?php echo $product['product_ID']; ?>"><?php echo $product['product_name']; ?></a>
                                    </h4>
                                    <h5>$<?php echo $product['product_price']; ?></h5>
                                    <p class="card-text"><?php echo $product['product_desc']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <?php include('../include/footer.php') ?>
</body>
</html>
