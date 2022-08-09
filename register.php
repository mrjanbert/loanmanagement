<?php
session_start();
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sign up :: NMSCST Loan Management System</title>
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
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>

    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.24/dist/sweetalert2.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.24/dist/sweetalert2.min.js"></script>

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
                <form autocomplete="off" id="signup">
                    <div class="login-form-head">
                        <h4>Sign up</h4>
                        <p>Create your account</p>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="idnumber">ID Number</label>
                            <input type="text" id="idnumber" name="accountNumber" required>
                            <i class="ti-id-badge"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" required>
                            <i class="ti-user"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="firstname">First Name</label>
                            <input type="text" id="firstname" name="firstName" required>
                            <i class="ti-user"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="middlename">Middle Name</label>
                            <input type="text" id="middlename" name="middleName">
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="lastname">Last Name</label>
                            <input type="text" id="lastname" name="lastName" required>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="address">Home Address</label>
                            <input type="text" id="address" name="address" required>
                            <i class="ti-location-pin"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="birthdate">Birth Date</label>
                            <i class="ti ti-calendar"></i>
                            <input class="form-control" type="text" name="birthDate" id="birthdate" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="contactnumber">Mobile Number</label>
                            <input type="number" name="contactNumber" id="contactnumber" onfocus="(this.placeholder='Ex.: 09123456789')" onblur="(this.placeholder='')" required>
                            <i class="ti-mobile"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="inputEmail">Email address</label>
                            <input type="email" name="email" id="inputEmail" required>
                            <i class="ti-email"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="inputPassword">Password</label>
                            <input type="password" name="password" id="inputPassword" required>
                            <i class="ti-lock"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="submit-btn-area">
                            <button name="submit" type="submit">Submit <i class="ti-arrow-right"></i></button>
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">Already have an account? <a href="login.php">Sign in</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->

    <script>
        var try1 = "success";
        var try2 = "failed";
        $(document).ready(function() {
            $("#signup").on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "config/create-userclient.php",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status == 1) {
                            console.log(try1);
                            window.location.href = "login.php"
                        } else {
                            console.log(try2);
                            // $("#error-message").html(response.message);
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 5000
                            })

                            Toast.fire({
                                icon: 'error',
                                title: response.message
                            })
                        }
                    }

                })
            })
        })
    </script>

    <!-- unset toast notification to avoid popup every load -->
    <?php unset($_SESSION["status"]); ?>
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