<?php 
include "../include/DBconn.php";
?>


<!DOCTYPE html>
<hmtl lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name = "Homepage" content = "Homepage">
        <title>Booking-Appointment-System</title>

        <!-- CSS -->
        <link href="../style/Homepagex.css" rel="stylesheet">

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>


    <body>

        <!-- Nav bar -->
        <div class="">
            <br><br><br>
            <?php include("../include/navigation.php"); ?>
        </div>

        <!-- Add a section for displaying activity logs -->
        <div class="container mt-4">
            <h2>User Activity Logs</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT users.first_name, users.last_name, users.email, activity_logs.action, activity_logs.timestamp 
                              FROM activity_logs 
                              JOIN users ON activity_logs.user_id = users.id 
                              ORDER BY activity_logs.timestamp DESC";

                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["first_name"] . $row["last_name"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["action"] . "</td>";
                            echo "<td>" . $row["timestamp"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No activity logs found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Include other sections of your page here... -->
        
        <?php include('../include/footer.php') ?>
    </body>
</html>
