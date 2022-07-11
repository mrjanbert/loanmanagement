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
            <div class="col-lg-6 col-6">
                <?php
                $query = "SELECT * FROM tbl_transaction WHERE user_id = " . $_SESSION['user_id'];
                $results = mysqli_query($conn, $query);
                $totalloans = mysqli_num_rows($results);
                ?>
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php echo $totalloans; ?></h3>
                        <p>Total Loans</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <a href="index.php?page=loans" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-6 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>10000.00</h3>
                        <p>Remaining Balance</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-coins"></i>
                    </div>
                    <a href="index.php?page=payments" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->

        </div>
        <!-- /.row -->

        <!-- Main row -->
        <?php
        if ($_SESSION['membership'] == 1) :
        ?>
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">List of Co-maker Requests</h2>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Reference No.</th>
                                        <th class="text-center">Requested by</th>
                                        <th class="text-center">Principal Amount</th>
                                        <th class="text-center">Loan Date</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // $user_id = $_SESSION['user_id'];
                                    // $query = $conn->query("SELECT *, concat(firstName,' ',lastName) AS name FROM tbl_comakers WHERE user_id = $user_id");
                                    // while ($row = $query->fetch_assoc()) :
                                    //     $name = $row['name'];
                                    
                                    $comaker = $conn->query("SELECT *, concat(firstName,' ',lastName) AS name FROM tbl_comakers WHERE user_id IN (SELECT user_id FROM tbl_transaction)");
                                    while ($row = $comaker->fetch_assoc()) {
                                        $comaker_arr[$row['user_id']] = $row;
                                        $borrower = $comaker_arr[$row['user_id']]['user_id'];
                                        $reqby = $comaker_arr[$row['user_id']]['name'];
                                    }

                                    $user_id = $_SESSION['user_id'];
                                    $query = $conn->query("SELECT * FROM tbl_transaction WHERE comaker_id  = $user_id");
                                    while ($row = $query->fetch_assoc()) :  
                                        $ref_no = $row['ref_no'];
                                        $amount = $row['amount'];
                                        $loan_date = $row['loan_date'];
                                        $status_comaker = $row['status_comaker'];
                                    ?>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <?php
                                                echo $ref_no;
                                                ?>
                                            </td>
                                            <td>
                                                <?= $reqby; ?>
                                            </td>
                                            <td>
                                                <?= $amount; ?>
                                            </td>
                                            <td>
                                                <?php echo date('F j, Y', strtotime($loan_date)); ?>
                                            </td>
                                            <td>
                                                <?php if ($status_comaker == 0) : ?>
                                                    <button type="button" class="btn btn-warning btn-sm">Pending</button>
                                                <?php elseif ($status_comaker == 1) : ?>
                                                    <button type="button" class="btn btn-success btn-sm">Approved</button>
                                                <?php elseif ($status_comaker == 2) : ?>
                                                    <button type="button" class="btn btn-danger btn-sm">Denied</button>
                                                <?php endif; ?>
                                            </td>
                                            <td></td>
                                        </tr>
                                    <?php
                                    endwhile;
                                    ?>
                                </tbody>
                            </table>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.col -->
            </div>
            <!-- /.row (main row) -->
        <?php endif ?>

    </div>
    <!-- /.container-fluid -->

</section>
<!-- /.content -->