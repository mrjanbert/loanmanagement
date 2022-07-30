<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header('location: http://localhost/loanmanagement/pages/err/404-error.php');
    exit();
};
?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <?php if (isset($_GET['usr']) && (trim($_GET['usr']) == ("Admin")) || (trim($_GET['usr']) == ("Manager")) || (trim($_GET['usr']) == ("Processor")) || (trim($_GET['usr']) == ("Cashier"))) : ?>
                <div class="col-lg-4 col-6">
                    <?php
                    $query = "SELECT t.*, s.* FROM tbl_transaction t INNER JOIN tbl_status s ON t.status_ref = s.ref_no WHERE status_processor = '1' OR status_manager = '1' OR status_cashier = '1' OR status_comaker = '1'";
                    $results = mysqli_query($conn, $query);
                    $approved_loans = mysqli_num_rows($results);
                    ?>
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $approved_loans; ?></h3>
                            <p>Approved Loans</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-thumbs-up"></i>
                        </div>
                        <a href="index.php?page=view-approved-loans&usr=<?= ($_SESSION['role_name']) ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <?php
                    $query = "SELECT t.*, s.* FROM tbl_transaction t INNER JOIN tbl_status s ON t.status_ref = s.ref_no WHERE status_processor = '3' OR status_manager = '3' OR status_cashier = '3' OR status_comaker = '2'";
                    $results = mysqli_query($conn, $query);
                    $disapproved_loans = mysqli_num_rows($results);
                    ?>
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php echo $disapproved_loans; ?></h3>
                            <p>Disapproved Loans</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-thumbs-down"></i>
                        </div>
                        <a href="index.php?page=view-disapproved-loans&usr=<?= ($_SESSION['role_name'])?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <?php
                    $role_name = $_SESSION['role_name'];
                    if (isset($role_name) && ($role_name == 'Processor')) {
                    $query = "SELECT t.*, s.* FROM tbl_transaction t INNER JOIN tbl_status s ON t.status_ref = s.ref_no WHERE status_processor = '0'";
                    }
                    elseif (isset($role_name) && ($role_name == 'Manager')) {
                        $query = "SELECT t.*, s.* FROM tbl_transaction t INNER JOIN tbl_status s ON t.status_ref = s.ref_no WHERE status_manager = '0' AND status_processor != '0' AND status_processor != '1'";
                    } elseif (isset($role_name) && ($role_name == 'Cashier')) {
                        $query = "SELECT t.*, s.* FROM tbl_transaction t INNER JOIN tbl_status s ON t.status_ref = s.ref_no WHERE status_cashier = '0' AND status_manager != '0' AND status_manager != '1' AND status_manager != '2'";
                    }
                    $results = mysqli_query($conn, $query);
                    $pending_loans = mysqli_num_rows($results);
                    ?>
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?php echo $pending_loans; ?></h3>
                            <p>Pending Loans</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <a href="index.php?page=view-pending-loans&usr=<?= ($_SESSION['role_name'])?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            <?php endif ?>
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
        </div>
        <!-- /.row (main row) -->

    </div>
    <!-- /.container-fluid -->

</section>
<!-- /.content -->