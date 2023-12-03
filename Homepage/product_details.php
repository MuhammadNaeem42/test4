<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <style>
        body {
            font-family: 'Roboto Condensed', sans-serif;
            background-color: #f5f5f5;
        }

        .hedding {
            font-size: 20px;
            color: #ab8181;
        }

        .main-section {
            position: absolute;
            left: 50%;
            right: 50%;
            transform: translate(-50%, 5%);
        }

        .left-side-product-box img {
            width: 100%;
        }

        .left-side-product-box .sub-img img {
            margin-top: 5px;
            width: 83px;
            height: 100px;
        }

        .right-side-pro-detail span {
            font-size: 15px;
        }

        .right-side-pro-detail p {
            font-size: 25px;
            color: #a1a1a1;
        }

        .right-side-pro-detail .price-pro {
            color: #E45641;
        }

        .right-side-pro-detail .tag-section {
            font-size: 18px;
            color: #5D4C46;
        }

        .pro-box-section .pro-box img {
            width: 100%;
            height: 200px;
        }

        @media (min-width:360px) and (max-width:640px) {
            .pro-box-section .pro-box img {
                height: auto;
            }
        }

        /* New CSS for the seller box */
        .seller-info-box {
            border: 1px solid #ddd; /* Make border color same as page design */
            padding: 10px;
            border-radius: 5px; /* Rounded corners for the box */
            margin-bottom: 20px; /* Space between seller box and description */
        }

        .seller-info-box img {
            border-radius: 50%; /* Circular image */
            margin-right: 10px;
        }

        .seller-info-box a {
            text-decoration: none;
            color: #333; /* Adjust color to match page design */
        }

        .seller-info-box a:hover {
            text-decoration: underline;
        }
    </style>
    <title>Product Details</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="">
        <br><br><br>
        <?php include("../include/navigation.php"); ?>
    </div>
    <?php  
    include "../include/DBconn.php";
    $id = $_GET['id'];
    $product_query = 'SELECT products.*, users.first_name, users.last_name, users.pp, users.seller_location FROM products LEFT JOIN users ON products.seller_id = users.id WHERE products.product_ID="'.$id.'"';
    $product_result = mysqli_query($conn, $product_query);
    $product_details = mysqli_fetch_array($product_result);
    ?>
    <hr class="col-9 mx-auto" style="border-top: 3px double;">
    <h2 class="text-center" style=" font-size: 45px; font-family: 'Untitled Serif',Georgia,Moderat,Helvetica Neue,Helvetica,Arial,sans-serif; font-weight: 700; font-style: normal; text-rendering: optimizeLegibility; padding-top: 30px;"><?php echo strtoupper($product_details['product_name']); ?> </h2>
    <hr class="col-9 mx-auto" style="border-top: 3px double;">

    <div class="container">
        <div class="col-lg-8 border p-3 main-section bg-white">
            <div class="row m-0">
                <div class="col-lg-4 left-side-product-box pb-3">
                    <img src="../Homepage/Homepage_Images/<?php echo $product_details['product_image'];?>" class="border p-3">
                </div>
                <div class="col-lg-8">
                    <div class="right-side-pro-detail border p-3 m-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="m-0 p-0"><?php echo $product_details['product_name']; ?></p>
                            </div>
                            <div class="col-lg-12">
                                <p class="m-0 p-0 price-pro">$<?php echo $product_details['product_price']; ?></p>
                                <hr class="p-0 m-0">
                            </div>
                            <!-- Seller Information Box -->
                            <div class="col-lg-12 pt-2">
                                <div class="seller-info-box">
                                    <h5><a href="seller_details.php?id=<?php echo $product_details['seller_id']; ?>">Seller Information</a></h5>
                                    <div>
                                        <img src="../Homepage/Homepage_Images/<?php echo $product_details['pp']; ?>" alt="Seller Profile Picture" style="width:50px; height:50px;">
                                        <strong><a href="seller_details.php?id=<?php echo $product_details['seller_id']; ?>"><?php echo $product_details['first_name'] . " " . $product_details['last_name']; ?></a><br></strong> 
                                        <strong>Location:</strong> <?php echo $product_details['seller_location']; ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Description -->
                            <div class="col-lg-12 pt-2">
                                <h5>Description</h5>
                                <span><?php echo $product_details['product_desc']; ?></span>
                                <hr class="m-0 pt-2 mt-2">
                            </div>
                        </div>

                        <div class="text-center my-4">
                            <form action="addToCart.php" method="post">
                                <!-- The product ID is sent with the form submission -->
                                <input type="hidden" name="product_ID" value="<?php echo $product_details['product_ID']; ?>">
                                <input type="submit" value="Add to Cart">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><br/><br/>
    </div>
    <hr class="col-9 mx-auto" style="border-top: 3px double;">
    <hr class="col-9 mx-auto" style="border-top: 3px double;">
    <?php include('../include/footer.php') ?>
</body>
</html>
