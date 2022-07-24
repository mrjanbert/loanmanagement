<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    $_SESSION['status'] = "<script>const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
      })
  
      Toast.fire({
        icon: 'warning',
        title: 'You must login to continue'
      })</script>";
    header('location: ./login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<?php require_once '../../config/data/Database.php'; ?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NMSCST Loan Management System</title>
    <link rel="icon" type="image/x-icon" href="../../components/img/favicon.ico">

    <!-- Header -->
    <?php include_once('./inc/header.php'); ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php
        if (isset($_SESSION["status"])) {
            $status = $_SESSION["status"];
            echo "<span>$status</span>";
        }
        ?>
        <!-- Navbar -->
        <?php include_once('./inc/navbar.php'); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include_once('./inc/sidebar.php'); ?>
        <!-- /.main-sidebar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?php $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard'; ?>
            <?php include $page . '.php' ?>
        </div>
        <!-- /.content-wrapper -->

        <!-- <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer> -->
    </div>
    <!-- ./wrapper -->


    <!-- unset toast notification to avoid popup every load -->
    <?php unset($_SESSION['status']); ?>

    <!-- Footer -->
    <?php include_once('./inc/footer.php'); ?>
</body>

</html>