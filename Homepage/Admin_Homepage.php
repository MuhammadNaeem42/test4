<?php 

session_start();
php_info();
include "../include/DBconn.php";

if(!isset($_SESSION['email'])){
    header('location: /booking-appointment-system/LogINOUT/login.php');
}

$salesQuery = "SELECT DATE_FORMAT(order_date, '%Y-%m') as month, SUM(total_price) as total_sales 
               FROM orders 
               GROUP BY month 
               ORDER BY month";
$salesResult = mysqli_query($conn, $salesQuery);
$salesData = [];
while($row = mysqli_fetch_assoc($salesResult)) {
    $salesData['labels'][] = $row['month'];
    $salesData['data'][] = $row['total_sales'];
}

$orderStatusQuery = "SELECT order_status, COUNT(*) as count FROM orders GROUP BY order_status";
$orderStatusResult = mysqli_query($conn, $orderStatusQuery);
$orderStatusData = [];
while($row = mysqli_fetch_assoc($orderStatusResult)) {
    $orderStatusData['labels'][] = $row['order_status'];
    $orderStatusData['data'][] = $row['count'];
}


$inventoryQuery = "SELECT product_name, product_qnt FROM products";
$inventoryResult = mysqli_query($conn, $inventoryQuery);
$inventoryData = [];
while($row = mysqli_fetch_assoc($inventoryResult)) {
    $inventoryData['labels'][] = $row['product_name'];
    $inventoryData['data'][] = $row['product_qnt'];
}


$registrationQuery = "SELECT DATE_FORMAT(registration_date, '%Y-%m') as month, COUNT(*) as count 
                      FROM users 
                      GROUP BY month 
                      ORDER BY month";
$registrationResult = mysqli_query($conn, $registrationQuery);
$registrationData = [];
while($row = mysqli_fetch_assoc($registrationResult)) {
    $registrationData['labels'][] = $row['month'];
    $registrationData['data'][] = $row['count'];
}

// Fetch Data for Various Tables
// Activity Log
$activityLogQuery = "SELECT users.name, activity_logs.action, activity_logs.timestamp 
                     FROM activity_logs 
                     JOIN users ON activity_logs.user_id = users.id 
                     ORDER BY activity_logs.timestamp DESC 
                     LIMIT 10";
$activityLogResult = mysqli_query($conn, $activityLogQuery);

// Top Selling Products
$topSellingQuery = "SELECT products.product_name, SUM(orderdetails.quantity) as total_sold 
                    FROM orderdetails 
                    JOIN products ON orderdetails.product_id = products.product_ID 
                    GROUP BY products.product_ID 
                    ORDER BY total_sold DESC 
                    LIMIT 10";
$topSellingResult = mysqli_query($conn, $topSellingQuery);

// Refund Request Status
$refundRequestQuery = "SELECT order_id, reason, status FROM refundrequests ORDER BY created_at DESC LIMIT 10";
$refundRequestResult = mysqli_query($conn, $refundRequestQuery);

// New User Registrations
$newUsersQuery = "SELECT name, email, registration_date FROM users ORDER BY registration_date DESC LIMIT 10";
$newUsersResult = mysqli_query($conn, $newUsersQuery);




?>

<!-- Admin homepage -->

<!DOCTYPE html>
<hmtl lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name = "Homepage" content = "Homepage">
        <title>Booking Appointment System</title>

        <!-- CSS -->
        <link href="../style/Homepage.css" rel="stylesheet">
        

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .chart-container {
            width: 80%;
            margin: 20px auto;
        }
        .chart {
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        .table-container {
            margin-top: 20px;
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>



    <body>
        
        <?php include("../include/navigation.php"); ?>

        <!-- Introduction row -->
        <div class = "row col-12 mx-auto shadow">
            <div class = "col xcol col-after">
                <br><br><br><br>
                <h1> 
                   All things Essentials
                </h1>
                <h3>
                    Everything You Need 
                </h3>
                <br>
                <h4 style="padding-right: 100px;">
                    "One Marketplace, Three Perspectives." 
                    Customers Shop, Sellers Profit, Admins Oversee. 
                    Welcome to All Things Essentials - Where Everyone Connects
                </h4>
                <br><br><br>


            </div>

            
            <div class ="col" style="padding: 0">
                <img src="Homepage_Images/5background.png" alt="background" style="width: 100%; padding: 0;">
            </div>
        </div>


        <div class="container mt-4">
        <h1 class="text-center mb-4">Admin Dashboard</h1>

        <!-- Sales Chart -->
        <div class="chart-container">
            <div class="chart">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <!-- Order Status Chart -->
        <div class="chart-container">
            <div class="chart">
                <canvas id="orderStatusChart"></canvas>
            </div>
        </div>

        <!-- Inventory Chart -->
        <div class="chart-container">
            <div class="chart">
                <canvas id="inventoryChart"></canvas>
            </div>
        </div>

        <!-- User Registrations Chart -->
        <div class="chart-container">
            <div class="chart">
                <canvas id="registrationChart"></canvas>
            </div>
        </div>

        <!-- Recent Activity Log Table -->
        <div class="table-container">
            <h2>Recent Activity Log</h2>
            <table class="table table-striped" id="activityLogTable">
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Action</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($activityLogResult)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['action']); ?></td>
                            <td><?php echo htmlspecialchars($row['timestamp']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Top Selling Products Table -->
        <div class="table-container">
            <h2>Top Selling Products</h2>
            <table class="table table-striped" id="topSellingTable">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Total Sold</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($topSellingResult)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['total_sold']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Refund Request Status Table -->
        <div class="table-container">
            <h2>Refund Request Status</h2>
            <table class="table table-striped" id="refundRequestTable">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Reason</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($refundRequestResult)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['order_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['reason']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- New User Registrations Table -->
        <div class="table-container">
            <h2>New User Registrations</h2>
            <table class="table table-striped" id="newUsersTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Registration Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($newUsersResult)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['registration_date']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    
    </div>

    <!-- jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <script>


$(document).ready(function() {
            $('#activityLogTable').DataTable();
            $('#topSellingTable').DataTable();
            $('#refundRequestTable').DataTable();
            $('#newUsersTable').DataTable();
        });


        console.log(<?php echo json_encode($salesData); ?>);
    console.log(<?php echo json_encode($orderStatusData); ?>);

        // JavaScript for Sales Chart
        const salesCtx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($salesData['labels']); ?>,
            datasets: [{
                label: 'Total Sales',
                data: <?php echo json_encode($salesData['data']); ?>,
                backgroundColor: 'rgba(0, 123, 255, 0.5)',
                borderColor: 'rgba(0, 123, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

        // JavaScript for Order Status Chart
        const orderStatusCtx = document.getElementById('orderStatusChart').getContext('2d');
    const orderStatusChart = new Chart(orderStatusCtx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($orderStatusData['labels']); ?>,
            datasets: [{
                data: <?php echo json_encode($orderStatusData['data']); ?>,
                backgroundColor: ['red', 'blue', 'green', 'yellow'],
            }]
        },
        options: {
            responsive: true,
        }
    });

        // JavaScript for Inventory Chart
        const inventoryCtx = document.getElementById('inventoryChart').getContext('2d');
    const inventoryChart = new Chart(inventoryCtx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($inventoryData['labels']); ?>,
            datasets: [{
                label: 'Inventory Quantity',
                data: <?php echo json_encode($inventoryData['data']); ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
        // JavaScript for User Registrations Chart
        const registrationCtx = document.getElementById('registrationChart').getContext('2d');
    const registrationChart = new Chart(registrationCtx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($registrationData['labels']); ?>,
            datasets: [{
                label: 'User Registrations',
                data: <?php echo json_encode($registrationData['data']); ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

        // Add JavaScript for additional charts here
    </script>


   </body>

       <?php include('../include/footer.php') ?>

</hmtl>
