<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header('location: http://localhost/loanmanagement/pages/err/404-error.php');
    exit();
};
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Payments</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item">Loans</li>Payments</li>
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
                        <h3 class="card-title">List of Payments</h3>
                        <?php if (isset($_SESSION['role_name']) && (($_SESSION['role_name'] == 'Cashier') || ($_SESSION['role_name'] == 'Admin'))) {  ?>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addpayment">
                                    <i class="fa fa-plus"></i> &nbsp;
                                    Add Payment
                                </button>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="card-body">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="15%" class="text-center">Date</th>
                                    <th width="15%" class="text-center">Principal</th>
                                    <th class="text-center">Interest</th>
                                    <th class="text-center">Penalty</th>
                                    <th class="text-center">OR #</th>
                                    <th class="text-center">Payment</th>
                                    <th class="text-center">Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                // $plan = $conn->query("SELECT * FROM loan_plans WHERE plan_id in (SELECT plan_id FROM tbl_transactions)");
                                // while ($row = $plan->fetch_assoc()) {
                                //     $plan_arr[$row['plan_id']] = $row;
                                // }

                                $borrower = $conn->query("SELECT * FROM tbl_borrowers WHERE user_id in (SELECT user_id FROM tbl_transaction)");
                                while ($row = $borrower->fetch_assoc()) {
                                    $borrower_array[$row['user_id']] = $row;
                                }

                                $loan = $conn->query("SELECT * FROM tbl_transaction WHERE ref_no in (SELECT ref_no FROM tbl_payments)");
                                while ($row = $loan->fetch_assoc()) {
                                    $loan_array[$row['ref_no']] = $row;
                                }
                                $query = $conn->query("SELECT * FROM tbl_payments ORDER BY id DESC");
                                while ($row = $query->fetch_assoc()) :
                                ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            <button onclick="history.back()" class="btn btn-warning btn-sm">
                                <i class="fas fa-arrow-alt-circle-left"></i> &nbsp;
                                Back
                            </button>
                        </div>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section><!-- /.content -->