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
                        <?php if ($_GET['usr'] == 'admin') {  ?>
                            <h4>NMSCST Loan Management System (ADMIN)</h4>
                        <?php } elseif ($_GET['usr'] == 'borrower') { ?>
                            <h4>NMSCST Loan Management System</h4>
                        <?php } ?>
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
                            <input type="text" id="middlename" name="middleName" required>
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
                            <input type="text" name="contactNumber" id="contactnumber" onfocus="(this.placeholder='Ex.: 09123456789', this.type='number')" onblur="(this.placeholder='', this.type='text')" required>
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
                            <input type="password" name="password" id="inputPassword" onfocus="(this.type='text')" onblur="(this.type='password')" required>
                            <i class="ti-lock"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="agree" id="invalidCheck" required="">
                                <label class="form-check-label" for="invalidCheck">
                                    I have read and agree to the <a href="#" data-toggle="modal" data-target="#termsconditions">Terms and Conditions of NMSCST LMS</a>.
                                </label>
                            </div>
                        </div>
                        <div class="submit-btn-area">
                            <button name="submit" type="submit">Sign up <i class="ti-arrow-right"></i></button>
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">Already have an account? <a href="login.php">Sign in</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="termsconditions">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">TERMS AND CONDITIONS</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <h5>I. Eligibility</h5> <br />
                    <p>1. The borrower has to be an employee of NMSCST. (COS and Regular)</p>
                    <p>2. The borrower has no default on any outstanding loan to the Coop.</p>
                    <!-- <p>3. Contract of Service employee cannot avail a loan if the remaining months of their contract is below 3 months.</p> -->
                    <p>3. Non - Members/Regular employee borrowers are entitled a loan based on the 50% of their net pay.</p>
                    <br />
                    <h5>II. Co-Maker</h5> <br />
                    <p>1. The Co-Maker/Guarantor must be a member of the Cooperative and possess a higher share capital that can cater the loan amount of the borrower.</p>
                    <p>2. The Co-Maker/Guarantor must understand that by agreeing and signing the Loan Application, they lawfully commit themselves to conditionally answer for the payment of the Borrower's obligation when due and demandable.</p>
                    <br />
                    <h5>III. Mode of Payment</h5> <br />
                    <p>1. The payment shall be made on the next month of the same date when loan released occurs.</p>
                    <p>2. It can be monthly or 15th & 30th based on the borrower's preferences.</p>
                    <br />
                    <h5>IV. Deductions</h5> <br />
                    <p>1. Service Charge: 1% of the loan amount</p>
                    <p>2. Share Capital: 1% of the loan amount for members only</p>
                    <p>3. Notarial fee: 100.00</p>
                    <br />
                    <h5>V. Loans and Penalties</h5> <br />
                    <p>1. The interest of loan shall be 12% anually or 1% per month.</p>
                    <p>2. Loans are subject to penalty which is 1.5% in monthly amortization if the borrower did not agree for the salary deduction process.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- login area end -->

    <?php if ($_GET['usr'] == 'borrower') { ?>
        <script>
            var try1 = "success";
            var try2 = "failed";
            $(document).ready(function() {
                $("#signup").on('submit', function(e) {
                    e.preventDefault();

                    $.ajax({
                        type: "POST",
                        url: "config/create-tmp-userclient.php",
                        data: new FormData(this),
                        dataType: "json",
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.status == 1) {
                                console.log(try1);
                                window.location.href = "auth_check.php?conf=" + response.usrcode + "&usr=borrower";
                            } else {
                                console.log(try2);
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
    <?php } elseif ($_GET['usr'] == 'admin') {  ?>
        <script>
            var try1 = "success";
            var try2 = "failed";
            $(document).ready(function() {
                $("#signup").on('submit', function(e) {
                    e.preventDefault();

                    $.ajax({
                        type: "POST",
                        url: "config/create-tmp-user.php",
                        data: new FormData(this),
                        dataType: "json",
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.status == 1) {
                                console.log(try1);
                                window.location.href = "auth_check.php?conf=" + response.usrcode + "&usr=admin";
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

    <?php } ?>
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