<?php 
session_start();
include "../include/DBconn.php";
?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name = "Homepage" content = "Homepage">
        <title>Booking Appointment System - Edit Business information</title>

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
                                Edit Business information
                            </h4>
                            <a href="Enquiry_BI.php" class="btn btn-danger float-end">Back</a>
                        </div>

                        <div class="card-body">

                        
                            <?php
                                if(isset($_GET['BI_Outlet_ID']))
                                {
                                    $BI_Outlet_ID = mysqli_real_escape_string($conn, $_GET['BI_Outlet_ID']);
                                    $query = "SELECT * FROM enquiry_bi WHERE BI_Outlet_ID='$BI_Outlet_ID' ";
                                    $query_run = mysqli_query($conn, $query);

                                    if (mysqli_num_rows($query_run) > 0)
                                    {
                                        $enquiry_bi = mysqli_fetch_array($query_run);
                                        ?>

                                        <form action ="function.php" method="POST">

                                            <input type="hidden" name="BI_Outlet_ID" value="<?=$enquiry_bi['BI_Outlet_ID'];?>">


                                            <div class="mb-3">
                                                <label>Outlet name</label>
                                                <input type="varchar" name="BI_Outlet_name" value="<?=$enquiry_bi['BI_Outlet_name'];?>" class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <label>Operating time</label>
                                                <input type="varchar" name="BI_operating_time" value="<?=$enquiry_bi['BI_operating_time'];?>" class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <label>Phone no.</label>
                                                <input type="int" name="BI_phoneNo" value="<?=$enquiry_bi['BI_phoneNo'];?>" class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <label>Email</label>
                                                <input type="varchar" name="BI_Email" value="<?=$enquiry_bi['BI_Email'];?>" class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <label>Location</label>
                                                <input type="varchar" name="BI_Location" value="<?=$enquiry_bi['BI_Location'];?>" class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <button type="submit" name="update_BI" class="btn btn-primary">Submit</button>
                                            </div>
                                            

                                        </form>

                                        <?php

                                    }
                                    else
                                    {
                                        echo "PRODUCT ID NOT FOUND";
                                    }
                                }


                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    </body>
</html>