<?php
session_start();
include "../include/DBconn.php";


if (isset($_POST['save_promotion']))
{
    $product_ID = mysqli_real_escape_string($conn, $_POST['product_ID']);
    $product_image = mysqli_real_escape_string($conn, $_POST['product_image']);
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_sname = mysqli_real_escape_string($conn, $_POST['product_sname']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $product_discount = mysqli_real_escape_string($conn, $_POST['product_discount']);
    $product_dprice = mysqli_real_escape_string($conn, $_POST['product_dprice']);
    

    $query = "INSERT INTO promotions (product_ID, product_image, product_name, product_sname, product_price, product_discount, product_dprice ) 
    VALUES ('$product_ID', '$product_image', '$product_name', '$product_sname', '$product_price', '$product_discount' , '$product_dprice')";

    $query_run = mysqli_query($conn, $query);


    if($query_run)
    {
        $_SESSION['message'] = "Promotion inserted into database successfully";
        header("Location: promotion.php");
        
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Promotion not inserted into database successfully";
        header("Location: promotion.php");
        
        exit(0);
    }
}


if(isset($_POST['update_promotion']))
{
    
    $product_ID = mysqli_real_escape_string($conn, $_POST['product_ID']);
    $product_image = mysqli_real_escape_string($conn, $_POST['product_image']);
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_sname = mysqli_real_escape_string($conn, $_POST['product_sname']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $product_discount = mysqli_real_escape_string($conn, $_POST['product_discount']);
    $product_dprice = mysqli_real_escape_string($conn, $_POST['product_dprice']);

    $query = "UPDATE promotions SET product_image='$product_image', product_name='$product_name', product_sname='$product_sname', product_price='$product_price', product_discount='$product_discount', product_dprice='$product_dprice' WHERE product_ID='$product_ID' ";

    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Promotion updated into database successfully";
        header("Location: promotion.php");
        
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Promotion not updated into database successfully";
        header("Location: promotion.php");
        
        exit(0);
    }
}


if(isset($_POST['delete_promotion']))
{
    $product_ID = mysqli_real_escape_string($conn, $_POST['delete_promotion']);

    $query = "DELETE FROM promotions WHERE product_ID='$product_ID'";
    $query_run = mysqli_query($conn, $query);


    if($query_run)
    {
        $_SESSION['message'] = "Promotion deleted from database successfully";
        header("Location: promotion.php");
        
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Promotion failed in deleting from database";
        header("Location: promotion.php");
        
        exit(0);
    }
}


?>