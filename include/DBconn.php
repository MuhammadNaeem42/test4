<?php

$servername = "db";
$username = "root";
$password = "user@123";
$dbname = "csk_bookingappointmentsystem";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn)
{
    die("Connection failed: " . mysqli_connect_error());        
}

?>
