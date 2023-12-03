<?php 
session_start();
include "../include/DBconn.php";
//echo 'test';
// Check if image file is a actual image or fake image

if(isset($_POST["submit"]) && isset($_FILES['image']["name"])) {
$target_dir = "../Homepage/Homepage_Images/";

$fileName = basename($_FILES["image"]["name"]);
$targetFilePath = $target_dir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);


$product_name=$_POST['productName'];
$price=$_POST['price'];
$product_desc= $_POST['pdesc'];
$qnt= $_POST['pqnt'];
$catg = $_POST['category'];
$promo = $_POST['promoted'];

   if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
    $query = mysqli_query($conn,'INSERT INTO products (`product_name`, `product_price`, `product_image`,`product_desc`,`product_qnt`, `category`, `promoted`) values ("'.$product_name.'","'.$price.'","'.$fileName.'","'.$product_desc.'","'.$qnt.'" ,"'.$catg.'", "'.$promo.'")');
    if ($query) {
       // echo "<script>alert('Product Added');</script>";
        header("Location: add_product.php");
    }
  }
}
if(isset($_GET['delete_id'])){
$delete_id = $_GET['delete_id'];

//$select=mysqli_query($conn,'SELECT * FROM promotions where produtc_ID="'.$.'"');

$query=mysqli_query($conn,'DELETE FROM `products` WHERE product_ID="'.$delete_id.'"');
if ($query) {
   // code...
/*   $filepath='../uploaded files/' . $file_name;

unlink($filepath);
*/   echo '<script>alert()</script>';
header("Location: add_product.php");

}
}


if(isset($_POST["update"]) && isset($_FILES['image']["name"]) && isset($_GET['id'])) {
   $id = $_GET['id'];
$target_dir = "../Homepage/Homepage_Images/";

$fileName = basename($_FILES["image"]["name"]);
$targetFilePath = $target_dir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);



$product_name=$_POST['productName'];
$price=$_POST['price'];
$product_desc= $_POST['pdesc'];
$qnt= $_POST['pqnt'];
$catg = $POST['category'];


   if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
    $query = mysqli_query($conn,'update products set product_name="'.$product_name.'",product_price="'.$price.'",product_image="'.$fileName.'",product_desc="'.$product_desc.'", product_qnt="'.$qnt.'", category="' .$catg. '" where product_ID ="'.$id.'" ') ;
    if ($query) {
       // echo "<script>alert('Product Added');</script>";
        header("Location: add_product.php");
    }
  }
}
?>
