<?php 
include "../include/DBconn.php";

$id = $_GET['id'];
$query=mysqli_query($conn,"select * FROM products where product_ID ='".$id."'");
   $row=mysqli_fetch_array($query);



// Check if image file is a actual image or fake image

?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "Notification_Page" content = "Notification_Page">
        <title>Booking Appointment System</title>
        <link rel="stylesheet" href="../style/Notificationxx.css">
        <script src="../js/Notificationxx.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
 
        <!-- Nav bar -->
        <?php 
            include("../include/navigation.php");
            include("../include/DBconn.php");
        ?>
        <div class="container" style="margin-top: 150px">
        <div class="content container">


  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
    
      </div>
      <div class="modal-body">
<form action="upload.php?id=<?php echo $row['product_ID']; ?>" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="productName">Product Name</label>
    <input type="text" class="form-control" id="productName" name="productName" value="<?php echo $row['product_name']; ?>" placeholder="Enter Prodcut name">
  </div>
   <div class="form-group">
    <label for="price">Price</label>
    <input type="text" class="form-control" id="price" name="price" value="<?php echo $row['product_price'] ?>" placeholder="product price">
  </div>
  <div class="form-group">
    <label for="price">Details</label>
    <input type="text" class="form-control" id="price" name="price" value="<?php echo $row['product_desc'] ?>" placeholder="product price">
  </div>
  <div class="form-group">
    <label for="price">Quantity</label>
    <input type="text" class="form-control" id="price" name="price" value="<?php echo $row['product_qnt'] ?>" placeholder="product price">
  </div>
  <div class="form-group">
    <label for="price">Promoted</label>
    <input type="text" class="form-control" id="price" name="price" value="<?php echo $row['promoted'] ?>" placeholder="product price">
  </div>
  <div class="form-group">
    <label for="price">Promo Price</label>
    <input type="text" class="form-control" id="price" name="price" value="<?php echo $row['promo_price'] ?>" placeholder="product price">
  </div>
  <div class="form-group">
    <label for="image">Product Image</label>
    <input type="file" class="form-control" name="image" id="image" required="">
  </div>
  <br>
 <div class="modal-footer">
        <input type="submit" name="update" class="btn btn-primary" value="Edit">
      </div>
</form>
      </div>
    </div>
  </div>
</div>
</div>


        <?php include('../include/footer.php') ?>
  
        <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
       <script src="https://code.jquery.com/jquery-3.5.1.js"></script> 
       <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script> 
       <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script> 



        <script>


/*  FETCH data in edit form MODAL*/


/*$('.update').click(function(){
    var product_id=$(this).attr('id');
   alert(product_id); 
})*/

            //Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('e43d8cddaeae61172fde', {
                cluster: 'ap1'
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function(data) {
                //alert(JSON.stringify(data));
                $.ajax({url: "real_time.php", success: function(result){
                    $("#result").html(result);
                }});
            });
            
            function loadData(button) {
                var appointment_id = button.id
                $.ajax({
                    url: "appoint.php",
                    method: "GET",
                    data: {"appointment_id": appointment_id},
                    success: function (response) {
                        var main_result = JSON.parse(response);

                        $("#notitype").text(main_result.appointment_type);
                        $("#appid").text(main_result.appointment_id);
                        $("#custname").text(main_result.cust_name);
                        $("#details").text(main_result.details);
                        // $("#notitype").text(main_result.appointment_type);
                        // $("#notitype").text(main_result.appointment_type);
                    }
                });
            }

        </script>

    </body>

</html>
