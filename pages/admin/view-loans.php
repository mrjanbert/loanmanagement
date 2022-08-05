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
                    <h1>Loans</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active">Loans</li>
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
                            <h2 class="card-title">Loan Transactions</h2>
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
                                        <th class="text-center">Type of Loan</th>
                                        <th class="text-center">Principal Amount</th>
                                        <?php if (isset($_SESSION['role_name']) && ($_SESSION['role_name'] == null) || $_SESSION['role_name'] == 'Admin') {
                                            '';
                                        } else { ?>
                                            <th class="text-center">Status</th>
                                        <?php } ?>
                                        <th class="text-center">View</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $i = 1;
                                    $user_id = $_GET['uid'];
                                    $role_name = $_SESSION['role_name'];
                                    $query = $conn->query("SELECT t.*, concat(b.firstName,' ',b.middleName,' ',b.lastName) as borrower_name, s.*, concat(c.firstname, ' ', c.lastName) as comaker_name,  concat(u.firstname, ' ', u.lastName) as user_name
                                    FROM ((((tbl_transaction t 
                                        INNER JOIN tbl_borrowers b ON t.borrower_id = b.user_id) 
                                        INNER JOIN tbl_status s ON t.status_ref = s.ref_no) 
                                        LEFT JOIN tbl_users u ON s.processor_id = u.user_id) 
                                        INNER JOIN tbl_comakers c ON t.comaker_id = c.user_id) 
                                    WHERE t.borrower_id = $user_id");
                                    while ($row = $query->fetch_assoc()) :
                                        $ref_no = $row['ref_no'];
                                        $borrower_name = $row['borrower_name'];
                                        $loan_type = $row['loan_type'];
                                        $purpose = $row['purpose'];
                                        $loan_term = $row['loan_term'];
                                        $loan_date = strtotime($row['loan_date']);
                                        $amount = $row['amount'];
                                        $comaker_name = $row['comaker_name'];
                                        $user_name = $row['user_name'];
                                        $status_comaker = $row['status_comaker'];
                                        $status_manager = $row['status_manager'];
                                        $status_processor = $row['status_processor'];
                                        $status_cashier = $row['status_cashier'];
                                        $comaker_date = $row['comaker_dateprocess'];
                                        $processor_date = $row['processor_dateprocess'];
                                        $manager_date = $row['manager_dateprocess'];
                                        $cashier_date = $row['cashier_dateprocess'];
                                    ?>

                                        <tr class="text-center">
                                            <td><p class="my-1"><?= $i++; ?></p></td>
                                            <td><p class="my-1"><?= $ref_no; ?></p></td>
                                            <td><p class="my-1"><?= $loan_type; ?></p></td>
                                            <td><p class="my-1"><b style="color: blue"><?= number_format($amount, 2); ?></b></p></td>

                                            <?php if (isset($role_name) && ($role_name == 'Manager')) {  ?>
                                                <?php if ($status_processor == 1) : ?>
                                                    <td class="text-center">
                                                        <?php if ($status_manager == 0) : ?>
                                                            <button type="button" class="btn btn-warning btn-xs my-1 text-white" style="pointer-events: none">Pending</button>
                                                        <?php elseif ($status_manager == 1) : ?>
                                                            <button type="button" class="btn btn-primary btn-xs my-1" style="pointer-events: none">Approved</button>
                                                        <?php elseif ($status_manager == 3) : ?>
                                                            <button type="button" class="btn btn-danger btn-xs my-1" style="pointer-events: none">Disapproved</button>
                                                        <?php endif; ?>
                                                    </td>
                                                <?php elseif (($status_processor == 0) && ($status_comaker == 1)) : ?>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-info btn-xs my-1" style="pointer-events: none">Waiting for CC Member's Approval</button>
                                                    </td>
                                                <?php elseif (($status_processor == 0) && ($status_comaker == 0)) : ?>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-info btn-xs my-1" style="pointer-events: none">Waiting for Co-maker's Approval</button>
                                                    </td>
                                                <?php else : ?>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-danger btn-xs my-1" style="pointer-events: none">Disapproved by Co-maker</button>
                                                    </td>
                                                <?php endif ?>

                                            <?php } elseif (isset($role_name) && ($role_name == 'Processor')) {  ?>
                                                <?php if ($status_comaker == 1) : ?>
                                                    <td class="text-center">
                                                        <?php if ($status_processor == 0) : ?>
                                                            <button type="button" class="btn btn-warning btn-xs my-1 text-white" style="pointer-events: none">Pending</button>
                                                        <?php elseif ($status_processor == 1) : ?>
                                                            <button type="button" class="btn btn-primary btn-xs my-1" style="pointer-events: none">Checked and Verified</button>
                                                        <?php endif; ?>
                                                    </td>
                                                <?php elseif ($status_comaker == 0) : ?>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-info btn-xs my-1" style="pointer-events: none">Waiting for Co-maker's Approval</button>
                                                    </td>
                                                <?php else : ?>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-danger btn-xs my-1" style="pointer-events: none">Disapproved by Co-maker</button>
                                                    </td>
                                                <?php endif ?>

                                            <?php } elseif (isset($role_name) && ($role_name == 'Cashier')) {  ?>
                                                <?php if ($status_manager == 1) : ?>
                                                    <td class="text-center">
                                                        <?php if ($status_cashier == 0) : ?>
                                                            <button type="button" class="btn btn-warning btn-xs my-1 text-white" style="pointer-events: none">Pending</button>
                                                        <?php elseif ($status_cashier == 1) : ?>
                                                            <button type="button" class="btn btn-primary btn-xs my-1" style="pointer-events: none">Approved</button>
                                                        <?php elseif ($status_cashier == 2) : ?>
                                                            <button type="button" class="btn btn-success btn-xs my-1" style="pointer-events: none">Released</button>
                                                        <?php elseif ($status_cashier == 3) : ?>
                                                            <button type="button" class="btn btn-danger btn-xs my-1" style="pointer-events: none">Disapproved</button>
                                                        <?php endif; ?>
                                                    </td>
                                                <?php elseif ($status_manager == 3) : ?>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-danger btn-xs my-1" style="pointer-events: none">Approved by: CC Member <br />Disapproved by: Manager</button>
                                                    </td>
                                                <?php elseif (($status_manager == 0) && ($status_processor == 1)) : ?>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-info btn-xs my-1" style="pointer-events: none">Waiting for Manager's Approval</button>
                                                    </td>
                                                <?php elseif (($status_manager == 0) && ($status_processor == 0) && ($status_comaker == 1)) : ?>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-info btn-xs my-1" style="pointer-events: none">Waiting for CC Member's Approval</button>
                                                    </td>
                                                <?php elseif (($status_manager == 0) && ($status_processor == 0) && ($status_comaker == 0)) : ?>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-info btn-xs my-1" style="pointer-events: none">Waiting for Co-maker's Approval</button>
                                                    </td>
                                                <?php else : ?>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-danger btn-xs my-1" style="pointer-events: none">Disapproved by Co-maker</button>
                                                    </td>
                                                <?php endif ?>
                                            <?php } else {
                                                '';
                                            } ?>

                                            <td class="text-center">
                                                <a href="index.php?page=grace-period&ref_no=<?= $ref_no ?>" class="btn btn-primary my-1 btn-xs">
                                                    Grace Period
                                                </a>
                                                <a href="index.php?page=application-form&ref_no=<?= $ref_no ?>" class="btn btn-success my-1 btn-xs">
                                                    Application Form
                                                </a>
                                                <button class="btn btn-info btn-xs my-1 viewloan" data-toggle="modal" data-target="#viewloan" data-borrower_name="<?= $borrower_name ?>" data-ref_no="<?= $ref_no ?>" data-viewloan_amount="<?= number_format($amount, 2) ?>" data-viewloan_term="<?= $loan_term ?> Months" data-viewloan_type="<?= $loan_type ?>" data-loan_date="<?= date('M j, Y - g:i A', $loan_date) ?>" data-purpose="<?= $purpose ?>" data-comaker_name="<?= $comaker_name ?>" data-status_user_name="<?= $user_name ?>" data-comaker_date="<?= ($comaker_date != null) ? 'Date processed: ' . date('M j, Y', strtotime($comaker_date)) : '' ?>" data-processor_date="<?= ($processor_date != null) ? 'Date processed: ' . date('M j, Y', strtotime($processor_date)) : '' ?>" data-manager_date="<?= ($manager_date != null) ? 'Date processed: ' . date('M j, Y', strtotime($manager_date)) : '' ?>" data-cashier_date="<?= ($cashier_date != null) ? 'Date processed: ' . date('M j, Y', strtotime($cashier_date)) : '' ?>" data-status_comaker="<?= ($row['status_comaker'] == '0') ? 'Pending' : (($row['status_comaker'] == '1') ? 'Approved' : 'Disapproved') ?>" data-status_processor="<?= (($row['status_comaker'] == '1') &&  ($row['status_processor'] == '0')) ? 'Pending' : ((($row['status_comaker'] == '1') &&  ($row['status_processor'] == '1')) ? 'Checked and Verified by ' . $user_name : ((($row['status_comaker'] == '1') &&  ($row['status_processor'] == '3')) ? 'Disapproved' : '')) ?>" data-status_manager="<?= (($row['status_processor'] == '1') && ($row['status_manager'] == '0')) ? 'Pending' : ((($row['status_processor'] == '1') && ($row['status_manager'] == '1')) ? 'Approved' : ((($row['status_processor'] == '1') && ($row['status_manager'] == '3')) ? 'Disapproved' : '')) ?>" data-status_cashier="<?= (($row['status_manager'] == '1') && ($row['status_cashier'] == '0')) ? 'Pending' : ((($row['status_manager'] == '1') && ($row['status_cashier'] == '1')) ? 'Approved' : ((($row['status_manager'] == '1') && ($row['status_cashier'] == '2')) ? 'Released' : ((($row['status_manager'] == '1') && ($row['status_cashier'] == '3')) ? 'Disapproved' : ''))) ?>">
                                                    Loan Information
                                                </button>
                                                <?php if (($role_name != null) && (($status_cashier == 1) || ($status_cashier == 2))) {  ?>
                                                    <a href="index.php?page=view-payments&refid=<?= $ref_no ?>" class="btn btn-warning my-1 text-white btn-xs">
                                                        View Payments
                                                    </a>
                                                <?php } ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if (isset($role_name) && ($role_name == 'Admin')) {  ?>
                                                    <a href="#" class="btn btn-primary btn-xs my-1">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-danger btn-xs my-1">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                <?php } ?>
                                                <?php if (isset($role_name) && ($role_name == 'Manager')) {  ?>
                                                    <?php if ($status_processor == 1) : ?>
                                                        <?php if ($status_manager == 0) : ?>
                                                            <a href="javascript:void(0);" class="btn btn-success btn-xs my-1 approve_manager" title="Approve Loan" data-toggle="tooltip" data-placement="top" data-status_ref="<?= $row['status_ref'] ?>">
                                                                <i class="fas fa-thumbs-up"></i>&nbsp;Approve
                                                            </a>
                                                            <a href="javascript:void(0);" class="btn btn-danger btn-xs my-1 disapprove_manager" title="Disapprove Loan" data-toggle="tooltip" data-placement="top" data-status_ref="<?= $row['status_ref'] ?>">
                                                                <i class="fas fa-thumbs-down"></i>&nbsp;Disapprove
                                                            </a>
                                                        <?php elseif ($status_manager == 1) : ?>
                                                            <a href="javascript:void(0);" class="btn btn-secondary btn-xs my-1">
                                                                Approved
                                                            </a>
                                                        <?php elseif ($status_manager == 3) : ?>
                                                            <a href="javascript:void(0);" class="btn btn-secondary btn-xs my-1">
                                                                Disapproved
                                                            </a>
                                                        <?php endif; ?>
                                                    <?php elseif (($status_processor == 0) && ($status_comaker == 0)) : ?>
                                                        <a href="javascript:void(0);" class="btn btn-secondary btn-xs my-1">
                                                            Waiting for Co-maker's Approval
                                                        </a>
                                                    <?php elseif (($status_processor == 0) && ($status_comaker == 1)) : ?>
                                                        <a href="javascript:void(0);" class="btn btn-secondary btn-xs my-1">
                                                            Waiting for CC Member's Approval
                                                        </a>
                                                    <?php else : ?>
                                                        <a href="javascript:void(0);" class="btn btn-secondary btn-xs my-1">
                                                            Disapproved by Co-maker
                                                        </a>
                                                    <?php endif; ?>

                                                <?php } elseif (isset($role_name) && ($role_name == 'Processor')) {  ?>
                                                    <?php if ($status_comaker == 1) : ?>
                                                        <?php if ($status_processor == 0) : ?>
                                                            <a href="javascript:void(0);" class="btn btn-success btn-xs my-1 approve_processor" title="Approve Loan" data-toggle="tooltip" data-placement="top" data-status_ref="<?= $row['status_ref'] ?>">
                                                                <i class="fa fa-check"></i>&nbsp;Check and Verify
                                                            </a>
                                                        <?php elseif ($status_processor == 1) : ?>
                                                            <a href="javascript:void(0);" class="btn btn-secondary btn-xs my-1">
                                                                Checked and Verified
                                                            </a>
                                                        <?php endif; ?>
                                                    <?php elseif ($status_comaker == 0) : ?>
                                                        <a href="javascript:void(0);" class="btn btn-secondary btn-xs my-1">
                                                            Waiting for Co-maker's Approval
                                                        </a>
                                                    <?php else : ?>
                                                        <a href="javascript:void(0);" class="btn btn-secondary btn-xs my-1">
                                                            Disapproved by Co-maker
                                                        </a>

                                                    <?php endif; ?>

                                                <?php } elseif (isset($role_name) && ($role_name == 'Cashier')) {  ?>
                                                    <?php if ($status_manager == 1) : ?>
                                                        <?php if ($status_cashier == 0) : ?>
                                                            <a href="javascript:void(0);" class="btn btn-success btn-xs my-1 approve_cashier" title="Approve Loan" data-toggle="tooltip" data-placement="top" data-status_ref="<?= $row['status_ref'] ?>">
                                                                <i class="fas fa-thumbs-up"></i>&nbsp;Approve
                                                            </a>
                                                            <a href="javascript:void(0);" class="btn btn-danger btn-xs my-1 disapprove_cashier" title="Disapprove Loan" data-toggle="tooltip" data-placement="top" data-status_ref="<?= $row['status_ref'] ?>">
                                                                <i class="fas fa-thumbs-down"></i>&nbsp;Disapprove
                                                            </a>
                                                        <?php elseif ($status_cashier == 1) : ?>
                                                            <a href="javascript:void(0);" class="btn btn-secondary btn-xs my-1">
                                                                </i>&nbsp;Approved
                                                            </a>
                                                        <?php elseif ($status_cashier == 2) : ?>
                                                            <a href="javascript:void(0);" class="btn btn-secondary btn-xs my-1">
                                                                Released
                                                            </a>
                                                        <?php elseif ($status_cashier == 3) : ?>
                                                            <a href="javascript:void(0);" class="btn btn-secondary btn-xs my-1">
                                                                Disapproved
                                                            </a>
                                                        <?php endif; ?>
                                                    <?php elseif (($status_manager == 0) && ($status_processor == 0) && ($status_comaker == 0)) : ?>
                                                        <a href="javascript:void(0);" class="btn btn-secondary btn-xs my-1">
                                                            Waiting for Co-maker's Approval
                                                        </a>
                                                    <?php elseif (($status_manager == 0) && ($status_processor == 0) && ($status_comaker == 1)) : ?>
                                                        <a href="javascript:void(0);" class="btn btn-secondary btn-xs my-1">
                                                            Waiting for CC Member's Approval
                                                        </a>
                                                    <?php elseif (($status_manager == 0) && ($status_processor == 1) && ($status_comaker == 1)) : ?>
                                                        <a href="javascript:void(0);" class="btn btn-secondary btn-xs my-1">
                                                            Waiting for Manager's Approval
                                                        </a>
                                                    <?php else : ?>
                                                        <a href="javascript:void(0);" class="btn btn-secondary btn-xs my-1">
                                                            Disapproved by Co-maker
                                                        </a>
                                                    <?php endif; ?>
                                                <?php } else {
                                                    '';
                                                } ?>
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


    <div class="modal fade" id="viewloan">
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
                                <input type="text" id="borrower_name" class="form-control form-control-border text-center" readonly>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Reference Number</label>
                                <input type="text" id="ref_no" class="form-control form-control-border text-center" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Loan Amount</label>
                                <input type="text" id="viewloan_amount" class="form-control form-control-border text-center" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Loan Term</label>
                                <input type="text" id="viewloan_term" class="form-control form-control-border text-center" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Loan Date</label>
                                <input type="text" id="loan_date" class="form-control form-control-border text-center" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Loan Type</label>
                                <input type="text" id="viewloan_type" class="form-control form-control-border text-center" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Purpose</label>
                                <input type="text" id="purpose" class="form-control form-control-border text-center" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Co-Maker Name</label>
                                <input type="text" id="comaker_name" class="form-control form-control-border text-center" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Comaker's Status</label>
                                <input type="text" id="status_comaker" class="form-control form-control-border text-center" readonly>
                                <input type="text" id="comaker_date" class="form-control form-control-border text-center" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>CC Member's Status</label>
                                <input type="text" id="status_processor" class="form-control form-control-border text-center" readonly>
                                <input type="text" id="processor_date" class="form-control form-control-border text-center" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Manager's Status</label>
                                <input type="text" id="status_manager" class="form-control form-control-border text-center" readonly>
                                <input type="text" id="manager_date" class="form-control form-control-border text-center" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cashier's Status</label>
                                <input type="text" id="status_cashier" class="form-control form-control-border text-center" readonly>
                                <input type="text" id="cashier_date" class="form-control form-control-border text-center" readonly>
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
        $('#calculate').click(function() {
            calculate()
        })

        function calculate() {
            if ($('#plan_id').val() == '' || $('[name="amount"]').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops ...',
                    text: 'Please enter amount and plan term first.'
                })
                return false;
            }
            console.log({
                amount: $('[name="amount"]').val(),
                months: $('[name="loan_term"]').val(),
                membership: $('[name="membership"]').val()
            })
            $.ajax({
                url: "../../calculation_table.php",
                method: "POST",
                data: {
                    amount: $('[name="amount"]').val(),
                    months: $('[name="loan_term"]').val(),
                    membership: $('[name="membership"]').val()
                },
                success: function(resp) {
                    $('#calculation_table').html(resp)
                }
            })
        }

        $(document).ready(function() {
            $(".viewloan").click(function() {
                $('#borrower_name').val($(this).data('borrower_name'));
                $('#ref_no').val($(this).data('ref_no'));
                $('#viewloan_amount').val($(this).data('viewloan_amount'));
                $('#viewloan_term').val($(this).data('viewloan_term'));
                $('#loan_date').val($(this).data('loan_date'));
                $('#viewloan_type').val($(this).data('viewloan_type'));
                $('#purpose').val($(this).data('purpose'));
                $('#comaker_name').val($(this).data('comaker_name'));
                $('#status_comaker').val($(this).data('status_comaker'));
                $('#status_processor').val($(this).data('status_processor'));
                $('#status_manager').val($(this).data('status_manager'));
                $('#status_cashier').val($(this).data('status_cashier'));
                $('#comaker_date').val($(this).data('comaker_date'));
                $('#processor_date').val($(this).data('processor_date'));
                $('#manager_date').val($(this).data('manager_date'));
                $('#cashier_date').val($(this).data('cashier_date'));

                // $('#viewloan').modal('show');
            });
        });
    </script>

    <script>
        $(".approve_processor").click(function() {
            var status_ref = $(this).data('status_ref');
            console.log({
                status_ref
            });
            Swal.fire({
                title: 'Confirm Approve?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Approve'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../../config/update-status.php?approve_processor=" + status_ref + "&uid=" + <?= $_GET['uid'] ?> + "&aid=" + <?= $_SESSION['adminuser_id'] ?>;
                }
            })
        });

        $(".approve_manager").click(function() {
            var status_ref = $(this).data('status_ref');
            console.log({
                status_ref
            });
            Swal.fire({
                title: 'Confirm Approve?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Approve'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../../config/update-status.php?approve_manager=" + status_ref + "&uid=" + <?= $_GET['uid'] ?> + "&aid=" + <?= $_SESSION['adminuser_id'] ?>;
                }
            })
        });

        $(".disapprove_manager").click(function() {
            var status_ref = $(this).data('status_ref');
            console.log({
                status_ref
            });
            Swal.fire({
                title: 'Confirm Disapprove?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Disapprove'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../../config/update-status.php?disapprove_manager=" + status_ref + "&uid=" + <?= $_GET['uid'] ?>;
                }
            })
        });

        $(".approve_cashier").click(function() {
            var status_ref = $(this).data('status_ref');
            console.log({
                status_ref
            });
            Swal.fire({
                title: 'Confirm Approve?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Approve'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../../config/update-status.php?approve_cashier=" + status_ref + "&uid=" + <?= $_GET['uid'] ?>;
                }
            })
        });

        $(".disapprove_cashier").click(function() {
            var status_ref = $(this).data('status_ref');
            console.log({
                status_ref
            });
            Swal.fire({
                title: 'Confirm Disapprove?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Disapprove'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../../config/update-status.php?disapprove_cashier=" + status_ref + "&uid=" + <?= $_GET['uid'] ?>;
                }
            })
        });

        $(".release_cashier").click(function() {
            var status_ref = $(this).data('status_ref');
            console.log({
                status_ref
            });
            Swal.fire({
                title: 'Confirm Release?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Release'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../../config/update-status.php?release_cashier=" + status_ref + "&uid=" + <?= $_GET['uid'] ?>;
                }
            })
        });
    </script>
<?php endif ?>