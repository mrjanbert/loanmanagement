<?php
session_start();
if (isset($_SESSION['adminuser_id'])) {
    header('location: pages/admin/index.php?page=dashboard&usr=' . base64_encode($_SESSION['role_name']));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Login :: NMSCST Loan Management System</title>
    <link rel="icon" type="image/x-icon" href="components/img/favicon.ico">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />

    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.24/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.24/dist/sweetalert2.min.js"></script>

    <!-- MDB -->
    <link rel="stylesheet" href="components/hometemplate/css/mdb.min.css" />
    <!-- Custom styles -->
    <link rel="stylesheet" href="components/hometemplate/css/scrollbarhidden.css" />

</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark d-none d-lg-block">
        <div class="container-fluid">
            <!-- Navbar brand -->
            <a class="navbar-brand nav-link" target="_blank" href="#">
                <strong>LMS</strong>
            </a>
            <div class="collapse navbar-collapse" id="collapseNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./">Home</a>
                    </li>
                </ul>

                <ul class="navbar-nav d-flex flex-row">
                    <li class="nav-item me-3 me-lg-0">
                        <a class="nav-link text-white" href="https://github.com/mrjanbert/loanmanagement" rel="nofollow" target="_blank">
                            <i class="fab fa-github"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar -->

    <!--Main layout-->
    <main>
        <!-- Toast Notification -->
        <?php
        if (isset($_SESSION['status'])) {
            $status = $_SESSION['status'];
            echo "<span>$status</span>";
        }
        ?>
        <!-- end of toast -->
        <div class="container">
            <!--Section: Content-->
            <section class="vh-100">
                <div class="container py-5 h-100">
                    <div class="row d-flex align-items-center justify-content-center h-100">
                        <div class="col-md-8 col-lg-7 col-xl-6">
                            <img src="components/hometemplate/img/login.webp" class="img-fluid" alt="Phone image">
                        </div>
                        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">

                            <div class="text-center">
                                <h2 class="fw-bold">Admin Sign-in</h2>
                                <p class="fw-bold mb-4 pb-2">Sign-in to start your session</p>
                            </div>
                            <form action="config/login-user.php" method="POST">
                                </formaction>
                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <input type="text" name="accountNumber" class="form-control form-control-lg" />
                                    <label class="form-label">ID Number</label>
                                </div>
                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <input type="password" name="password" class="form-control form-control-lg" />
                                    <label class="form-label">Password</label>
                                </div>

                                <div class="d-flex justify-content-around align-items-center my-4">
                                    <button type="submit" value="submit" name="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                                </div>

                                <!-- Submit button -->

                                <div class="text-center text-lg-start">
                                    <p class="fw-bold mt-1 pt-1 mb-0">Don't have an account? <a href="register.php" class="link-danger">Register</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!--Section: Content-->
        </div>
    </main>

    <!-- unset toast notification to avoid popup every load -->
    <?php unset($_SESSION["status"]); ?>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="components/hometemplate/js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <!-- <script type="text/javascript" src="js/script.js"></script> -->
</body>

</html>