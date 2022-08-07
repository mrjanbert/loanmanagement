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
                <h1>Approved Loans</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Approved Loans</li>
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
                        <h2 class="card-title">Approved Loan Transactions</h2>
                        <div class="d-flex justify-content-end">
                            <button onclick="history.back()" class="btn btn-warning btn-sm">
                                <i class="fas fa-arrow-alt-circle-left"></i> &nbsp;
                                Back
                            </button>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Reference No.</th>
                                    <th class="text-center">Borrower Name</th>
                                    <th class="text-center">Type of Loan</th>
                                    <th class="text-center">Principal Amount</th>
                                    <?php if (isset($_SESSION['role_name']) && ($_SESSION['role_name'] == null) || $_SESSION['role_name'] == 'Admin') {
                                        '';
                                    } else { ?>
                                        <th class="text-center">Status</th>
                                    <?php } ?>
                                    <th class="text-center">View</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $i = 1;
                                $role_name = $_SESSION['role_name'];
                                $query = $conn->query("SELECT t.*, concat(b.firstName,' ',b.middleName,' ',b.lastName) as borrower_name, s.*, concat(c.firstname, ' ', c.lastName) as comaker_name
                                    FROM (((tbl_transaction t 
                                        INNER JOIN tbl_borrowers b ON t.borrower_id = b.user_id) 
                                        INNER JOIN tbl_status s ON t.status_ref = s.ref_no) 
                                        INNER JOIN tbl_comakers c ON t.comaker_id = c.user_id)
                                    WHERE status_processor = '1' OR status_manager = '1' OR status_cashier = '1' OR status_comaker = '1'");
                                while ($row = $query->fetch_assoc()) :
                                    $ref_no = $row['ref_no'];
                                    $borrower_name = $row['borrower_name'];
                                    $loan_type = $row['loan_type'];
                                    $purpose = $row['purpose'];
                                    $loan_term = $row['loan_term'];
                                    $loan_date = strtotime($row['loan_date']);
                                    $amount = $row['amount'];
                                    $comaker_name = $row['comaker_name'];
                                    $status_comaker = $row['status_comaker'];
                                    $status_manager = $row['status_manager'];
                                    $status_processor = $row['status_processor'];
                                    $status_cashier = $row['status_cashier'];
                                ?>

                                    <tr>
                                        <td class="text-center"><?= $i++; ?></td>
                                        <td><?= $ref_no; ?></td>
                                        <td><?= $borrower_name; ?></td>
                                        <td><?= $loan_type; ?></td>
                                        <td><b style="color: blue"><?= number_format($amount, 2); ?></b></td>

                                        <?php if (isset($role_name) && ($role_name == 'Manager')) {  ?>
                                        <td class="text-center">
                                            <?php if ($status_manager == 1) : ?>
                                                <button type="button" class="btn btn-primary btn-sm my-1 btn-block" style="pointer-events: none">Approved</button>
                                            <?php endif; ?>
                                        </td>
                                        <?php } elseif (isset($role_name) && ($role_name == 'Processor')) {  ?>
                                        <td class="text-center">
                                            <?php if ($status_processor == 1) : ?>
                                                <button type="button" class="btn btn-primary btn-sm my-1 btn-block" style="pointer-events: none">Checked and Verified</button>
                                            <?php endif; ?>
                                        </td>
                                        <?php } elseif (isset($role_name) && ($role_name == 'Cashier')) {  ?>
                                        <td class="text-center">
                                            <?php if ($status_cashier == 1) : ?>
                                                <button type="button" class="btn btn-primary btn-sm my-1 btn-block" style="pointer-events: none">Approved</button>
                                            <?php endif; ?>
                                        </td>
                                        <?php } else {
                                            '';
                                        } ?>
                                        <td class="text-center">
                                            <button class="btn btn-info btn-sm btn-block my-1 viewdashboardloan" 
                                            data-toggle="modal" data-target="#viewdashboardloan" 
                                            data-dash_borrower_name="<?= $borrower_name ?>" 
                                            data-dash_ref_no="<?= $ref_no ?>" 
                                            data-dash_viewloan_amount="<?= number_format($amount, 2) ?>" 
                                            data-dash_viewloan_term="<?= $loan_term ?> Months" 
                                            data-dash_viewloan_type="<?= $loan_type ?>" 
                                            data-dash_loan_date="<?= date('M j, Y - g:i A', strtotime($loan_date)) ?>" 
                                            data-dash_purpose="<?= $purpose ?>" 
                                            data-dash_comaker_name="<?= $comaker_name ?>" 
                                            data-dash_status_comaker=" <?php if ($row['status_comaker'] == '0') {
                                                echo 'Pending';
                                            } elseif ($row['status_comaker'] == '1') {
                                                echo 'Approved';
                                            } elseif ($row['status_comaker'] == '2') {
                                                echo 'Disapproved';
                                            } ?>" data-dash_status_processor=" <?php if (($row['status_comaker'] == '1') &&  ($row['status_processor'] == '0')) {
                                                echo 'Pending';
                                            } elseif (($row['status_comaker'] == '1') &&  ($row['status_processor'] == '1')) {
                                                echo 'Checked and Verified';
                                            } elseif (($row['status_comaker'] == '1') &&  ($row['status_processor'] == '3')) {
                                                echo 'Disapproved';
                                            } else {
                                                echo '';
                                            } ?>" data-dash_status_manager=" <?php if (($row['status_processor'] == '1') && ($row['status_manager'] == '0')) {
                                            echo 'Pending';
                                            } elseif (($row['status_processor'] == '1') && ($row['status_manager'] == '1')) {
                                                echo 'Approved';
                                            } elseif (($row['status_processor'] == '1') && ($row['status_manager'] == '3')) {
                                                echo 'Disapproved';
                                            } else {
                                                echo '';
                                            } ?>" data-dash_status_cashier=" <?php
                                            if (($row['status_manager'] == '1') && ($row['status_cashier'] == '0')) {
                                                echo 'Pending';
                                            } elseif (($row['status_manager'] == '1') && ($row['status_cashier'] == '1')) {
                                                echo 'Approved';
                                            } elseif (($row['status_manager'] == '1') && ($row['status_cashier'] == '2')) {
                                                echo 'Released';
                                            } elseif (($row['status_manager'] == '1') && ($row['status_cashier'] == '3')) {
                                                echo 'Disapproved';
                                            } else {
                                                echo '';
                                            } ?>">
                                                <i class="fa fa-eye"></i>&nbsp;
                                                Loan Information
                                            </button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section><!-- /.content -->


<div class="modal fade" id="viewdashboardloan">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content card-outline card-primary">
            <div class="modal-header">
                <h4 class="modal-title">Loan Information</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Borrower Name</label>
                            <input type="text" id="dash_borrower_name" class="form-control form-control-border text-center" readonly>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Reference Number</label>
                            <input type="text" id="dash_ref_no" class="form-control form-control-border text-center" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Loan Amount</label>
                            <input type="text" id="dash_viewloan_amount" class="form-control form-control-border text-center" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Loan Term</label>
                            <input type="text" id="dash_viewloan_term" class="form-control form-control-border text-center" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Loan Date</label>
                            <input type="text" id="dash_loan_date" class="form-control form-control-border text-center" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Loan Type</label>
                            <input type="text" id="dash_viewloan_type" class="form-control form-control-border text-center" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Purpose</label>
                            <input type="text" id="dash_purpose" class="form-control form-control-border text-center" readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Co-Maker Name</label>
                            <input type="text" id="dash_comaker_name" class="form-control form-control-border text-center" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Comaker's Status</label>
                            <input type="text" id="dash_status_comaker" class="form-control form-control-border text-center" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Processor's Status</label>
                            <input type="text" id="dash_status_processor" class="form-control form-control-border text-center" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Manager's Status</label>
                            <input type="text" id="dash_status_manager" class="form-control form-control-border text-center" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Cashier's Status</label>
                            <input type="text" id="dash_status_cashier" class="form-control form-control-border text-center" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="modal-footer justify-content-end">
                <div class="form-group">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div><!-- /.modal-dialog -->
</div>

<script>
    $(document).ready(function () {
  $(".viewdashboardloan").click(function () {
    $('#dash_borrower_name').val($(this).data('dash_borrower_name'));
    $('#dash_ref_no').val($(this).data('dash_ref_no'));
    $('#dash_viewloan_amount').val($(this).data('dash_viewloan_amount'));
    $('#dash_viewloan_term').val($(this).data('dash_viewloan_term'));
    $('#dash_loan_date').val($(this).data('dash_loan_date'));
    $('#dash_viewloan_type').val($(this).data('dash_viewloan_type'));
    $('#dash_purpose').val($(this).data('dash_purpose'));
    $('#dash_comaker_name').val($(this).data('dash_comaker_name'));
    $('#dash_status_comaker').val($(this).data('dash_status_comaker'));
    $('#dash_status_processor').val($(this).data('dash_status_processor'));
    $('#dash_status_manager').val($(this).data('dash_status_manager'));
    $('#dash_status_cashier').val($(this).data('dash_status_cashier'));
    $('#dash_comaker_date').val($(this).data('dash_comaker_date'));
    $('#dash_processor_date').val($(this).data('dash_processor_date'));
    $('#dash_manager_date').val($(this).data('dash_manager_date'));
    $('#dash_cashier_date').val($(this).data('dash_cashier_date'));

    // $('#viewloan').modal('show');
  });
});
</script>
<?php endif ?>