<?php

include "../include/DBconn.php";

// echo $_SESSION['email'];

// Check if image file is a actual image or fake image
$image_url = "http://localhost/booking-appointment-system/Homepage/Homepage_Images/";
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

<!-- Nav bar -->
<?php
include("../include/navigation.php");
include("../include/DBconn.php");
?>
<div class="container" style="margin-top: 150px">
  <div class="content container">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      Add Product
    </button>

    <!-- MODEL FOR INSErTION -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="upload.php" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="productName">Product Name</label>
                <input type="text" class="form-control" id="productName" name="productName" placeholder="Enter Prodcut name">
              </div>
              <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="product price">
              </div>
              <div class="form-group">
                <label for="pdesc">Product Description</label>
                <textarea type="text" class="form-control" id="pdesc" name="pdesc" placeholder="product description" ></textarea>
              </div>
              <div class="form-group">
                <label for="pqnt">Quantity</label>
                <input type="number" class="form-control" id="pqnt" name="pqnt" placeholder="product quantity">
              </div>
              <div class="form-group">
                <label for="image">Product Image</label>
                <input type="file" class="form-control" name="image" id="image" required="">
              </div>
              <div class="form-group">
                  <label for="category">Product Category</label>
                  <select name="category" id="category" class="form-control">
                      <option value="clothing">Clothing</option>
                      <option value="footwear">Footwear</option>
                      <option value="plants">Plants</option>
                      <option value="house_decor">House and Decor</option>
                      <option value="house_decor">Electronics</option>
                  </select>
              </div>
              <div class="form-group">
                  <label for="promoted">Promotion</label>
                  <select name="promoted" id="promoted" class="form-control">
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                  </select>
              </div>
              <input type="hidden" id="date" name="date_added" value="<?php echo date('Y-m-d'); ?>">
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" name="submit" class="btn btn-primary" value="Add">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Model for EDIT -->
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editModelLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body ">

            <div class="edit-form">
              <!-- show data here -->
            </div>

          </div>
        </div>
      </div>
    </div>

    <table id="example" class="table table-striped table-bordered" style="width:100%; ">
      <thead>
        <tr>
          <th>ID</th>
          <th>NAME</th>
          <th>PRICE</th>
          <th>CATEGORY</th>
          <th>PROMOTED</th>
          <th>DATE</th>          
          <th>PROMO PRICE</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = mysqli_query($conn, "SELECT * FROM products");
        while ($row = mysqli_fetch_array($query)) {
          # code...

          echo '
            <tr>
                <td>' . $row['product_ID'] . '</td>
                <td>' . $row['product_name'] . '</td>
                <td>' . $row['product_price'] . '</td>
                <td>' . $row['category'] . '</td>
                <td>' . $row['promoted'] . '</td>
                <td>' . $row['date'] . '</td>
                <td>' . $row['promo_price'] . '</td>
                <td><a href="edit-product.php?id=' . $row['product_ID'] . '&name=' . $row['product_name'] . '" class="edit"><i class="fa fa-edit"></i></a>  <br><a href="upload.php?delete_id=' . $row["product_ID"] . '" onclick="return confirmDelete()"><i class="fa fa-trash"></i></a></td>
            </tr>';
        }
        ?>

      </tbody>
      <!-- <tfoot>
        <tr>
          <th>ID</th>
          <th>Image</th>
          <th>NAME</th>
          <th>SNAME</th>
          <th>Action</th>
        </tr>
      </tfoot> -->
    </table>
  </div>
</div>


<?php include('../include/footer.php') ?>

<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>



<script>
  $(document).ready(function() {
    $('#example').DataTable();
  });



  //Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  var pusher = new Pusher('e43d8cddaeae61172fde', {
    cluster: 'ap1'
  });

  var channel = pusher.subscribe('my-channel');
  channel.bind('my-event', function(data) {
    //alert(JSON.stringify(data));
    $.ajax({
      url: "real_time.php",
      success: function(result) {
        $("#result").html(result);
      }
    });
  });

  function loadData(button) {
    var appointment_id = button.id
    $.ajax({
      url: "appoint.php",
      method: "GET",
      data: {
        "appointment_id": appointment_id
      },
      success: function(response) {
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
  //appointment_id, appointment_type, cust_name, details, noti_date, noti_day, noti_time
  function confirmDelete() {
    if (confirm("Delete Record?") == true) {
      alert("Now deleting");
      return true;
    } else {
      alert("Cancelled by user");
      return false;
    }
  }
</script>

</body>

</html>