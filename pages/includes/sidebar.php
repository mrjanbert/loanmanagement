<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header('location: http://localhost/loanmanagement/pages/err/403-error.php');
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
                <?php if (isset($_SESSION['role_name']) && (($_SESSION['role_name']) != (null))) : ?>
                    <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="index.php?page=dashboard" class="nav-link nav-dashboard nav-view-dashboard-total-loans nav-view-dashboard-loan-information nav-view-dashboard-payments-list">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?page=borrower-list" class="nav-link nav-borrower-list nav-view-payments nav-grace-period nav-application-form nav-view-loans nav-borrower-info nav-loan-information">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Borrowers
                            </p>
                        </a>
                    </li>
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
                    <li class="nav-item nav-user-list nav-user-roles">
                        <a href="#" class="nav-link nav-user-list nav-user-roles">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>
                                User Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview nav-user-list nav-user-roles">
                            <li class="nav-item">
                                <a href="index.php?page=user-list" class="nav-link nav-user-list">
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