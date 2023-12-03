<div class="">
<br><br><br>

<?php
session_start();
include "../include/DBconn.php";
$id = $_GET['id'];
$query=mysqli_query($conn,'select * from products where product_ID="'.$id.'"');
$row=mysqli_fetch_array($query);
?>

</div>

<?php

// Check if the product ID is set in the GET request
if(isset($_POST['product_ID'])) { 
    $productID = $_POST['product_ID'];
    $userID = $_SESSION['id']; // Ensure you have session started and user logged in

    // Check if the user already has a cart
    $cartCheck = mysqli_prepare($conn, "SELECT cart_id FROM Cart WHERE customer_id = ?");
    mysqli_stmt_bind_param($cartCheck, "i", $userID);
    mysqli_stmt_execute($cartCheck);
    $cartResult = mysqli_stmt_get_result($cartCheck);

    if(mysqli_num_rows($cartResult) == 0) {
        // If not, create a new cart for the user
        $cartInsert = mysqli_prepare($conn, "INSERT INTO Cart (customer_id) VALUES (?)");
        mysqli_stmt_bind_param($cartInsert, "i", $userID);
        mysqli_stmt_execute($cartInsert);
        $cartID = mysqli_insert_id($conn);
        mysqli_stmt_close($cartInsert);
    } else {
        // If the user already has a cart, get the existing cart ID
        $cart = mysqli_fetch_assoc($cartResult);
        $cartID = $cart['cart_id'];
    }
    mysqli_stmt_close($cartCheck);

    // Check if the product is already in the cart
    $itemCheck = mysqli_prepare($conn, "SELECT * FROM Cart_Items WHERE cart_id = ? AND product_id = ?");
    mysqli_stmt_bind_param($itemCheck, "ii", $cartID, $productID);
    mysqli_stmt_execute($itemCheck);
    $itemResult = mysqli_stmt_get_result($itemCheck);

    if(mysqli_num_rows($itemResult) > 0) {
        // If the product is already in the cart, increase the quantity
        $itemUpdate = mysqli_prepare($conn, "UPDATE Cart_Items SET quantity = quantity + 1 WHERE cart_id = ? AND product_id = ?");
        mysqli_stmt_bind_param($itemUpdate, "ii", $cartID, $productID);
        mysqli_stmt_execute($itemUpdate);
        mysqli_stmt_close($itemUpdate);
    } else {
        // If the product is not in the cart, add it
        $itemInsert = mysqli_prepare($conn, "INSERT INTO Cart_Items (cart_id, product_id, quantity) VALUES (?, ?, 1)");
        mysqli_stmt_bind_param($itemInsert, "ii", $cartID, $productID);
        mysqli_stmt_execute($itemInsert);
        mysqli_stmt_close($itemInsert);
    }
    mysqli_stmt_close($itemCheck);

    // Close the database connection
    mysqli_close($conn);

    // Redirect to mycart.php to view the cart
    header("Location: mycart.php");
} 
else {
    // Redirect back to product list if there's no product ID received
    header("Location: homepage.php"); // Change 'homepage.php' to your actual product list page
}
?>