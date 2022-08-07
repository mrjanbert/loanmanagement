<?php
session_start();
if (isset($_SESSION['adminuser_id'])) {
  header('location: pages/admin/index.php?page=dashboard');
}

if (isset($_SESSION['user_id'])) {
  header('location: pages/client/index.php?page=dashboard');
}
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Login :: NMSCST Loan Management System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/themify-icons.css">
  <link rel="stylesheet" href="assets/css/metisMenu.css">
  <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/css/slicknav.min.css">
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
            <h4>Sign In</h4>
            <p>Sign in to start you session</p>
          </div>
          <div class="login-form-body">
            <div class="form-gp">
              <label for="inputUsername">Username</label>
              <input type="text" name="username" id="inputUsername">
              <i class="ti-user"></i>
              <div class="text-danger"></div>
            </div>
            <div class="form-gp">
              <label for="inputPassword">Password</label>
              <input type="password" name="password" id="inputPassword">
              <i class="ti-lock"></i>
              <div class="text-danger"></div>
            </div>
            <div class="submit-btn-area">
              <button name="submit" type="submit">Submit <i class="ti-arrow-right"></i></button>
            </div>
            <div class="form-footer text-center mt-5">
              <p class="text-muted">Don't have an account? <a href="register.php">Sign up</a></p>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- login area end -->

  <!-- unset toast notification to avoid popup every load -->
  <?php unset($_SESSION["status"]); ?>

  <!-- jquery latest version -->
  <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
  <!-- bootstrap 4 js -->
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>
  <script src="assets/js/metisMenu.min.js"></script>
  <script src="assets/js/jquery.slimscroll.min.js"></script>
  <script src="assets/js/jquery.slicknav.min.js"></script>

  <!-- others plugins -->
  <script src="assets/js/plugins.js"></script>
  <script src="assets/js/scripts.js"></script>
</body>

</html>