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
        <title>Booking Appointment System - Add Business Information</title>

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
                                Add Outlet Business Information
                                <a href="Enquiry_FAQs.php" class="btn btn-danger float-end">Back</a>
                            </h4>

                        </div>

                        <div class="card-body">
                            <form action="function.php" method="POST">
                                <div class="mb-3">
                                    <label>BI outlet ID</label>
                                    <input type="int" name="BI_Outlet_ID" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label>BI outlet name </label>
                                    <input type="varchar" name="BI_Outlet_name" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label>BI operating time</label>
                                    <input type="varchar" name="BI_operating_time" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label>BI phone no.</label>
                                    <input type="int" name="BI_phoneNo" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>BI email</label>
                                    <input type="varchar" name="BI_Email" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>BI location</label>
                                    <input type="varchar" name="BI_Location" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <button type="submit" name="save_BI" class="btn btn-primary">Submit</button>
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