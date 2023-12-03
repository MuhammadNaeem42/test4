<?php 
include "../include/DBconn.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="Homepage" content="Homepage">
        <title>Booking Appointment System</title>

        <!-- CSS -->
        <link href="../style/Homepage.css" rel="stylesheet">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>
    <body>
        <!-- Nav bar -->
        <div class="">
            <br><br><br>
            <?php include("../include/navigation.php"); ?>
        </div>

        <!-- Search and Filter Form -->
        <div class="row col-12 mx-auto shadow">
            <div class="col xcol col-after">
                <br><br>
                <form action="search.php" method="GET">
                    <input type="text" name="query" value="<?php echo $_GET['query'] ?? ''; ?>" style="border:1px solid" />
                    <!-- Dropdown for price filter -->
                    <select name="price_range">
                        <option value="">Select Price Range</option>
                        <option value="0-50">$0 - $50</option>
                        <option value="51-100">$51 - $100</option>
                        <option value="101-150">$101 - $150</option>
                        <option value="151-200">$151 - $200</option>
                        <option value="201-500">$201 - $500</option>
                        <option value="500+">$500+</option>
                    </select>
                    <input type="submit" value="Search" />
                </form>
            </div>
        </div>

        <!-- Product Cards -->
        <div class="row col-12 mx-auto shadow">
            <br><br>
            <hr class="col-9 mx-auto" style="border-top: 3px double;">
            <h2 class="text-center" style="font-size: 45px;">Products</h2>
            <hr class="col-9 mx-auto" style="border-top: 3px double;">

            <div class="row col-12 row-cols-1 row-cols-md-4 g-5" style="margin:0;">
                <?php
                    $query = $_GET['query'] ?? ''; 
                    $price_range = $_GET['price_range'] ?? '';

                    // Start the query with a basic search
                    $sql_query = "SELECT * FROM products WHERE product_name LIKE '%".$query."%'";

                    // If a price range is selected, add the appropriate WHERE clause
                    if ($price_range != '') {
                        $price_bounds = explode('-', $price_range);
                        if ($price_bounds[1] == '+') {
                            // Filter for prices greater than the lower bound
                            $sql_query .= " AND product_price >= ".$price_bounds[0];
                        } else {
                            // Filter between the lower and upper bounds
                            $sql_query .= " AND product_price BETWEEN ".$price_bounds[0]." AND ".$price_bounds[1];
                        }
                    }

                    $query_run = mysqli_query($conn, $sql_query);

                    if(mysqli_num_rows($query_run) > 0) {
                        foreach($query_run as $product) {
                            ?>
                            <div class="col">
                                <div class="card h-100">
                                    <img src="../Homepage/Homepage_Images/<?php echo $product['product_image'];?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $product['product_name'];?></h5>
                                        <h6 class="card-subtitle mb-2 text-muted">$<?php echo $product['product_price'];?></h6>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "<p>No products found.</p>";
                    }
                ?>
            </div>
        </div>

        <!-- Additional Content -->
        <!-- ... Your additional content here ... -->

        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>
