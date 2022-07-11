<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link logo-switch">
        <!-- <img src="https://adminlte.io/docs/3.1//assets/img/logo-xs.png" alt="AdminLTE Docs Logo Small" class="brand-image-xl logo-xs">
        <img src="https://adminlte.io/docs/3.1//assets/img/logo-xl.png" alt="AdminLTE Docs Logo Large" class="brand-image-xs logo-xl" style="left: 12px"> -->
        <img src="../../assets/dist/img/NMSCLogo.png" alt="NMSC Logo" class="brand-image logo-xs img-circle elevation-3">
        <span class="brand-text logo-xl"><b>L</b>oan <b>M</b>anagement <b>S</b>ystem</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div role="button" data-toggle="modal" data-target="#view_user" class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img role="button" src="../../components/img/uploads/<?= $_SESSION['profilePhoto']; ?>" class="img-circle elevation-2" style="width: 35px; height: 35px;" alt="User Image">
            </div>
            <div class="info">
                <a role="button" class="d-block">
                    <?= $_SESSION['firstName'] . ' ' . $_SESSION['lastName']; ?> &nbsp;&nbsp;&nbsp;<i class="fas fa-circle text-success" style="font-size: 0.7rem;"></i>
                </a>
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
                <li class="nav-item">
                    <a href="index.php?page=loans" class="nav-link nav-loans nav-grace-period">
                        <i class="nav-icon fas fa-th-list"></i>
                        <p>Loans</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=payments" class="nav-link nav-view-payments nav-payments">
                        <i class="nav-icon fas fa-th-list"></i>
                        <p>Payments</p>
                    </a>
                </li>
            </ul>
        </nav> <!-- /.sidebar-menu -->
    </div> <!-- /.sidebar -->
</aside>

<script>
    $('.nav-<?= isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active').addClass('menu-open')
</script>


<div class="modal fade" id="view_user">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Information of <?= $_SESSION['firstName'] . ' ' . $_SESSION['lastName']; ?> </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center mb-4">
                        <div class="image">
                            <img src="../../components/img/uploads/<?= $_SESSION['profilePhoto']; ?>" class="img-square elevation-3" alt="User Image" style="max-width: 200px; height: 200px;">
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <label>ID Number:</label>
                            <p><?= $_SESSION['accountNumber']; ?> </p>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <label>Full Name:</label>
                            <p><?= $_SESSION['firstName'] . ' ' . $_SESSION['middleName'] . ' ' . $_SESSION['lastName']; ?> </p>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="form-group">
                            <label>Age:</label>
                            <p><?= $_SESSION['age']; ?> </p>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="form-group">
                            <label>Birth Date:</label>
                            <p><?= $_SESSION['birthDate']; ?> </p>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="form-group">
                            <label>Contact Number:</label>
                            <p><?= $_SESSION['contactNumber']; ?> </p>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="form-group">
                            <label>Email:</label>
                            <p class="text-primary"><?= $_SESSION['email']; ?> </p>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="form-group">
                            <label>Address:</label>
                            <p><?= $_SESSION['address']; ?> </p>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="form-group">
                            <label>Date Registered:</label>
                            <p><?= $_SESSION['userCreated']; ?> </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-end">
                <a href='index.php?page=update-info&user_id=<?= base64_encode($_SESSION['user_id']); ?>' class="btn btn-primary">Edit</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>