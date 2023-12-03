
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="Homepage" content="Homepage">
    <title>My Cart</title>

    <!-- CSS -->
    <link href="../style/Homepagex.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .product-img {
            width: 100px; /* Adjust as needed */
        }
        /* Add any additional custom styles here */
    </style>
</head>

<body>

    <!-- Nav bar -->
    <div class="">
        <br><br><br>
        <?php include("../include/navigation.php"); ?>
    </div>

    <?php
include "../include/DBconn.php";

$userId = $_SESSION['id'];

// Fetch the user's cart items
$cartItems = [];
$cartQuery = $conn->prepare("
    SELECT p.product_ID, p.product_name, p.product_price, p.product_image, ci.quantity, (p.product_price * ci.quantity) AS total_price 
    FROM Cart_Items AS ci 
    JOIN Products AS p ON ci.product_id = p.product_ID
    WHERE ci.cart_id = (SELECT cart_id FROM Cart WHERE customer_id = ?)
");
$cartQuery->bind_param("i", $userId);
$cartQuery->execute();
$result = $cartQuery->get_result();

while ($row = $result->fetch_assoc()) {
    $cartItems[] = $row;
}

$cartQuery->close();
?>


    <form action="buynow.php" method="post">
        <div class="container mt-5">
            <h2 class="text-center">My Cart</h2>

            <?php if ($cartItems): ?>
                <div class="row">
                    <?php foreach ($cartItems as $item): ?>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card mb-4">
                                <img src="../Homepage/Homepage_Images/<?php echo $item['product_image']; ?>" class="card-img-top product-img" alt="...">
                                <div class="card-body">

                                    
                                    <input type="checkbox" name="selectedProducts[]" value="<?php echo $item['product_ID']; ?>" class="form-check-input">
                                    <h5 class="card-title"><?php echo htmlspecialchars($item['product_name'], ENT_QUOTES, 'UTF-8'); ?></h5>
                                    <p class="card-text">
                                        Price: $<span class="price"><?php echo htmlspecialchars($item['product_price'], ENT_QUOTES, 'UTF-8'); ?></span>
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                        <button type="button" class="btn btn-secondary change-qty" data-direction="down" data-productid="<?php echo $item['product_ID']; ?>"> &#8722; </button>
                                            <span class="px-2 quantity"><?php echo htmlspecialchars($item['quantity'], ENT_QUOTES, 'UTF-8'); ?></span>
                                            <button type="button" class="btn btn-secondary change-qty" data-direction="up" data-productid="<?php echo $item['product_ID']; ?>"> &#43; </button>
                                        </div>
                                        <div>
                                            Total: $<span class="total"><?php echo htmlspecialchars($item['total_price'], ENT_QUOTES, 'UTF-8'); ?></span><br/><br/>
                                            <button class="btn btn-danger delete-item" data-productid="<?php echo $item['product_ID']; ?>">Delete</button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="selectedProducts[]" value="<?php echo $item['product_ID']; ?>">
                                    <input type="hidden" name="quantities[<?php echo $item['product_ID']; ?>]" value="<?php echo $item['quantity']; ?>"> <!-- Add this line -->
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" id="buyNowButton">Buy Now</button>
                </div>
            <?php else: ?>
                <p>Your cart is empty.</p>
            <?php endif; ?>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    // Function to update the quantity, used by both the quantity buttons and the delete button
    function updateQuantity(productId, newQty) {
        $.ajax({
            url: "update_cart.php",
            type: "POST",
            data: {
                productId: productId,
                newQty: newQty
            },
            dataType: "json",
            success: function(data) {
                if(data.success) {
                    // If the new quantity is zero, remove the item from the UI
                    if (newQty === 0) {
                        $('button.delete-item[data-productid="' + productId + '"]').closest('.col-12').remove();
                    } else {
                        // Otherwise, update the quantity and total in the UI
                        var quantityElement = $('button.change-qty[data-productid="' + productId + '"]').closest('.card-body').find('.quantity');
                        quantityElement.text(newQty);
                        $(quantityElement).closest('.card-body').find('.total').text(data.newTotal);
                    }
                } else {
                    alert('There was an error updating your cart. Error: ' + data.error);
                }
            },
            error: function(xhr, status, error) {
                alert('There was an error. Status: ' + status + ' Error: ' + error);
            }
        });
    }

    $("#buyNowButton").click(function(e){
        var atLeastOneChecked = false; // Variable to check if at least one checkbox is checked

        // Loop through each checkbox to see if at least one is checked
        $('input[type="checkbox"]').each(function() {
            if ($(this).is(":checked")) {
                atLeastOneChecked = true;
                return false; // Break out of the loop
            }
        });

        // If no checkboxes are checked, prevent form submission and show an alert
        if (!atLeastOneChecked) {
            e.preventDefault(); // Prevent form submission
            alert("No items are selected. Please select at least one item to proceed.");
        }
    });

    // Event handler for delete button
    $(".delete-item").click(function(){
        var productId = $(this).data("productid");
        var userConfirmed = confirm("Are you sure you want to remove this item from your cart?");
        if (userConfirmed) {
            updateQuantity(productId, 0); // Set quantity to zero, effectively deleting the item
        }
    });

    // Event handler for change quantity buttons
    $(".change-qty").click(function(e){
        e.preventDefault(); // Prevent the default action

        var productId = $(this).data("productid");
        var direction = $(this).data("direction");
        var quantityElement = $(this).closest('.card-body').find('.quantity');
        var currentQty = parseInt(quantityElement.text());
        var newQty = (direction === "up") ? currentQty + 1 : currentQty - 1;

        if (newQty === 0) {
            var userConfirmed = confirm("Do you want to remove this item from your cart?");
            if (userConfirmed) {
                updateQuantity(productId, 0); // Set quantity to zero, effectively deleting the item
            } else {
                newQty = 1; // If user cancels deletion, reset quantity to 1
                updateQuantity(productId, newQty);
            }
        } else if (newQty > 0) {
            updateQuantity(productId, newQty); // Normal update for quantities greater than zero
        }
    });

});

</script>

</body>
</html>
