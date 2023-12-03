<?php 
include "../include/DBconn.php";

if (isset($_POST['product_id'])) {
   $query=mysqli_query($conn,"select * FROM products where id ='".$_POST['product_id']."'");
   $row=mysqli_fetch_array($query);
   echo '
   <p id="show-here"></p>
   <div class="form-group">
    <label for="productName">Product Name</label>
    <input type="text" class="form-control" id="productName" name="productName" value="'.$row['name'].'" placeholder="Enter Prodcut name">
  </div>
   <div class="form-group">
    <label for="price">Price</label>
    <input type="text" class="form-control" id="price" name="price" value="'.$row['price'].'" placeholder="product price">
  </div>
  <div class="form-group">
    <label for="image">Product Image</label>
    <input type="file" class="form-control" name="image" id="image" value="'.$row['image'].'">
    <span>"'.$row['image'].'"</span>
  </div>
 <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" id="'.$row['id'].'" name="update"  class="btn btn-primary update" value="Update">
      </div>
      <input type="hidden" id="uploaded_image" value="'.$row['image'].'">
     

       
   ';
}


/*if (isset($_POST['update'])) {
    // code...
    $target_dir = "../Product crud/uploaded_img/";

$fileName = basename($_FILES["image"]["name"]);
$targetFilePath = $target_dir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);



$product_name=$_POST['productName'];
$price=$_POST['price'];
$uploaded_image=$_POST['uploaded_image'];


if (!empty($_FILES["image"]["name"])  ) {

$target_dir = "../Product crud/uploaded_img/";
$fileName = basename($_FILES["image"]["name"]);
$targetFilePath = $target_dir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    // code...
       if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
    $query = mysqli_query($conn,'update products SET name="'.$product_name.'",price="'.$price.'",image="'.$fileName.'")');
    if ($query) {
       // echo "<script>alert('Product Added');</script>";
        header("Location: add_product.php");
    }
  }

}
else
{
    $product_name=$_POST['productName'];
$price=$_POST['price'];
$uploaded_image=$_POST['uploaded_image'];
 $query = mysqli_query($conn,'update products SET name="'.$product_name.'",price="'.$price.'",image="'.$uploaded_image.'")');
 if ($query) {
       // echo "<script>alert('Product Added');</script>";
        header("Location: add_product.php");
    }
}


}*/
?>


<script>
    $(document).ready(function(){
        $('.update').click(function(){
            var product_id=$(this).attr('id');
            var product_name=$('#productName').val();
            var price=$('#price').val();
            var uploaded_image=$('#uploaded_image').val();

            alert(product_id + $('#productName').val() + price + uploaded_image);
            var form_data=new FormData();
            form_data.append("product_id",product_id);
        form_data.append("product_name",product_name);
        form_data.append("price",price);
        form_data.append("image", document.getElementById('image').files[0]);
        form_data.append("uploaded_image",uploaded_image);
        
    $.ajax({
    url:"update.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    
    success:function(data)
    {
     $('#show-here').html(data);
     //location.relaod();
     //location.reload();
    //window.location.reload();
    }
    });
        })
    })
</script>
