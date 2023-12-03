<?php
include("../include/navigation.php"); 
include "../include/DBconn.php";
// Assuming you have a session management file

$user_id = $_SESSION['id']; // Get the logged-in user's ID from the session

// Fetch all notifications for the logged-in user
$notifications_query = "SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC";
$stmt = mysqli_prepare($conn, $notifications_query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... meta tags, CSS links ... -->
    <title>Notifications</title>
    <!-- CSS -->
    <link href="../style/Homepagex.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            padding-top: 80px; /* Adjust this value to match the height of your navigation bar */
            background-color: #f7f7f7; /* Light grey background */
            font-family: 'Arial', sans-serif; /* Standard web-safe font */
        }

        .container {
            background-color: #fff; /* White background for content */
            border-radius: 8px; /* Rounded corners for container */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
            padding: 20px; /* Spacing inside the container */
            margin-bottom: 30px; /* Spacing below the container */
        }

        h1 {
            color: #333; /* Dark grey color for headings */
            margin-bottom: 20px; /* Spacing below the heading */
        }

        .table {
            margin-top: 20px; /* Spacing above the table */
        }

        .table thead {
            background-color: #f1f1f1; /* Light grey background for table header */
        }

        .table th, .table td {
            border: 1px solid #ddd; /* Light grey border for table cells */
        }

        form {
            display: flex;
            gap: 10px; /* Spacing between form elements */
            align-items: center; /* Align form elements vertically */
        }

        button {
            padding: 5px 10px; /* Padding inside buttons */
            border: none; /* Remove default border */
            border-radius: 4px; /* Rounded corners for buttons */
            cursor: pointer; /* Pointer cursor on hover */
        }

        button[type="submit"] {
            background-color: #5cb85c; /* Green background for submit buttons */
            color: white; /* White text for submit buttons */
        }

        button[type="submit"]:hover {
            background-color: #4cae4c; /* Darker green on hover */
        }

        textarea {
            border: 1px solid #ddd; /* Light grey border for textarea */
            border-radius: 4px; /* Rounded corners for textarea */
            padding: 5px; /* Padding inside textarea */
            resize: vertical; /* Allow vertical resizing of textarea */
        }
    </style>
</head>
<body>

    <!-- ... Your navigation bar ... -->

    <div class="container">
        <h1>Notifications</h1>
        <ul>
            <?php while($notification = mysqli_fetch_assoc($result)) { ?>
                <li><?php echo htmlspecialchars($notification['message']); ?> - <?php echo $notification['created_at']; ?></li>
            <?php } ?>
        </ul>
    </div>

    <!-- ... Your footer ... -->

</body>
</html>
