<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header('location: http://localhost/loanmanagement/pages/err/403-error.php');
    exit();
};
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="../../components/img/lms_logo.png" alt="NMSC LMS Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Loan Management</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <?php
        $user_id = $_SESSION['adminuser_id'];
        $sql = "SELECT * FROM tbl_users WHERE user_id = $user_id";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
        ?>
            <!-- Sidebar user panel (optional) -->
            <div role="button" data-toggle="modal" data-target="#view_user" class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image" data-target="#view_user" data-toggle="modal">
                    <img src="../../components/img/uploads/<?= $row['profilePhoto']; ?>" class="img-circle elevation-2" style="width: 35px; height: 35px;" alt="User Image">
                </div>
                <div class="info">
                    <a class="d-block" data-target="#view_user" data-toggle="modal">
                        <?= $row['firstName'] . ' ' . $row['lastName']; ?> &nbsp;&nbsp;&nbsp;<i class="fas fa-circle text-success" style="font-size: 0.7rem;"></i>
                    </a>
                </div>
            </div>
            <!-- Sidebar Menu -->
        <?php } ?>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php if (isset($_GET['usr']) && (trim($_GET['usr']) == base64_encode("Admin")) || (trim($_GET['usr']) == base64_encode("Manager")) || (trim($_GET['usr']) == base64_encode("Processor")) || (trim($_GET['usr']) == base64_encode("Cashier"))) : ?>
                    <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="index.php?page=dashboard&usr=<?= base64_encode($_SESSION['role_name']) ?>" class="nav-link nav-dashboard">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?page=borrower-list&usr=<?= base64_encode($_SESSION['role_name']) ?>" class="nav-link nav-borrower-list nav-view-payments nav-view-loans">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Borrowers
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
                <!-- Permission for USER MANAGEMENT -->
                <?php if (isset($_GET['usr']) && (trim($_GET['usr']) == base64_encode("Admin"))) : ?>

                    <li class="nav-item">
                        <a href="index.php?page=comakers&usr=<?= base64_encode($_SESSION['role_name']) ?>" class="nav-link nav-comakers">
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
                                <a href="index.php?page=user-list&usr=<?= base64_encode($_SESSION['role_name']) ?>" class="nav-link nav-user-list">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>User List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=user-roles&usr=<?= base64_encode($_SESSION['role_name']) ?>" class="nav-link nav-user-roles">
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


<?php
$user_id = $_SESSION['adminuser_id'];
$sql = "SELECT * FROM tbl_users WHERE user_id = $user_id";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
?>
    <div class="modal fade" id="view_user">
        <div class="modal-dialog modal-lg">\
            <form action="">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Personal Information of <?= $row['firstName'] . ' ' . $row['lastName']; ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 d-flex justify-content-center">
                                <div class="image">
                                    <img src="../../components/img/uploads/<?= $row['profilePhoto']; ?>" class="img-circle elevation-3" alt="User Image" style="width: 250px; height: 250px;">
                                </div>
                            </div>
                            <div class="col-md-6 text-center">
                                <div class="form-group">
                                    <label>Account Number:</label>
                                    <input type="text" id="side_idnumber" value="<?= $row['accountNumber']; ?>" class="form-control form-control-border text-center">
                                </div>
                                <div class="form-group">
                                    <label>Full Name:</label>
                                    <input type="text" id="side_name" value="<?= $row['firstName'] . ' ' . $row['middleName'] . ' ' . $row['lastName'] ?>" class="form-control form-control-border text-center">
                                </div>
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input type="text" id="side_email" value="<?= $row['email']; ?>" class="form-control form-control-border text-center">
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="form-group">
                                    <label>Birth Date:</label>
                                    <input type="text" id="side_birthdate" value="<?= date('F j, Y', strtotime($row['birthDate'])); ?>" class="form-control form-control-border text-center">
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="form-group">
                                    <label>Contact Number:</label>
                                    <input type="text" id="side_contactnumber" value="<?= $row['contactNumber']; ?>" class="form-control form-control-border text-center">
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="form-group">
                                    <label>User Role:</label>
                                    <input type="text" id="side_rolename" value="<?= $row['role_name']; ?>" class="form-control form-control-border text-center">
                                </div>
                            </div>
                            <div class="col-md-6 text-center">
                                <div class="form-group">
                                    <label>Address:</label>
                                    <input type="text" id="side_address" value="<?= $row['address']; ?>" class="form-control form-control-border text-center">
                                </div>
                            </div>
                            <div class="col-md-6 text-center">
                                <div class="form-group">
                                    <label>Date Registered:</label>
                                    <input type="text" id="side_usercreated" value="<?= date('F j, Y', strtotime($row['userCreated'])); ?>" class="form-control form-control-border text-center">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($_GET['usr']) && (trim($_GET['usr']) == base64_encode("Admin")) || (trim($_GET['usr']) == base64_encode("Manager")) || (trim($_GET['usr']) == base64_encode("Processor")) || (trim($_GET['usr']) == base64_encode("Cashier"))) : ?>
                        <div class="modal-footer justify-content-end">
                            <button class="btn btn-secondary" id="cancel_btn" data-dismiss="modal" data-side_idnumber="<?= $row['accountNumber'] ?>" data-side_name="<?= $row['firstName'] . ' ' . $row['middleName'] . ' ' . $row['lastName'] ?>" data-side_email="<?= $row['email'] ?>" data-side_birthdate="<?= date('F j, Y', strtotime($row['birthDate'])) ?>" data-side_contactnumber="<?= $row['contactNumber'] ?>" data-side_rolename="<?= $row['role_name'] ?>" data-side_address="<?= $row['address'] ?>" data-side_usercreated="<?= date('F j, Y', strtotime($row['userCreated'])) ?>">Cancel</button>
                            <a href='javascript:void(0);' class="btn btn-primary save_info">Save</a>
                        </div>
                    <?php endif ?>
                </div>
            </form><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


<?php } ?>

<script>
    $(document).ready(function() {
        $("#cancel_btn").click(function() {
            $('#side_idnumber').val($(this).data('side_idnumber'));
            $('#side_name').val($(this).data('side_name'));
            $('#side_email').val($(this).data('side_email'));
            $('#side_birthdate').val($(this).data('side_birthdate'));
            $('#side_contactnumber').val($(this).data('side_contactnumber'));
            $('#side_rolename').val($(this).data('side_rolename'));
            $('#side_address').val($(this).data('side_address'));
            $('#side_usercreated').val($(this).data('side_usercreated'));


            $('#addloan').modal('hide');
        });
    });
</script>