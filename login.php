<?php
session_start();
if (isset($_SESSION['adminuser_id'])) {
    header('location: pages/admin/index.php?page=dashboard&usr=' . base64_encode($_SESSION['role_name']));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login :: NMSCST Loan Management System</title>
    <link rel="icon" type="image/x-icon" href="components/img/favicon.ico">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="assets/plugins/sweetalert2/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.18/dist/sweetalert2.all.min.js"></script>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- Toast Notification -->
        <?php
        if (isset($_SESSION['status'])) {
            $status = $_SESSION['status'];
            echo "<span>$status</span>";
        }
        ?>
        <!-- end of toast -->

        <div class="d-flex justify-content-center">
            <div class="card card-outline card-primary">
                <div class="card-header d-flex justify-content-center">
                    <h3><b>Login</b></h3>
                </div>
                <div class="card-body">
                    <form action="./config/login-user.php" method="POST">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" name="accountNumber" placeholder="ID Number" required>
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control remember" id="password" name="password" placeholder="password" required>
                        </div>
                        <div class="input-group align-items-center">
                            <input type="checkbox" onclick="myFunction()">&nbsp;&nbsp;Show password
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary float-right">Login</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center">
                        <p>Don't have an account? <a href="register.php">Register</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>


    <!-- unset toast notification to avoid popup every load -->
    <?php unset($_SESSION["status"]); ?>

    <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.js"></script>

    <script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
</body>

</html>