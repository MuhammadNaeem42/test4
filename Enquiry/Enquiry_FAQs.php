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
        <title>Booking Appointment System - FAQs</title>

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
                            <h4>Frequently Asked Questioned (FAQs)</h4>
                            <a href="Admin_Enquiry.php" class="btn btn-primary">Return</a>
                            <a href="Add_FAQs.php" class="btn btn-primary float-end">Add FAQs</a>
                        </div>

                        <div class="card-body">
                            <table class=" table table-bordered table-striped">
                                <thread>
                                    <thead>
                                        <tr>
                                            <th scope="col">FAQs_ID</th>
                                            <th scope="col">FAQs_Enquiry</th>
                                            <th scope="col">FAQs_Answer</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                            $query = "SELECT * FROM enquiry_faqs";
                                            $query_run = mysqli_query($conn, $query);

                                            if(mysqli_num_rows($query_run) > 0)
                                            {
                                                foreach($query_run as $enquiry_faq)
                                                {
                                                    ?>


                                                    <tr>
                                                        <td>
                                                            <?= $enquiry_faq['FAQs_ID']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $enquiry_faq['FAQs_enquiry']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $enquiry_faq['FAQs_answer']; ?>
                                                        </td>                                                        
                                                        <td>
                                                            <!-- Edit -->
                                                            <a href="Edit_FAQs.php?FAQs_ID=<?= $enquiry_faq['FAQs_ID']; ?>" class="btn btn-success btn-sm">Edit</a>
                                                            <!-- Delete -->

                                                            <form action="function.php" method="POST" class="d-inline">
                                                                <button type="submit" name="delete_FAQs" value="<?= $enquiry_faq['FAQs_ID']; ?>" class="btn btn-danger btn-sm delete_btn">Delete</a>

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