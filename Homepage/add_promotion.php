<?php 
session_start();
include "../include/DBconn.php";

if(!isset($_SESSION['email'])){
    header('location: login.php');
}


?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name = "Homepage" content = "Homepage">
        <title>Booking Appointment System - Add promotion</title>

        <!-- CSS -->


        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
 
    </head>

    <body>
    
        <?php include('message.php'); ?>

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Add promotions
                                <a href="admin_homepage.php" class="btn btn-danger float-end">Back</a>
                            </h4>

                        </div>

                        <div class="card-body">
                            <form action="function.php" method="POST">
                                <div class="mb-3">
                                    <label>Product ID</label>
                                    <input type="int" name="product_ID" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label>Product image</label>
                                    <input type="file" name="product_image" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label>Product name</label>
                                    <input type="varchar" name="product_name" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label>Product scientific name</label>
                                    <input type="varchar" name="product_sname" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label>Product price</label>
                                    <input type="int" name="product_price" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label>Product discount</label>
                                    <input type="int" name="product_discount" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label>Product discounted prie</label>
                                    <input type="int" name="product_dprice" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label for="product_category">Product Category</label>
                                    <select name="product_category" id="product_category" class="form-control">
                                        <option value="clothing">Clothing</option>
                                        <option value="footwear">Footwear</option>
                                        <option value="plants">Plants</option>
                                        <option value="house_decor">House and Decor</option>
                                    </select>
                                </div>
  

                                <div class="mb-3">
                                    <button type="submit" name="save_promotion" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    </body>
</html>