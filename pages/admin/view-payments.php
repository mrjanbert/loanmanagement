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
                        <table id="example3" class="table table-bordered table-striped">
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
                                $ref_no = $_GET['refid'];
                                $sql = $conn->query("SELECT * FROM tbl_transaction WHERE ref_no = '$ref_no  '");
                                $row = $sql->fetch_assoc()
                                ?>
                                <tr>
                                    <td>
                                        <strong><?= date('M j, Y', strtotime($row['loan_date'])) ?></strong>
                                    </td>
                                    <td>
                                        <strong><?= number_format($row['amount'], 2) ?></strong>
                                    </td>
                                    <td>
                                        <strong><?= number_format($row['total_interest'], 2) ?></strong>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <strong><?= number_format($row['balance'], 2) ?></strong>
                                    </td>
                                </tr>
                                <?php
                                $query = $conn->query("SELECT p.payment_date, t.interest, p.penalty, p.receipt_no, p.payment_amount, p.payment_balance FROM tbl_payments p INNER JOIN tbl_transaction t ON t.ref_no = p.ref_no WHERE p.ref_no = '$ref_no' ORDER BY p.id ASC");
                                while ($row = $query->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><?= date('M j, Y', strtotime($row['payment_date'])) ?></td>
                                        <td></td>
                                        <td></td>
                                        <td><?= ($row['penalty'] != 0) ? number_format($row['penalty'], 2) : ''; ?></td>
                                        <td><?= $row['receipt_no']; ?></td>
                                        <td><?= ($row['payment_amount'] != 0) ? number_format($row['payment_amount'], 2) : ''; ?></td>
                                        <td><?= number_format($row['payment_balance'], 2) ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.card -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section><!-- /.content -->

<div class="modal fade" id="addpayment">
    <div class="modal-dialog modal-md">
        <form action="../../config/create-payment.php" method="POST">
            <div class="modal-content card-outline card-primary">
                <div class="modal-header">
                    <h4 class="modal-title">Add Payment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <?php
                    $ref_no = $_GET['refid'];
                    $sql = $conn->query("SELECT * FROM tbl_transaction WHERE ref_no = '$ref_no'");
                    while ($row = $sql->fetch_assoc()) {
                    ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Loan Reference No. <small class="text-red">*</small></label>
                                    <input type="text" class="form-control form-control-border" name="ref_no" value="<?= $ref_no ?>" readonly>

                                    <!-- <select class="select2" style="width: 100%;" name="ref_no" data-placeholder="Select Loan Reference No." required>
                                    <option></option>
                                </select> -->
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Payment Amount <small class="text-red">*</small></label>
                                    <input type="number" class="form-control form-control-border" name="payment_amount" placeholder="Enter Amount" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>OR Number <small class="text-red">*</small></label>
                                    <input type="number" class="form-control form-control-border" maxlength="10" name="receipt_no" placeholder="Enter OR #" required>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="submit" name="submit" class="btn btn-primary">
                        Save
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancel
                    </button>
                </div>
            </div>
        </form><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<div class="modal fade" id="addpenalty">
    <div class="modal-dialog modal-md">
        <form action="../../config/create-payment.php" method="POST">
            <div class="modal-content card-outline card-primary">
                <div class="modal-header">
                    <h4 class="modal-title">Add Penalty</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">

                    <div class="row">
                        <?php
                        $ref_no = $_GET['refid'];
                        $sql = $conn->query("SELECT * FROM tbl_transaction WHERE ref_no = '$ref_no'");
                        while ($row = $sql->fetch_assoc()) {
                        ?>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Loan Reference No. <small class="text-red">*</small></label>
                                    <input type="text" class="form-control form-control-border" name="ref_no" value="<?= $ref_no ?>" readonly>

                                </div>
                            </div>
                        <?php } ?>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Penalty Amount <small class="text-red">*</small></label>
                                <input type="number" class="form-control form-control-border" name="penalty" placeholder="Enter Amount" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Date<small class="text-red">*</small></label>
                                <input type="date" class="form-control form-control-border" name="payment_date" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="submit" name="addpenalty" class="btn btn-primary">
                        Save
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancel
                    </button>
                </div>
            </div>
        </form><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<?php endif ?>