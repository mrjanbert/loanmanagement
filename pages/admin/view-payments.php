<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header('location: http://localhost/loanmanagement/pages/err/404-error.php');
    exit();
};
?>
<?php if (isset($_SESSION['role_name']) && (trim($_SESSION['role_name']) != (null))) : ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>View Payments</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item">Loans</li>
                    <li class="breadcrumb-item active">Payments</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Payment History</h3>
                        <div class="d-flex justify-content-end">
                            <button onclick="history.back()" class="btn btn-warning btn-sm">
                                <i class="fas fa-arrow-alt-circle-left"></i> &nbsp;
                                Back
                            </button>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <?php if (isset($_SESSION['role_name']) && (($_SESSION['role_name'] == 'Cashier') || ($_SESSION['role_name'] == 'Admin'))) {  ?>
                            <div class="d-flex justify-content-end mb-2">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addpayment">
                                    <i class="fa fa-plus"></i> &nbsp;
                                    Add Payment
                                </button> &nbsp; &nbsp;
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#addpenalty">
                                    <i class="fa fa-plus"></i> &nbsp;
                                    Add Penalty
                                </button>
                            </div>
                        <?php } ?>
                        <?php include_once 'base/data-view-payments.php' ?>
                    </div>
                </div><!-- /.card -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section><!-- /.content -->





<?php endif ?>