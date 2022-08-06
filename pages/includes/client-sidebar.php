<?php

use LDAP\Result;

if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header('location: http://localhost/loanmanagement/pages/err/403-error.php');
    exit();
};
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="../../assets/images/lms_logo.png" alt="NMSC LMS Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Loan Management</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <?php
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM tbl_borrowers WHERE user_id = $user_id";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
        ?>
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <?php if ($_SESSION['profilePhoto'] == null) { ?>
                        <img role="button" src="../../assets/images/profile.png" class="img-circle elevation-2" style="width: 35px; height: 35px;" alt="User Image">
                    <?php } else { ?>
                        <img role="button" src="../../assets/images/uploads/<?= $row['profilePhoto'] ?>" class="img-circle elevation-2" style="width: 35px; height: 35px;" alt="User Image">
                    <?php } ?>
                </div>
                <div class="info">
                    <a role="button" class="d-block">
                        <?= $row['firstName'] . ' ' . $row['lastName']; ?> &nbsp;&nbsp;&nbsp;<i class="fas fa-circle text-success" style="font-size: 0.7rem;"></i>
                    </a>
                </div>
            </div>
        <?php } ?>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="index.php?page=dashboard" class="nav-link nav-dashboard">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=view-loans" class="nav-link nav-view-loans nav-grace-period nav-view-payments">
                        <i class="nav-icon fas fa-th-list"></i>
                        <p>Loans</p>
                    </a>
                </li>
            </ul>
        </nav> <!-- /.sidebar-menu -->
    </div> <!-- /.sidebar -->
</aside>

<script>
    $('.nav-<?= isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active').addClass('menu-open')
</script>
