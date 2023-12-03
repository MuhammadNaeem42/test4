
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <title>Seller Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="../style/Homepage.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    padding-top: 70px; /* Adjust this value based on your navbar's height */
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

    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <?php include("../include/navigation.php"); ?>

    <?php 
include "../include/DBconn.php";

if(!isset($_SESSION['id'])) {
    header('location: /login.php');
    exit;
}

$sellerId = $_SESSION['id']; // Assuming seller_id is stored in the session

$totalSalesQuery = "SELECT DATE_FORMAT(o.order_date, '%Y-%m') AS month, SUM(od.quantity) AS total_quantity
                    FROM orders o
                    JOIN orderdetails od ON o.order_id = od.order_id
                    JOIN products p ON od.product_id = p.product_ID
                    WHERE p.seller_id = $sellerId
                    GROUP BY month
                    ORDER BY month";
$totalSalesResult = mysqli_query($conn, $totalSalesQuery);

$totalSalesChartData = ['labels' => [], 'data' => []];
while ($row = mysqli_fetch_assoc($totalSalesResult)) {
    $totalSalesChartData['labels'][] = $row['month'];
    $totalSalesChartData['data'][] = $row['total_quantity'];
}

$productPopularityQuery = "SELECT p.product_name, SUM(od.quantity) AS total_sold
                           FROM products p
                           JOIN orderdetails od ON p.product_ID = od.product_id
                           WHERE p.seller_id = $sellerId
                           GROUP BY p.product_ID
                           ORDER BY total_sold DESC";
$productPopularityResult = mysqli_query($conn, $productPopularityQuery);

$productPopularityChartData = ['labels' => [], 'data' => []];
while ($row = mysqli_fetch_assoc($productPopularityResult)) {
    $productPopularityChartData['labels'][] = $row['product_name'];
    $productPopularityChartData['data'][] = $row['total_sold'];
}

// Prepare data for the Sales Summary Chart
$salesSummaryChartData = ['labels' => [], 'data' => []];
$salesSummaryQuery = "SELECT p.product_name, SUM(od.quantity) AS total_sold 
                      FROM orderdetails od 
                      JOIN products p ON od.product_id = p.product_ID 
                      WHERE p.seller_id = $sellerId 
                      GROUP BY p.product_ID";
$salesSummaryResult = mysqli_query($conn, $salesSummaryQuery);
while($row = mysqli_fetch_assoc($salesSummaryResult)) {
    $salesSummaryChartData['labels'][] = $row['product_name'];
    $salesSummaryChartData['data'][] = $row['total_sold'];
}
?>

<div class="container mt-4">
        <h1>Seller Dashboard</h1>

        <!-- Seller's Products Chart -->
        <div class="chart-container">
    <canvas id="totalSalesChart"></canvas>
</div>
<div class="chart-container">
    <canvas id="productPopularityChart"></canvas>
</div>

        <!-- Sales Summary Chart -->
        <div class="chart-container">
            <canvas id="salesSummaryChart"></canvas>
        </div>
    </div>


    <!-- jQuery for Bootstrap functionality (if needed) -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>


    <script>
    // Assuming you have PHP variables containing data for the charts
    // Replace the PHP echo statements with your actual PHP variables

    // Chart for Total Sales Over Time
    const totalSalesCtx = document.getElementById('totalSalesChart').getContext('2d');
    const totalSalesChart = new Chart(totalSalesCtx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($totalSalesChartData['labels']); ?>,
            datasets: [{
                label: 'Total Sales',
                data: <?php echo json_encode($totalSalesChartData['data']); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Chart for Product Popularity
    const productPopularityCtx = document.getElementById('productPopularityChart').getContext('2d');
    const productPopularityChart = new Chart(productPopularityCtx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($productPopularityChartData['labels']); ?>,
            datasets: [{
                label: 'Total Sold',
                data: <?php echo json_encode($productPopularityChartData['data']); ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // JavaScript for Sales Summary Chart
    const salesSummaryCtx = document.getElementById('salesSummaryChart').getContext('2d');
    const salesSummaryChart = new Chart(salesSummaryCtx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($salesSummaryChartData['labels']); ?>,
            datasets: [{
                label: 'Total Sold',
                data: <?php echo json_encode($salesSummaryChartData['data']); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    // Add more colors for each segment
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    // Add more border colors for each segment
                ],
                borderWidth: 1
            }]
        }
    });
</script>

    <!-- Include other JavaScript as needed -->

    <?php include('../include/footer.php'); ?>
</body>
</html>
