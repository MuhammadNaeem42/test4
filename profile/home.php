
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

        <!-- Nav bar -->
        <div class="">
            <br><br><br>
            <?php include("../include/navigation.php"); ?>
			<?php 

			include "db_conn.php";
			include 'php/User.php';

			if (isset($_SESSION['id'])) {


			$user = getUserById($_SESSION['id'], $conn);

			?>
        </div>

                <br><br>
                


		<br><br>
        <hr class="col-9 mx-auto" style="border-top: 3px double;">
        <h2 class="text-center" style=" font-size: 45px; font-family: 'Untitled Serif',Georgia,Moderat,Helvetica Neue,Helvetica,Arial,sans-serif; font-weight: 700; font-style: normal; text-rendering: optimizeLegibility; padding-top: 30px;"><?= $user['first_name'] ?></h2>
        <hr class="col-9 mx-auto" style="border-top: 3px double;">

    <div class="container mt-5">
        <!-- User information -->
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="text-center">
                    <img src="../Homepage/Homepage_Images/pp.jpg" class="img-fluid rounded-circle" alt="Profile Picture">
                    
                    <p class="text-muted"><?= $user['email'] ?></p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone Number</label>
                    <div class="input-group">
                        <span class="input-group-text"><?= $user['country_code'] ?></span>
                        <input type="text" class="form-control" value="<?= $user['phone_number'] ?>" readonly>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control" value="<?= $user['address'] ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Postcode</label>
                    <input type of disallowed="text" class="form-control" value="<?= $user['postcode'] ?>" readonly>
                </div>
                <div class="d-grid gap-2">
                    <a href="edit.php" class="btn btn-primary">Edit Profile</a>
                    <button class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change Password</button>
                    <a href="../LogINOUT/logout.php" class="btn btn-danger">Logout</a>
                </div>
				
		<br><br>
        <hr class="col-9 mx-auto" style="border-top: 3px double;">
            </div>
        </div>
    </div>
	

    <!-- Change Password Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="changePasswordForm">
                        <div class="mb-3">
                            <label for="currentPassword" class="col-form-label">Current Password:</label>
                            <input type="password" class="form-control" id="currentPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="col-form-label">New Password:</label>
                            <input type="password" class="form-control" id="newPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmNewPassword" class="col-form-label">Confirm New Password:</label>
                            <input type="password" class="form-control" id="confirmNewPassword" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<script>
    $(document).ready(function() {
        $('#changePasswordForm').submit(function(e) {
            e.preventDefault();
            var currentPassword = $('#currentPassword').val();
            var newPassword = $('#newPassword').val();
            var confirmNewPassword = $('#confirmNewPassword').val();

            if (newPassword !== confirmNewPassword) {
                alert('New passwords do not match.');
                return;
            }

            // Send the request to the server
            $.ajax({
                url: 'change_password.php', // The file where you handle the form input on the backend
                type: 'POST',
                data: {
                    'currentPassword': currentPassword, // Ensure these names match what's expected on the server
                    'newPassword': newPassword
                },
                success: function(response) {
                    // Handle the response from the server
                    if (response === 'success') { // Adjust depending on how your backend sends the response
                        alert('Password updated successfully.');
                        $('#changePasswordModal').modal('hide');
                    } else {
                        alert('Error: ' + response); // This could be a message sent from the server
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Handle any errors here
                    alert('An error occurred: ' + textStatus);
                }
            });
        });
    });
</script>

</body>
</html>


<?php }else {
	header("Location: ../LogINOUT/login.php");
	exit;
} ?>
