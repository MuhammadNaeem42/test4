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
        <title>Booking Appointment System - promotion</title>

        <!-- CSS -->


        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
 
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>


    <body>
        <?php include('message.php'); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header">
                            <h4>Promotions</h4>
                            <a href="add_promotion.php" class="btn btn-primary float-end">Add promotions</a>
                        </div>

                        <div class="card-body">
                            <table class=" table table-bordered table-striped">
                                <thread>
                                    <thead>
                                        <tr>
                                            <th scope="col">Product ID</th>
                                            <th scope="col">Product image</th>
                                            <th scope="col">Product name</th>
                                            <th scope="col">Product scientific name</th>                                            
                                            <th scope="col">Product price</th>
                                            <th scope="col">Product discount</th>
                                            <th scope="col">Product discounted price</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                            $query = "SELECT * FROM promotions";
                                            $query_run = mysqli_query($conn, $query);

                                            if(mysqli_num_rows($query_run) > 0)
                                            {
                                                foreach($query_run as $promotion)
                                                {
                                                    ?>


                                                    <tr>
                                                        <td>
                                                            <?= $promotion['product_ID']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $promotion['product_image']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $promotion['product_name']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $promotion['product_sname']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $promotion['product_price']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $promotion['product_discount']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $promotion['product_dprice']; ?>
                                                        </td>
                                                        
                                                        <td>
                                                            <!-- Edit -->
                                                            <a href="edit_promotion.php?product_ID=<?= $promotion['product_ID']; ?>" class="btn btn-success btn-sm">Edit</a>
                                                            <!-- Delete -->
                                                            <a href="" class="btn btn-danger btn-sm delete_btn">Delete</a>

                                                        </td>

                                                    </tr>


                                                    <?php
                                                }

                                            }
                                            else
                                            {
                                                echo "No data found";
                                            }
                                        ?>
                                        <tr>

                                        </tr>
                                    </tbody>

                                </thread>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        
        <!-- Delete promotion modal -->
                                            

        <div class="modal fade" id="deletePromotionModal" tabindex="-1" aria-labelledby="deletePromotionModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deletePromotionModal">Delete promotion</h5>
                        <a href="promotion.php" type="button" class="close btn btn-danger btn-sm" data-dismiss="modal" aria-label="close">x</a>

                    </div>

                    <div class="modal-body">
                        <h5>Confirmation to delete the selected product.</h5>
                    </div>

                    <div class="modal-footer">
                        <a href="promotion.php" type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</a>
                        <form action="function.php" method="POST" class="d-inline">
                            <button type="submit" name="delete_promotion" value="<?=$promotion['product_ID'];?>" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>




        <script>
            $(document).ready(function()
            {
                $('.delete_btn').click(function(e)
                {
                    e.preventDefault();
                    var product_ID = $(this).closest('tr').find('.product_ID').text();
                    console.log(product_ID);

                    $('#deletePromotionModal').modal('show');
                });
            })

        </script>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    </body>
</html>