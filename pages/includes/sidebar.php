<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header('location: ../error/403-error.php');
    exit();
};
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:void(0) " class="brand-link">
        <img src="../../assets/images/lms_logo.png" alt="NMSC LMS Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Loan Management</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <?php
        $user_id = $_SESSION['adminuser_id'];
        $sql = "SELECT * FROM tbl_users WHERE user_id = $user_id";
        $result = $conn->query($sql);

        while ($row = $result->fetch_array()) {
        ?>
            <!-- Sidebar user panel (optional) -->
            <div role="button" class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <?php if ($row['profilePhoto'] == null) { ?>
                        <img role="button" src="../../assets/images/profile.png" class="img-square elevation-2" style="width: 35px; height: 35px;" alt="User Image">
                    <?php } else { ?>
                        <img role="button" src="../../assets/images/uploads/<?= $row['profilePhoto']; ?>" class="img-square elevation-2" style="width: 35px; height: 35px;" alt="User Image">
                    <?php } ?>
                </div>
                <div class="info">
                    <a class="d-block">
                        <?= $row['firstName'] . ' ' . $row['lastName']; ?> &nbsp;&nbsp;&nbsp;<i class="fas fa-circle text-success" style="font-size: 0.7rem;"></i>
                    </a>
                </div>
            </div>
            <!-- Sidebar Menu -->
        <?php } ?>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php if (isset($_SESSION['role_name']) && (($_SESSION['role_name']) != ('Unknown User'))) : ?>
                    <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="index.php?page=dashboard" class="nav-link nav-dashboard nav-view-dashboard-payments-list nav-view-dashboard-total-loans nav-view-dashboard-loan-information nav-view-comaker-pending-loans nav-view-comaker-approved-loans nav-view-comaker-disapproved-loans nav-view-processor-pending-loans nav-view-processor-approved-loans nav-view-manager-pending-loans nav-view-manager-approved-loans nav-view-manager-disapproved-loans nav-view-cashier-pending-loans nav-view-cashier-approved-loans nav-view-cashier-disapproved-loans">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?page=borrower-list" class="nav-link nav-borrower-list <?= ($_SESSION['role_name'] == 'Cashier') ? '' : 'nav-view-payments' ?> nav-view-share-capital nav-grace-period nav-application-form nav-view-loans nav-borrower-info nav-loan-information nav-view-monthly-reminder">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Borrowers
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?page=smslogs" class="nav-link nav-smslogs nav-message">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>
                                SMS Logs
                            </p>
                        </a>
                    </li>
                    <?php if (isset($_SESSION['role_name']) && (trim($_SESSION['role_name']) == ("Cashier"))) : ?>
                        <li class="nav-item">
                            <a href="index.php?page=view-payments-list" class="nav-link nav-view-payments-list nav-view-payments">
                                <i class="nav-icon fas fa-wallet"></i>
                                <p>
                                    Payments List
                                </p>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                <!-- Permission for USER MANAGEMENT -->
                <?php if (isset($_SESSION['role_name']) && (trim($_SESSION['role_name']) == ("Admin"))) : ?>

                    <li class="nav-item">
                        <a href="index.php?page=comakers" class="nav-link nav-comakers">
                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>
                                Co-makers
                            </p>
                        </a>
                    </li>
                    <li class="nav-item nav-user-list nav-user-roles nav-user-info">
                        <a href="#" class="nav-link nav-user-list nav-user-roles nav-user-info">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>
                                User Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview nav-user-list nav-user-roles nav-nav-user-info">
                            <li class="nav-item">
                                <a href="index.php?page=user-list" class="nav-link nav-user-list nav-user-info">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>User List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=user-roles" class="nav-link nav-user-roles">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>User Roles</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </nav> <!-- /.sidebar-menu -->
    </div> <!-- /.sidebar -->
    <div class="sidebar-custom">
        <a class="brand-text text-white font-weight-light align-middle" role="button">User Role Status: &nbsp; <span class="text-primary"><?= $_SESSION['role_name'] ?></span></a>
    </div>
    <!-- /.sidebar-custom -->
</aside>

<script>
    $('.nav-<?= isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active').addClass('menu-open')
</script>