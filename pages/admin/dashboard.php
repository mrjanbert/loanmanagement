<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header('location: http://localhost/loanmanagement/pages/err/404-error.php');
    exit();
};
?>
<?php if (isset($_SESSION['role_name']) && (($_SESSION['role_name']) != (null))) : ?>

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
                <div class="col-lg-4 col-12 col-sm-12 col-md-4">
                    <?php
                    $query = "SELECT * FROM tbl_transaction";
                    $results = mysqli_query($conn, $query);
                    $total_loans = mysqli_num_rows($results);
                    ?>
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $total_loans; ?></h3>
                            <p>Total Loans</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-list-ul"></i>
                        </div>
                        <a href="index.php?page=view-dashboard-total-loans" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-12 col-sm-12 col-md-4">

                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <?php
                            $sql = "SELECT t.*, s.* FROM tbl_transaction t INNER JOIN tbl_status s on s.ref_no = t.ref_no WHERE s.status_cashier = '2'";
                            $results = mysqli_query($conn, $sql);
                            $total_releasedloans = mysqli_num_rows($results);
                            ?>
                            <h3><?= $total_releasedloans; ?></h3>
                            <p>Payments</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <a href="index.php?page=view-dashboard-payments-list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-12 col-sm-12 col-md-4">

                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <?php
                            $sql = "SELECT * FROM tbl_borrowers WHERE is_archived = '0'";
                            $results = mysqli_query($conn, $sql);
                            $total_borrowers = mysqli_num_rows($results);
                            ?>
                            <h3><?= $total_borrowers; ?></h3>
                            <p>Registered Borrowers</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="index.php?page=borrower-list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            <?php endif ?>
            </div>
            <!-- /.row -->

            <!-- Main row -->
            <div class="row">
            </div>

    </section>
    <!-- /.content -->