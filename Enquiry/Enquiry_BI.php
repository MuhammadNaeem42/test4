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
        <title>Booking Appointment System - Outlet business information</title>

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
                            <h4>Business information</h4>
                            <a href="Admin_Enquiry.php" class="btn btn-primary">Return</a>
                            <a href="Add_BI.php" class="btn btn-primary float-end">Add BI</a>
                        </div>

                        <div class="card-body">
                            <table class=" table table-bordered table-striped">
                                <thread>
                                    <thead>
                                        <tr >
                                            <th scope="col">Outlet ID</th>
                                            <th scope="col">Outlet name</th>
                                            <th scope="col">Operating time</th>
                                            <th scope="col">Phone no.</th>
                                            <th scope="col">Email</th>
                                            <th scope="col" style="word-wrap: break-word;">Location</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                            $query = "SELECT * FROM enquiry_bi";
                                            $query_run = mysqli_query($conn, $query);

                                            if(mysqli_num_rows($query_run) > 0)
                                            {
                                                foreach($query_run as $enquiry_bi)
                                                {
                                                    ?>


                                                    <tr >
                                                        <td>
                                                            <?= $enquiry_bi['BI_Outlet_ID']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $enquiry_bi['BI_Outlet_name']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $enquiry_bi['BI_operating_time']; ?>
                                                        </td> 
                                                        <td>
                                                            <?= $enquiry_bi['BI_phoneNo']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $enquiry_bi['BI_Email']; ?>
                                                        </td>
                                                        <td style="word-wrap:break-word;">
                                                            <?= $enquiry_bi['BI_Location']; ?>
                                                        </td>                                                           
                                                        <td>
                                                            <!-- Edit -->
                                                            <a href="Edit_BI.php?BI_Outlet_ID=<?= $enquiry_bi['BI_Outlet_ID']; ?>" class="btn btn-success btn-sm">Edit</a>
                                                            <!-- Delete -->

                                                            <form action="function.php" method="POST" class="d-inline">
                                                                <button type="submit" name="delete_BI" value="<?= $enquiry_bi['BI_Outlet_ID']; ?>" class="btn btn-danger btn-sm delete_btn">Delete</a>

                                                            </form>

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




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    </body>
</html>