<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "csk_bookingappointmentsystem");
$GLOBALS['conn'] = $conn;

if (!isset($_SESSION['email'])) {
    header('location: ../LogINOUT/login.php');
}
function NumberOfAppointmentsPerDay()
{
    $sql = "SELECT COUNT(member_id) AS Appointments, CAST(aptDate as DATE) AS Date FROM booking_list GROUP BY CAST(aptDate as DATE)";
    $result = $GLOBALS['conn']->query($sql) or die($GLOBALS['conn']->error);
    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}
$chart_data = NumberOfAppointmentsPerDay();


// Which time is most preferred
function TimeMostPreferred()
{
    $sql = "SELECT COUNT(member_id) AS Appointments, CAST(aptTime as TIME) AS TIME FROM booking_list GROUP BY CAST(aptTime as TIME)";
    $result = $GLOBALS['conn']->query($sql) or die($GLOBALS['conn']->error);
    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}
$chart_data2 = TimeMostPreferred();

mysqli_close($GLOBALS['conn']);

?>

<!DOCTYPE html>
<hmtl lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="Homepage" content="Homepage">
        <title>Booking Appointment System</title>

        <!-- CSS -->
        <link href="../style/Homepage.css" rel="stylesheet">

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">


    </head>


    <body>
        <?php include '../include/admin_navigation.php' ?>

        <div id="barchart_material" style="width: 700px; height: 500px; margin-top: 90px; margin-left:320px;"></div>

        <div id="barchart2" style="width: 700px; height: 500px; margin-top: 90px; margin-left:320px; margin-bottom: 30px;"></div>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);
            google.charts.setOnLoadCallback(drawChart2);
            google.charts.setOnLoadCallback(drawChart3);


            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['DATE', 'APPT.'],
                    <?php
                    foreach ($chart_data as $key => $value) {
                        echo "['" . date("d F Y", strtotime($value['Date'])) . "'," . $value['Appointments'] . "],";
                    }
                    ?>
                ]);
                var options = {
                    title: 'Number Of Appointments per Day'
                };
                var chart = new google.visualization.ColumnChart(document.getElementById('barchart_material'));
                chart.draw(data, options);
            }

            function drawChart2() {
                var data = google.visualization.arrayToDataTable([
                    ['TIME', 'Number APPT.'],
                    <?php
                    foreach ($chart_data2 as $key => $value) {
                        echo "['" . $value['TIME'] . "'," . $value['Appointments'] . "],";
                    }
                    ?>
                ]);
                var options = {
                    title: 'Most Preferred Time'
                };
                var chart2 = new google.visualization.ColumnChart(document.getElementById('barchart2'));
                chart2.draw(data, options);
            }
        </script>

      
    </body>
</hmtl>
