<?php 
include "../include/DBconn.php";

   // code...
   if(!empty($_FILES["image"]["name"])){
      $target_dir = "../Product crud/uploaded_img/";

$fileName = basename($_FILES["image"]["name"]);
$targetFilePath = $target_dir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
move_uploaded_file($_FILES["image"]["tmp_name"], $location_folder);
$sql=mysqli_query($conn,'update products set `name`="'.$_POST['product_name'].'",`price`="'.$_POST['price'].'",`image`="'.$fileName.'",`category`="'.$catg.'" where id="'.$_POST['product_id'].'"');
if (!$sql) {
   // code...
   echo mysqli_error($conn);
}
   }

   else
   {
   	echo $_POST['product_name'];
   //	$sql=mysqli_query($conn,'update products set `name`="'.$_POST['product_name'].'",`price`="'.$_POST['price'].'",`image`="'.$_POST['uploaded_image'].'" where id="'.$_POST['product_id'].'"');
   }


?>
