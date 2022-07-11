<!-- Main Sidebar Container -->
<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="../../assets/dist/img/NMSCLogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Loan Management</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        
        <div role="button" data-toggle="modal" data-target="#view_user" class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image" data-target="#view_user" data-toggle="modal">
                <img src="../../components/img/uploads/<?php echo $_SESSION['profilePhoto']; ?>"  class="img-circle elevation-2" style="width: 35px; height: 35px;" alt="User Image">
            </div>
            <div class="info">
                <a class="d-block" data-target="#view_user" data-toggle="modal">
                    <?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName']; ?> &nbsp;&nbsp;&nbsp;<i class="fas fa-circle text-success" style="font-size: 0.7rem;"></i>
                </a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php if(isset($_GET['usr']) && (trim($_GET['usr']) == base64_encode("Admin")) || (trim($_GET['usr']) == base64_encode("Manager")) || (trim($_GET['usr']) == base64_encode("Processor")) || (trim($_GET['usr']) == base64_encode("Cashier"))) : ?>
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="index.php?page=dashboard&usr=<?php echo base64_encode($_SESSION['role_name'])?>" class="nav-link nav-dashboard">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=loans&usr=<?php echo base64_encode($_SESSION['role_name'])?>" class="nav-link nav-loans nav-grace-period nav-application-form">
                        <i class="fas fa-money-bill nav-icon"></i>
                        <p>Loans</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=payments&usr=<?php echo base64_encode($_SESSION['role_name'])?>" class="nav-link nav-payments nav-view-payments">
                        <i class="fas fa-wallet nav-icon"></i>
                        <p>Payments</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=borrower-list&usr=<?php echo base64_encode($_SESSION['role_name'])?>" class="nav-link nav-borrower-list">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Borrowers
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=comakers&usr=<?php echo base64_encode($_SESSION['role_name'])?>" class="nav-link nav-comakers">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>
                            Co-makers
                        </p>
                    </a>
                </li>
                <?php endif; ?>
                <!-- Permission for USER MANAGEMENT -->
                <?php if(isset($_GET['usr']) && (trim($_GET['usr']) == base64_encode("Admin"))) : ?>

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
                            <a href="index.php?page=user-list&usr=<?php echo base64_encode($_SESSION['role_name'])?>" class="nav-link nav-user-list">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?page=user-roles&usr=<?php echo base64_encode($_SESSION['role_name'])?>" class="nav-link nav-user-roles">
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
        <a class="brand-text text-white font-weight-light align-middle" role="button">User Role Status: &nbsp; <span class="text-primary"><?php echo $_SESSION['role_name'] ?></span></a>
    </div>
    <!-- /.sidebar-custom -->
</aside>

<script>
    $('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active').addClass('menu-open')
</script>


<div class="modal fade" id="view_user">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Information of <?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName']; ?> </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center mb-4">
                        <div class="image">
                            <img src="../../components/img/uploads/<?php echo $_SESSION['profilePhoto']; ?>" class="img-square elevation-3" alt="User Image" style="max-width: 200px; height: 200px;">
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <label>Account Number:</label>
                            <p><?php echo $_SESSION['accountNumber']; ?> </p>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <label>Full Name:</label>
                            <p><?php echo $_SESSION['firstName'] . ' ' . $_SESSION['middleName'] . ' ' . $_SESSION['lastName']; ?> </p>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="form-group">
                            <label>Age:</label>
                            <p><?php echo $_SESSION['age']; ?> </p>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="form-group">
                            <label>Birth Date:</label>
                            <p><?php echo $_SESSION['birthDate']; ?> </p>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="form-group">
                            <label>Contact Number:</label>
                            <p><?php echo $_SESSION['contactNumber']; ?> </p>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="form-group">
                            <label>Email:</label>
                            <p class="text-primary"><?php echo $_SESSION['email']; ?> </p>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="form-group">
                            <label>Address:</label>
                            <p><?php echo $_SESSION['address']; ?> </p>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="form-group">
                            <label>Date Registered:</label>
                            <p><?php echo $_SESSION['userCreated']; ?> </p>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(isset($_GET['usr']) && (trim($_GET['usr']) == base64_encode("Admin")) || (trim($_GET['usr']) == base64_encode("Manager")) || (trim($_GET['usr']) == base64_encode("Processor")) || (trim($_GET['usr']) == base64_encode("Cashier"))) : ?>
            <div class="modal-footer justify-content-end">
                <a href='index.php?page=update-info&user_id=<?php echo base64_encode($_SESSION['user_id']); ?>' class="btn btn-primary">Edit</a>
            </div>
            <?php endif ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>