<?php
session_start();
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Forgot Password :: NMSCST Loan Management System</title>
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
  <div class="login-area">
    <div class="container">
      <div class="login-box ptb--100">
        <form autocomplete="off" method="POST" action="config/send-password.php">
          <div class="login-form-head">
            <h4>Account Recovery</h4>
            <p>Please enter your username and mobile number to recover your account.</p>
          </div>
          <div class="login-form-body">
            <div class="form-gp">
              <label for="username">Username</label>
              <input type="text" name="username" id="username" required>
              <i class="ti-user"></i>
            </div>
            <div class="form-gp">
              <label for="mobilenumber">Mobile Number</label>
              <input type="number" name="contactNumber" id="contactnumber" onfocus="(this.placeholder='09xxxxxxxxx')" onblur="(this.placeholder='')" required>
              <i class="ti-mobile"></i>
            </div>
            <div class="submit-btn-area mt-5">
              <button id="form_submit" name="submit" type="submit">Submit <i class="ti-arrow-right"></i></button>
            </div>
            <div class="form-footer text-right mt-5">
              <p class="text-muted"><a href="login.php">Back</a></p>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.bundle.min.js"></script>
  <!-- <script src="assets/js/owl.carousel.min.js"></script> -->
  <script src="assets/js/metisMenu.min.js"></script>
  <script src="assets/js/jquery.slimscroll.min.js"></script>
  <script src="assets/js/jquery.slicknav.min.js"></script>

  <!-- others plugins -->
  <!-- <script src="assets/js/plugins.js"></script> -->
  <script src="assets/js/scripts.js"></script>
</body>

</html>