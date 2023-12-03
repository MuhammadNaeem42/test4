<!-- Nav bar -->
<?php
// Check if the user is logged in and has a role type

session_start();
echo
'<nav class="navbar navbar-expand-sm shadow fixed-top bg-white" >
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
            <img src="../Homepage/Homepage_Images/logo1.jpg" alt="logo" style="width:90px;" class="rounded-pill"> 
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class ="collapse navbar-collapse" id="navMenu">
                <ul class ="navbar-nav mx-auto text-end">
                    <li class ="nav-item px-2 py-2">
                        <a class ="nav-link text-uppercase text-dark" href="./../Homepage/Homepage.php">
                            Home
                        </a>
                    

                    ';
                    if ($_SESSION['roleID'] == '1'){
                    echo '
                    <li class="nav-item px-2 py-2 dropdown">
                        <a class="nav-link text-uppercase text-dark dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Orders
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../Homepage/toShip.php">To Ship</a>
                            <a class="dropdown-item" href="../Homepage/toReceive.php">To Receive</a>
                            <a class="dropdown-item" href="../Homepage/completed.php">Completed</a>
                            <a class="dropdown-item" href="../Homepage/cancelled.php">Cancelled</a>
                        </div>
                    </li>

                    <li class ="nav-item px-2 py-2">
                        <a class ="nav-link text-uppercase text-dark" href="./../Homepage/notifications.php">
                            Notification
                        </a>
                    </li>

                    <li class="nav-item px-2 py-2 dropdown">
                        <a class="nav-link text-uppercase text-dark dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Product
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../Homepage/clothes.php">Clothing</a>
                            <a class="dropdown-item" href="../Homepage/footwear.php">Footwear</a>
                            <a class="dropdown-item" href="../Homepage/decor.php">House and Decor</a>
                            <a class="dropdown-item" href="../Homepage/electronics.php">Electronics</a>
                            <a class="dropdown-item" href="../Homepage/plants.php">Plants</a>
                        </div>
                    </li>
                
                    </li>
                    ';
                    } 
                    if ($_SESSION['roleID'] == '2'){
                    echo'    
                    <li class ="nav-item px-2 py-2">
                    <a class ="nav-link text-uppercase text-dark" href="./../Appointment/add_product.php">
                        Add Product
                    </a>
                </li> 

                <li class ="nav-item px-2 py-2">
                    <a class ="nav-link text-uppercase text-dark" href="./../Homepage/seller_dashboard.php">
                        Dashboard
                    </a>
                </li> 

                <li class ="nav-item px-2 py-2">
                    <a class ="nav-link text-uppercase text-dark" href="./../Homepage/seller_notifications.php">
                        Notifications
                    </a>
                </li> 
                    
                <li class ="nav-item px-2 py-2">
                <a class ="nav-link text-uppercase text-dark" href="./../Homepage/products.php">
                    Products
                </a>
            </li>

            <li class="nav-item px-2 py-2 dropdown">
                        <a class="nav-link text-uppercase text-dark dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Orders
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../Homepage/seller_toShip.php">To Ship</a>
                            <a class="dropdown-item" href="../Homepage/seller_toReceive.php">To Receive</a>
                            <a class="dropdown-item" href="../Homepage/seller_completed.php">Completed</a>
                            <a class="dropdown-item" href="../Homepage/seller_cancelled.php">Cancelled</a>
                        </div>
                    </li>
                ';

                    } 

                    if ($_SESSION['roleID'] == '3') {
                        echo'
                        <li class="nav-item px-2 py-2 dropdown">
                        <a class="nav-link text-uppercase text-dark dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Users
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../Homepage/admin_customer.php">Customers</a>
                            <a class="dropdown-item" href="../Homepage/admin_seller.php">Sellers</a>

                        </div>
                    </li>

                    <li class ="nav-item px-2 py-2">
                    <a class ="nav-link text-uppercase text-dark" href="./../Homepage/admin_complaints.php">
                    Reports
                    </a>
                </li> 

                <li class ="nav-item px-2 py-2">
                    <a class ="nav-link text-uppercase text-dark" href="./../Homepage/logs.php">
                    Activity Logs
                    </a>
                </li> 


                    ';
                    }
                    
                    echo'

                    
                    
                    
                    <li class ="nav-item px-2 py-2">
                        <a class ="nav-link text-uppercase text-dark" href="./../Enquiry/Enquiry.php">
                            Enquiry
                        </a>
                    </li>

                    <li class ="nav-item px-2 py-2">
                        <a class ="nav-link text-uppercase text-dark" href="./../profile/home.php">
                            Profile
                        </a>
                    </li> 
                    
                  
                </ul>'; 
                
                

            

                if ($_SESSION['roleID'] == '1'){
                    echo'
                    <ul class="navbar-nav justify-content-end">
                    <li class="nav-item px-2 py-2">
                    <a href="./../Homepage/mycart.php" class="btn btn-danger">My Cart</a>

                    </li>
                </ul>
                    '; 
                } 
                echo'



                <ul class="navbar-nav justify-content-end">
                    <li class="nav-item px-2 py-2">
                    <a href="./../LogINOUT/logout.php" class="btn btn-danger">Logout</a>

                    </li>
                </ul>
            </div>
        </div>
    </nav>';
?>
