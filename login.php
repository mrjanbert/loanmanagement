<?php
session_start();
require 'config/data/Database.php';

if (isset($_SESSION['adminuser_id']) || (isset($_SESSION['role_name']))) {
  $check = $_SESSION['adminuser_id'];
  $role_name = $_SESSION['role_name'];
  $users = "SELECT * FROM tbl_users WHERE user_id = '$check' AND role_name = '$role_name'";
  $result = $conn->query($users);
  if (mysqli_num_rows($result) == 1) {
    header('location: pages/admin/index.php?page=dashboard');
  }
}

if ((isset($_SESSION['user_id']) || (isset($_SESSION['membership'])))) {
  $check = $_SESSION['user_id'];
  $membership = $_SESSION['membership'];
  $users = "SELECT * FROM tbl_borrowers WHERE user_id = '$check' AND membership = '$membership'";
  $result = $conn->query($users);
  if (mysqli_num_rows($result) == 1) {
    header('location: pages/client/index.php?page=dashboard');
  }
}
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Login :: NMSCST Loan Management System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="assets/js/jquery.slim.min.js"></script>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/themify-icons.css">
  <link rel="stylesheet" href="assets/css/metisMenu.css">
  <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/css/slicknav.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900|Poppins:100,300,400,500,600,700,800,900">
  <!-- amchart css -->
  <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
  <!-- others css -->
  <link rel="stylesheet" href="assets/css/typography.css">
  <link rel="stylesheet" href="assets/css/default-css.css">
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="stylesheet" href="assets/css/responsive.css">
  <link rel="stylesheet" href="assets/css/scrollbarhidden.css">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.24/dist/sweetalert2.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.24/dist/sweetalert2.min.js"></script>

  <!-- modernizr css -->
  <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>

  <div id="preloader">
    <div class="loader"></div>
  </div>

  <?php
  if (isset($_SESSION['status'])) {
    $status = $_SESSION['status'];
    echo "<span>$status</span>";
  }
  ?>

  <!-- login area start -->
  <div class="login-area login-s2">
    <div class="container">
      <div class="login-box ptb--100">
        <form action="config/login-user.php" autocomplete="off" method="POST">
          <div class="login-form-head">
            <h4>NMSCST Loan Management System</h4>
            <p>Sign in to start your session</p>
          </div>
          <div class="login-form-body">
            <div class="form-gp">
              <label for="inputUsername">Username</label>
              <input type="text" name="username" id="inputUsername" required>
              <i class="fa fa-user"></i>
            </div>
            <div class="form-gp">
              <label for="inputPassword">Password</label>
              <input type="password" name="password" id="inputPassword" required>
              <i class="fa fa-lock" id="togglePassword" style="cursor: pointer;"></i>
            </div>
            <div class="row mb-4 rmber-area">
              <div class="col-12 text-right">
                <a href="forgot-password.php">Forgot Password?</a>
              </div>
            </div>
            <div class="submit-btn-area">
              <button name="submit" type="submit">Sign in <i class="ti-arrow-right"></i></button>
            </div>
            <div class="form-footer text-center mt-5">
              <p class="text-muted">Don't have an account? <a href="signup.php?usr=borrower">Sign up</a></p>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- login area end -->

  <script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#inputPassword');

    togglePassword.addEventListener('click', function(e) {
      // toggle the type attribute
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      // toggle the unlock icon
      this.classList.toggle('fa-unlock');
    });
  </script>

  <!-- unset toast notification to avoid popup every load -->
  <?php unset($_SESSION["status"]); ?>

  <!-- jquery latest version -->
  <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
  <!-- bootstrap 4 js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/metisMenu.min.js"></script>
  <script src="assets/js/jquery.slimscroll.min.js"></script>
  <script src="assets/js/jquery.slicknav.min.js"></script>

  <script src="assets/js/scripts.js"></script>
</body>

</html>