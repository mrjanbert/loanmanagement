<?php
session_start();
if (!isset($_SESSION['adminuser_id'])) {
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
    header('location: ../../login.php');
}
require_once '../../config/data/Database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NMSCST Loan Management System</title>
    <link rel="icon" type="image/x-icon" href="../../assets/images/icon/favicon.ico">

    <!-- Header -->
    <link rel="stylesheet" href="../../assets/css/scrollbarhidden.css" />
    <?php include_once('../includes/header.php'); ?>
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
        <?php include_once('../includes/navbar.php'); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include_once('../includes/sidebar.php'); ?>
        <!-- /.main-sidebar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?php $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard'; ?>
            <?php include $page . '.php' ?>
        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- ./wrapper -->

    <!-- unset toast notification to avoid popup every load -->
    <?php unset($_SESSION['status']); ?>


    <?php include_once 'base/data-modals.php' ?>
    <!-- Footer -->
    <?php include_once('../includes/footer.php'); ?>

</body>

</html>