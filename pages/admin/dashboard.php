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
        <?php if(isset($_GET['usr']) && (trim($_GET['usr']) == base64_encode("Admin")) || (trim($_GET['usr']) == base64_encode("Manager")) || (trim($_GET['usr']) == base64_encode("Processor")) || (trim($_GET['usr']) == base64_encode("Cashier"))) : ?>
            <div class="col-lg-4 col-6">
                <?php
                $query = "SELECT * FROM tbl_transaction";
                $results = mysqli_query($conn, $query);
                $totalloans = mysqli_num_rows($results);
                ?>
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php echo $totalloans; ?></h3>
                        <p>Total Loans Approved</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>?????</h3>
                        <p>Total Registered Borrowers</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-coins"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>??</h3>
                        <p>Total Payments List</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-inbox"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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