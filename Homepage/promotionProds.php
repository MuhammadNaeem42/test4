<?php
include "../include/DBconn.php";
?>


<!DOCTYPE html>
<hmtl lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="Homepage" content="Homepage">
        <title>Booking Appointment System</title>

        <!-- CSS -->
        <link href="../../style/Homepage.css" rel="stylesheet">

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>


    <body>

        <!-- Nav bar -->
        <div class="">
            <br><br><br>
            <?php include("../include/navigation.php"); ?>
        </div>

        <!-- Introduction row -->
        <div class="row col-12 mx-auto shadow">
            <div class="col xcol col-after">

                <br><br>
                <form action="search.php" method="GET">
                    <input type="text" name="query" style="border:1px solid" />
                    <input type="submit" value="Search" />
                </form>
            </div>

        </div>


        <!-- Promotion text -->
        <br><br>
        <hr class="col-9 mx-auto" style="border-top: 3px double;">
        <h2 class="text-center" style=" font-size: 45px; font-family: 'Untitled Serif',Georgia,Moderat,Helvetica Neue,Helvetica,Arial,sans-serif; font-weight: 700; font-style: normal; text-rendering: optimizeLegibility; padding-top: 30px;">Products on Promotion</h2>
        <hr class="col-9 mx-auto" style="border-top: 3px double;">

        <div class="row col-12 row-cols-1 row-cols-md-4  g-5" style="margin:0;">


            <?php

            $query = "SELECT * FROM products WHERE promoted = 'Yes'";
            $query_run = mysqli_query($conn, $query);

            if (mysqli_num_rows($query_run) > 0) {
                foreach ($query_run as $product) {

            ?>

                    <div class="col">
                        <div class="card h-100">
                            <a href="product_details.php?id=<?php echo $product['product_ID']; ?>">
                                <img src="../Homepage/Homepage_Images/<?php echo $product['product_image']; ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $product['product_name']; ?></h5>
                                    <h6 style="" class="card-subtitle mb-2 text-muted fst-italic"> <?php echo $product['product_price']; ?> RM</h6>
                                    <div class="col-12 card-text row">
                                        <div class="col-3 text-decoration-line-through text-left">
                                        </div>
                                        <div style="display: none;" class="col-9 text-danger" style="padding-left:0"></div>
                                    </div>
                                    <p class="card-text" style="display: none;"></p>
                                </div>
                            </a>
                        </div>
                    </div>

            <?php
                }
            } else {
                echo "No products found";
            }


            ?>



        </div>

        <hr style="border-top: 3px double;">
        <hr style="border-top: 3px double;">
        <br><br>
        <h2 class="text-center" style=" font-size: 50px; font-family: 'Untitled Serif',Georgia,Moderat,Helvetica Neue,Helvetica,Arial,sans-serif; font-weight: 700; font-style: normal; text-rendering: optimizeLegibility; padding-top: 50px; padding-bottom: 50px; margin-bottom: 0px;">Why us?</h2>

        <div class="row col-12">
            <div class="row col-9 mx-auto">
                <div class="col-3 mx-auto">
                    <div class="card border-0">
                        <img alt="icon" src="https://res.cloudinary.com/patch-gardens/image/upload/c_scale,h_144,q_auto:good,w_144/v1/cms/SVG_Quality_illustration.svg">
                        <div class="card-body">
                            <h5 class="card-title text-center">
                                Best Quality
                            </h5>
                            <h6 class="card-subtitle mb2 text-muted text-center">
                                The plants are all carefully nourished by our excellent team. With the outmost care, comes with the outmost quality.
                            </h6>
                        </div>
                    </div>
                </div>

                <div class="col-3 mx-auto">
                    <div class="card border-0">
                        <img alt="icon" src="https://res.cloudinary.com/patch-gardens/image/upload/c_scale,h_144,q_auto:good,w_144/v1/cms/SVG_Quality_illustration.svg">
                        <div class="card-body">
                            <h5 class="card-title text-center">
                                Best Quality
                            </h5>
                            <h6 class="card-subtitle mb2 text-muted text-center">
                                The plants are all carefully nourished by our excellent team. With the outmost care, comes with the outmost quality.
                            </h6>
                        </div>
                    </div>
                </div>

                <div class="col-3 mx-auto">
                    <div class="card border-0">
                        <img alt="icon" src="https://res.cloudinary.com/patch-gardens/image/upload/c_scale,h_144,q_auto:good,w_144/v1/cms/SVG_Quality_illustration.svg">
                        <div class="card-body">
                            <h5 class="card-title text-center">
                                Best Quality
                            </h5>
                            <h6 class="card-subtitle mb2 text-muted text-center">
                                The plants are all carefully nourished by our excellent team. With the outmost care, comes with the outmost quality.
                            </h6>
                        </div>
                    </div>
                </div>


            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
    <?php include('../include/footer.php') ?>

</hmtl>