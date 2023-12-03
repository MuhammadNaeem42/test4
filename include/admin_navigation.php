<!-- Nav bar -->
<?php
    echo
    '<nav class="navbar navbar-expand-sm shadow fixed-top bg-white" >
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
            <img src="../Homepage/Homepage_Images/logo.jpg" alt="logo" style="width:90px;" class="rounded-pill"> 
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class ="collapse navbar-collapse" id="navMenu">
                <ul class ="navbar-nav mx-auto text-end">
                    <li class ="nav-item px-2 py-2">
                        <a class ="nav-link text-uppercase text-dark" href="./../Homepage/Admin_Homepage.php">
                            Home
                        </a>
                    </li>
                      <li class ="nav-item px-2 py-2">
                        <a class ="nav-link text-uppercase text-dark" href="./../Appointment/add_product.php">
                            Add Product
                        </a>
                    </li>
                    <li class ="nav-item px-2 py-2">
                        <a class ="nav-link text-uppercase text-dark" href="./../Appointment/admin_appointment.php">
                            Appointment
                        </a>
                    </li>
                    <li class ="nav-item px-2 py-2">
                        <a class ="nav-link text-uppercase text-dark" href="./../Notification/Admin_notification.php">
                            Notification
                        </a>
                    </li>
                    <li class ="nav-item px-2 py-2">
                        <a class ="nav-link text-uppercase text-dark" href="./../Enquiry/Admin_Enquiry.php">
                            Enquiry
                        </a>
                    </li>
                    </li>
                    <li class ="nav-item px-2 py-2">
                        <a class ="nav-link text-uppercase text-dark" href="./../Report/admin_report.php">
                            Report
                        </a>
                    </li>
                    </li>
                    <li class ="nav-item px-2 py-2">
                        <a class ="nav-link text-uppercase text-dark" href="./../Homepage/seller.php">
                           Seller
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav justify-content-end">
                    <li class="nav-item px-2 py-2">
                    <a href="./../LogINOUT/forgot_password.php" class="switcher-text2 mx-3 btn btn-outline-primary">Change Password</a>

                    <a href="./../LogINOUT/logout.php" class="btn btn-danger">Logout</a>

                    </li>
                </ul>
            </div>
        </div>
    </nav>'
?>
