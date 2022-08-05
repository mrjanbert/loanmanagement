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
    <a href="#" class="brand-link logo-switch">
        <img src="../../assets/images/lms_logo.png" alt="NMSC Logo" class="brand-image logo-xs img-circle elevation-3">
        <span class="brand-text logo-xl"><b>L</b>oan <b>M</b>anagement <b>S</b>ystem</span>
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
            <div role="button" data-toggle="modal" data-target="#view_user" class="user-panel mt-3 pb-3 mb-3 d-flex">
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
                    <a href="index.php?page=loans" class="nav-link nav-loans nav-grace-period nav-view-payments">
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

<div class="modal fade" id="view_user">
    <div class="modal-dialog modal-lg">
        <form action="../../config/update-info.php" method="POST">
            <div class="modal-content">
                <?php
                $user_id = $_SESSION['user_id'];
                $sql = $conn->query("SELECT * FROM tbl_borrowers WHERE user_id = $user_id");
                while ($row = $sql->fetch_assoc()) :
                ?>
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
                                    <?php if ($_SESSION['profilePhoto'] == null) { ?>
                                        <img src="../../assets/images/profile.png" class="img-circle elevation-3" alt="User Image" style="width: 250px; height: 250px;">
                                    <?php } else { ?>
                                        <img src="../../assets/images/uploads/<?= $row['profilePhoto'] ?>" class="img-circle elevation-3" alt="User Image" style="width: 250px; height: 250px;">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-6 text-center">
                                <div class="form-group">
                                    <label>Account Number:</label>
                                    <input type="text" id="side_idnumber" value="<?= $row['accountNumber']; ?>" class="form-control form-control-border text-center" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Full Name:</label>
                                    <input type="text" id="side_name" value="<?= $row['firstName'] . ' ' . $row['middleName'] . ' ' . $row['lastName'] ?>" class="form-control form-control-border text-center" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input type="text" id="side_email" value="<?= $row['email']; ?>" class="form-control form-control-border text-center" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="form-group">
                                    <label>Birth Date:</label>
                                    <input type="text" id="side_birthdate" value="<?= date('F j, Y', strtotime($row['birthDate'])); ?>" class="form-control form-control-border text-center" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="form-group">
                                    <label>Membership Status:</label>
                                    <input type="text" id="side_membership" value="<?= ($row['membership'] == 1) ? 'Member' : 'Non-member'; ?>" class="form-control form-control-border text-center" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="form-group">
                                    <label>Date Registered:</label>
                                    <input type="text" id="side_usercreated" value="<?= date('F j, Y', strtotime($row['userCreated'])); ?>" class="form-control form-control-border text-center" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="form-group">
                                    <label>Contact Number:</label>
                                    <input type="text" id="side_contactnumber" name="contactNumber" value="<?= $row['contactNumber']; ?>" class="form-control form-control-border text-center">
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="form-group">
                                    <label>Username:</label>
                                    <input type="text" id="side_username" name="username" value="<?= $row['username']; ?>" class="form-control form-control-border text-center">
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="form-group">
                                    <label>Address:</label>
                                    <input type="text" id="side_address" name="address" value="<?= $row['address']; ?>" class="form-control form-control-border text-center">
                                </div>
                            </div>
                            <input type="text" name="borrower_id" value="<?= $row['user_id'] ?>" hidden>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button class="btn btn-secondary" id="cancel_btn" data-dismiss="modal" data-side_contactnumber="<?= $row['contactNumber'] ?>" data-side_address="<?= $row['address'] ?>" data-side_username="<?= $row['username'] ?>">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary" name="update_info">Save</button>
                    </div>
                <?php endwhile ?>
            </div>
        </form><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script>
    $(document).ready(function() {
        $("#cancel_btn").click(function() {
            $('#side_contactnumber').val($(this).data('side_contactnumber'));
            $('#side_username').val($(this).data('side_username'));
            $('#side_address').val($(this).data('side_address'));

            $('#addloan').modal('hide');
        });
    });
</script>