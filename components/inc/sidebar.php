<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="../../assets/dist/img/NMSCLogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Loan Management</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../../components/img/uploads/<?php echo $_SESSION['profilePhoto']; ?>"  class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                <?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName']; ?> &nbsp;&nbsp;&nbsp;<i class="fas fa-circle text-success" style="font-size: 0.7rem;"></i></a>
            </div>
        </div>
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
                <li class="nav-item nav-loan-list nav-loan-plans nav-loan-types nav-loan-charges">
                    <a href="#" class="nav-link nav-loan-list nav-loan-plans nav-loan-types nav-loan-charges">
                        <i class="nav-icon fas fa-th-list"></i>
                        <p>
                            Loans
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="index.php?page=loan-list" class="nav-link nav-loan-list">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Loan List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?page=loan-plans" class="nav-link nav-loan-plans">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Loan Plans</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?page=loan-types" class="nav-link nav-loan-types">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Loan Types</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?page=loan-charges" class="nav-link nav-loan-charges">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Loan Charges</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=borrower-list" class="nav-link nav-borrower-list">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>
                            Borrowers
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item nav-user-list nav-user-roles nav-user-modules">
                    <a href="#" class="nav-link nav-user-list nav-user-roles nav-user-modules">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview nav-user-list nav-user-roles nav-user-modules">
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
                        <li class="nav-item">
                            <a href="index.php?page=user-modules" class="nav-link nav-user-modules">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Module Permissions</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=payments" class="nav-link nav-payments">
                        <i class="nav-icon fas fa-wallet"></i>
                        <p>
                            Payments
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=sms-logs" class="nav-link nav-sms-logs">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            SMS Logs
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav> <!-- /.sidebar-menu -->
    </div> <!-- /.sidebar -->
</aside>

<script>
    $('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active').addClass('menu-open')
</script>