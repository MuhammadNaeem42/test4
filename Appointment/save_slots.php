<?php 
session_start();
require_once('./../include/DBconn.php');

extract($_POST);
$aRanges = explode(' - ', $_POST['aptDate']);
$aptDate_start = date('Y-m-d',strtotime($aRanges[0]));
$aptDate_end = date('Y-m-d',strtotime($aRanges[1]));

$period = new DatePeriod(
    new DateTime($aptDate_start),
    new DateInterval('P1D'),
    new DateTime($aptDate_end)
);



foreach ($period as $date) {
    $date = $date->format("Y-m-d");
    $query = $conn->query("SELECT aptSlots FROM `booking_slots` WHERE aptSlots = '{$date}'");
    if (!mysqli_num_rows($query)){
        $dates[] = $date;
    }
}


$sql = "INSERT INTO `booking_slots` (`aptSlots`) VALUES ";

for ($x = 0; $x < count($dates); $x++){
    $sql .= "('$dates[$x]'),";
}
$sql .= "('$aptDate_end')";

$save = $conn->query($sql);



if($save){
    echo "<script> alert('Booking Slots Successfully Saved.'); location.replace('./admin_appointment.php') </script>";
}else{
    echo "<pre>";
    echo "An Error occured.<br>";
    echo "Error: ".$conn->error."<br>";
    echo "SQL: ".$sql."<br>";
    echo "</pre>";
}
$conn->close();

?>