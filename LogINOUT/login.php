<?php
session_start();
ob_start();

$currentPage = "Login";

require_once('includes/header.php');
include("../include/DBconn.php");


if (isset($_POST['login'])) {
  $user_email = escape($_POST['user_email']);
  $user_pass = escape($_POST['user_pass']);

  // $_SESSION['email'] = $user_email;

  if ($user_email == 'admin@admin.com') {
    $query1 = "SELECT * FROM admin WHERE email = '$user_email';";
    $query_con1 = mysqli_query($conn, $query1);

    $row1 = mysqli_fetch_array($query_con1);

    if (password_verify($user_pass, $row1['password'])) {

      $_SESSION['email'] = $row1['email'];
      $user_type = $row1['role_type'];
      $_SESSION['roleID'] = $user_type;

      header('location: ../Homepage/Admin_Homepage.php');
    } else {
      $err = "Invalid Email or Password!";
    }
  } else {
    $query = "SELECT * FROM users WHERE email = '$user_email';";
    $query_con = mysqli_query($conn, $query);

    if (!$query_con) {
      die("Query Failed" . mysqli_error($conn));
    }
    


    if (mysqli_num_rows($query_con) > 0) {

      $row = mysqli_fetch_assoc($query_con);
      $user_type = $row['role_type'];

      if($user_type == '2' &&  $row['is_active'] == '0'){
        $err = "Waiting for admin verification";
        // header('location: login.php');
      } elseif (($user_type == '2') &&  ($row['is_active'] == '1') && (password_verify($user_pass, $row['password']))) {
        // if($row['is_active'] == 2){

        //   $_SESSION['email'] = $row['email'];

        //   header('location: ../Homepage/Admin_Homepage.php');
        // }else{

        $_SESSION['id'] = $row['id'];
        $_SESSION['roleID'] = $user_type;

        // Assuming you have the user's ID stored in $userId
        function logActivity($userId, $action, $conn) {
          $stmt = $conn->prepare("INSERT INTO activity_logs (user_id, action) VALUES (?, ?)");
          $stmt->bind_param("is", $userId, $action);
          $stmt->execute();
          $stmt->close();
        }

        // Log the login action
        logActivity($_SESSION['id'], 'login', $conn);

        header('location: ../Homepage/Seller_Homepage.php');

        // }

      } elseif (($user_type == '1')  && (password_verify($user_pass, $row['password']))) {
        $_SESSION['id'] = $row['id'];
        $_SESSION['roleID'] = $row['role_type'];

        // Assuming you have the user's ID stored in $userId
        function logActivity($userId, $action, $conn) {
          $stmt = $conn->prepare("INSERT INTO activity_logs (user_id, action) VALUES (?, ?)");
          $stmt->bind_param("is", $userId, $action);
          $stmt->execute();
          $stmt->close();
        }

        // Log the login action
        logActivity($_SESSION['id'], 'login', $conn);

        header('location: ../Homepage/Homepage.php');
      
      }
      
      else {
        $err = "Invalid Email or Password!";
      }


    } else {
      $err = "Invalid Email or Password!";
    }
  }
}
// if(isset($_SESSION['login'])){
//   header('location: user.php');
// }
?>

<section class="bg-image" style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card mt-5 mb-5" style="border-radius: 15px; box-shadow:0 2px 10px;background: whitesmoke;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Login</h2>

              <form action="login.php" method="POST">

                <div>
                  <?php echo isset($err) ? "<span class='text-center pb-3 form-control flex-fill alert alert-danger'>{$err}</span>" : ""  ?>
                </div>
                <div class="form-outline mb-4">
                  <input name="user_email" type="email" id="form3Example3cg" class="form-control form-control-lg" />
                  <label class="form-label" for="form3Example3cg">Your Email</label>
                </div>

                <div class="form-outline mb-4">
                  <input name="user_pass" type="password" id="form3Example4cg" class="form-control form-control-lg" />
                  <label class="form-label" for="form3Example4cg">Password</label>
                </div>


                <div class="form-group">
                  <div class="fxt-transformY-50 fxt-transition-delay-4">
                    <div class="clearfix fxt-checkbox-area">
                      <div class="checkbox float-left">
                      </div>
                      <div class="float-right">
                        <a href="forgot_password.php" class="switcher-text2 mx-3">Forgot Password</a>
                      </div>
                    </div>

                  </div>
                </div>


                <div class="d-flex justify-content-center">
                  <input type="submit" name="login" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body" value="Login">
                </div>

                <p class="text-center text-muted mt-5 mb-0">Don't have an account? <a href="register.php" class="fw-bold text-body"><u>Register here</u></a></p>

              </form>
              <hr class="mx-5 my-4">

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>