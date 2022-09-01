<?php
session_start();
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Verify Mobile Number :: NMSCST Loan Management System</title>
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

  <?php $conf = $_GET['conf']; ?>
  <!-- login area start -->
  <div class="login-area">
    <div class="container">
      <div class="login-box ptb--100">
        <?php if ($_GET['usr'] == 'admin') {  ?>
          <form autocomplete="off" method="POST" action="config/create-user.php">
        <?php } elseif ($_GET['usr'] == 'borrower') { ?>
          <form autocomplete="off" method="POST" action="config/create-userclient.php">
        <?php } ?>
            <input type="hidden" name="data_inserted" value="<?= $conf ?>">
            <div class="login-form-head">
              <h4>Authentication</h4>
              <p>We've sent a 6-digit authentication code to your number.</p>
            </div>
            <div class="login-form-body">
              <div class="form-gp">
                <label for="otp">Enter Authentication Code</label>
                <input type="text" name="code" id="otp" required>
                <i class="fa fa-key"></i>
              </div>
              <div class="row mb-4 rmber-area">
                <div class="col-12 text-right">
                  <a href="config/resend-code.php?conf=<?= $conf ?>&usr=<?= $_GET['usr']?>">Resend Code</a>
                </div>
              </div>
              <div class="submit-btn-area mt-5">
                <button id="form_submit" name="submit" type="submit">Verify <i class="ti-arrow-right"></i></button>
              </div>
              <div class="form-footer text-right mt-5">
                <p class="text-muted"><a href="javascript:history.back()">Back</a></p>
              </div>
            </div>
            </form>
      </div>
    </div>
  </div>
  <!-- login area end -->

  <!-- unset toast notification to avoid popup every load -->
  <?php unset($_SESSION["status"]); ?>

  <!-- <script>
    const timerElement = document.getElementById('timerCountDown');
    let timer;

    function startTimeCountDown() {
      timer = 60;
      const timeCountdown = setInterval(countdown, 1000);
    }

    function countdown() {
      if (timer == 0) {
        clearTimeout(timer);
        timerElement.innerHTML = 'Resend Code'

      } else {
        timerElement.innerHTML = 'Resend code(' + timer + ' secs)';
        timer--;
      }
    }

    timerElement.addEventListener('click', ev => {
      startTimeCountDown();
    });
  </script> -->

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