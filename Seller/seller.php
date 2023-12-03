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
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Location</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sellers_result = mysqli_query($conn, "SELECT * FROM users where role_type = '2' ");
            while ($seller = mysqli_fetch_assoc($sellers_result)) : ?>
                <tr>
                    <td><?php echo $seller['id']; ?></td>
                    <td><?php echo $seller['first_name'] . ' ' . $seller['last_name']; ?></td>
                    <td><?php echo $seller['email']; ?></td>
                    <td><?php echo $seller['phone_number']; ?></td>
                    <td><?php echo ucfirst($seller['seller_location']); ?></td>
                    <td><a href="sellerProducts.php?sellerid=<?php echo $seller['id'] ?>" class="btn btn-primary">View Products</button></td>
                </tr>
            <?php endwhile; ?>
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