<?php
include "../include/DBconn.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="Notification_Page" content="Notification_Page">
    <title>Booking Appointment System</title>
    <link rel="stylesheet" href="../style/Notificationxx.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<?php include("../include/navigation.php"); ?>
<div class="container" style="margin-top: 100px">
    <h2 class="text-center mt-5">Sellers Information</h2>    
    <table id="example" class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Seller Name</th>
                <th>Product name</th>
                <th>Product Sname</th>
                <th>Product Price</th>
                <th>Seller Location</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $seller_id = $_GET['sellerid'];
            $key = 1; 
            $sellers_result = mysqli_query($conn, "SELECT users.*,p.* FROM users join sellers_product sp on sp.seller_id = users.id join products p on p.product_ID = sp.product_id where users.id='".$seller_id."' and role_type = '2' ");
            while ($seller = mysqli_fetch_assoc($sellers_result)) : ?>
                <tr>
                    <td><?php echo $key ?></td>
                    <td><?php echo $seller['first_name'] . " " . $seller['last_name'] ?></td>
                    <td><?php echo $seller['product_name'] ?></td>
                    <td><?php echo $seller['product_sname'] ?></td>
                    <td><?php echo $seller['product_price'] ?></td>                    
                    <td><?php echo ucfirst($seller['seller_location']); ?></td>
                </tr>
                <?php $key +=1; ?>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>