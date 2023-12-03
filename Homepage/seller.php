<?php

session_start();
include "../include/DBconn.php";

if (!isset($_SESSION['email'])) {
    header('location: login.php');
} else {
    // echo $_SESSION['email'];
}

if(isset($_GET['sellerid']) && trim($_GET['sellerid']) !=""){
    // require_once('../LogINOUT/includes/header.php');
    $seller_id = $_GET['sellerid'];
    
    $sellers_query = mysqli_query($conn, "SELECT * FROM users where role_type = '2' ");
    $result = mysqli_fetch_assoc($sellers_query);
    
    $email = $result['email'];
    // $mail->addAddress($result['email']);
    
    // // recipient
    // $mail->isHTML();
    // $mail->Subject = "Seller Verified by the admin";
    // $mail->Body = "
    // <h2>Hello! Welcome to Cacti-Succulent Kuching</h2>
    // <p> You seller account on <b>Cacti-Succulent Kuching</b>,has been verified by the admin</p>
    // <a href='http://localhost/Booking-appointment-system-main/LogINOUT/login.php target='_blank'>Click here to Login</a>
    // ";
    
    $update_quey = mysqli_query($conn,"UPDATE users set is_active = 1 where id ='".$seller_id."'");    
    // if ($mail->send()) {
    // } else {
    //   $_SESSION['toastr'] = array(
    //     'type'      => 'error',
    //     'message' => 'Something Wrong!',
    //     'title'     => 'Error: Failed Query!'
    //   );
    // }

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sellers and Suppliers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>

<body>
    <?php
    include("../include/Admin_navigation.php");
    include("../include/DBconn.php");
    ?>

    <div class="container" style="margin-top: 100px">
        <h2 class="text-center mt-5">Sellers Information</h2>
        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSeller">
            Add Seller
        </button>
        <div class="modal fade" id="addSeller" tabindex="-1" role="dialog" aria-labelledby="addSellerLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSellerLabel">Add Seller</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="upload.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="SellerName">Seller Name</label>
                                <input type="text" class="form-control" id="sName" name="SName" placeholder="Enter Seller name">
                            </div>
                            <div class="form-group">
                                <label for="price">Seller Email</label>
                                <input type="email" class="form-control" id="semail" name="semail" placeholder="Seller email ids">
                            </div>
                            <div class="form-group">
                                <label for="pdesc">Seller Location</label>
                                <input type="text" class="form-control" id="pdesc" name="pdesc" placeholder="Seller description" />
                            </div>
                            <div class="form-group">
                                <label for="pqnt"></label>
                                <input type="number" class="form-control" id="pqnt" name="pqnt" placeholder="Seller quantity">
                            </div>
                            <div class="form-group">
                                <label for="image">Seller Image</label>
                                <input type="file" class="form-control" name="image" id="image" required="">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" name="submit" class="btn btn-primary" value="Add">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> -->
        <table id="example" class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Is Approved</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $key = 1;
                $sellers_result = mysqli_query($conn, "SELECT * FROM users where role_type = '2' ");
                while ($seller = mysqli_fetch_assoc($sellers_result)) : ?>
                    <tr>
                        <td><?php echo $key; ?></td>
                        <td><?php echo $seller['first_name'] . ' ' . $seller['last_name']; ?></td>
                        <td><?php echo $seller['email']; ?></td>
                        <td><?php echo $seller['phone_number']; ?></td>
                        <td><?php echo $seller['is_active'] == '0' ? '<a href="seller.php?sellerid='.$seller['id'].'">Not Active click Here</a>' : 'Active'; ?></td>
                    </tr>
                <?php $key+=1;endwhile; ?>
            </tbody>
        </table>
    </div>

    <?php include('../include/footer.php') ?>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

    <script>
  $(document).ready(function() {
    $('#example').DataTable();
  });
</script>