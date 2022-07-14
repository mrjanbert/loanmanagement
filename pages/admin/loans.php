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
                            <?php if (isset($_SESSION['role_name']) && ($_SESSION['role_name'] == 'Admin')) {  ?>
                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addloan">
                                    <i class="fa fa-plus"></i> &nbsp;
                                    Apply New Loan
                                </button>
                            <?php } ?>
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
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $i = 1;
                                $role_name = $_SESSION['role_name'];
                                $query = $conn->query("SELECT t.*, concat(b.firstName,' ',b.middleName,' ',b.lastName) as borrower_name, s.*, concat(c.firstname, ' ', c.lastName) as comaker_name
                                    FROM (((tbl_transaction t 
                                        INNER JOIN tbl_borrowers b ON t.user_id = b.user_id) 
                                        INNER JOIN tbl_status s ON t.status_ref = s.ref_no) 
                                        INNER JOIN tbl_comakers c ON t.comaker_id = c.user_id) 
                                    WHERE s.status_comaker != '2' AND s.status_comaker != '0'");
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
                                            <?php if($status_processor == 1) : ?>
                                                <td class="text-center">
                                                    <?php if ($status_manager == 0) : ?>
                                                        <button type="button" class="btn btn-warning btn-sm my-1">Pending</button>
                                                    <?php elseif ($status_manager == 1) : ?>
                                                        <button type="button" class="btn btn-info btn-sm my-1">Approved</button>
                                                    <?php elseif ($status_manager == 3) : ?>
                                                        <button type="button" class="btn btn-danger btn-sm my-1">Denied</button>
                                                    <?php endif; ?>
                                                </td>
                                            <?php else : ?>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-danger btn-sm my-1">Disapproved by: CC Member</button>
                                                </td>
                                            <?php endif ?>
                                        <?php } elseif (isset($role_name) && ($role_name == 'Processor')) {  ?>
                                            <td class="text-center">
                                                <?php if ($status_processor == 0) : ?>
                                                    <button type="button" class="btn btn-warning btn-sm my-1">Pending</button>
                                                <?php elseif ($status_processor == 1) : ?>
                                                    <button type="button" class="btn btn-info btn-sm my-1">Approved</button>
                                                <?php elseif ($status_processor == 3) : ?>
                                                    <button type="button" class="btn btn-danger btn-sm my-1">Denied</button>
                                                <?php endif; ?>
                                            </td>
                                        <?php } elseif (isset($role_name) && ($role_name == 'Cashier')) {  ?>
                                            <?php if($status_manager == 1) : ?>
                                                <td class="text-center">
                                                    <?php if ($status_cashier == 0) : ?>
                                                        <button type="button" class="btn btn-warning btn-sm my-1">Pending</button>
                                                    <?php elseif ($status_cashier == 1) : ?>
                                                        <button type="button" class="btn btn-info btn-sm my-1">Approved</button>
                                                    <?php elseif ($status_cashier == 2) : ?>
                                                        <button type="button" class="btn btn-primary btn-sm my-1">Released</button>
                                                    <?php elseif ($status_cashier == 3) : ?>
                                                        <button type="button" class="btn btn-danger btn-sm my-1">Denied</button>
                                                <?php endif; ?>
                                                </td>
                                            <?php elseif($status_manager == 3) : ?>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-danger btn-sm my-1">Approved by: CC Member <br/>Disapproved by: Manager</button>
                                                </td>
                                            <?php else : ?>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-danger btn-sm my-1">Disapproved by: CC Member</button>
                                                </td>
                                            <?php endif ?>
                                        <?php } else { ''; } ?>
                                        <td class="text-center">
                                            <a href="index.php?page=grace-period&ref_no=<?= $ref_no ?>&usr=<?= base64_encode($role_name) ?>" class="btn btn-primary btn-sm" title="View Grace Period" data-toggle="tooltip" data-placement="top">
                                                <i class="fas fa-calendar-alt"></i>&nbsp; Grace Period
                                            </a>
                                            <a href="index.php?page=application-form&ref_no=<?= $ref_no ?>&usr=<?= base64_encode($role_name) ?>" class="btn btn-success btn-sm my-1" title="Print Application Form" data-toggle="tooltip" data-placement="top">
                                                <i class="fa fa-print"></i>&nbsp; Application Form
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <?php if (isset($role_name) && ($role_name == 'Admin')) {  ?>
                                            <a href="#" class="btn btn-primary btn-sm my-1" title="Edit" data-toggle="tooltip" data-placement="top">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-danger btn-sm my-1" title="Delete" data-toggle="tooltip" data-placement="top">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <?php } ?>
                                            <?php if (isset($role_name) && ($role_name == 'Manager')) {  ?>
                                            <div class="btn-group dropleft">
                                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-icon my-1" data-toggle="dropdown">
                                                    Action <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <?php if ($status_manager == 0) : ?>
                                                        <a class="dropdown-item" role="button" href = "../../config/update-status.php?approve_manager=<?php echo $row['status_ref'] ?>">Approve</a>
                                                        <a class="dropdown-item" role="button" href = "../../config/update-status.php?deny_manager=<?php echo $row['status_ref'] ?>">Disapprove</a>
                                                    <?php elseif ($status_manager == 1) : ?>
                                                        <a class="dropdown-item disabled" href="#">Approved</a>
                                                    <?php elseif ($status_manager == 2) : ?>
                                                        <a class="dropdown-item disabled" href="#">Disapproved</a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php } elseif (isset($role_name) && ($role_name == 'Processor')) {  ?>
                                            <div class="btn-group dropleft">
                                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-icon my-1" data-toggle="dropdown">
                                                    Action <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <?php if ($status_processor == 0) : ?>
                                                        <a class="dropdown-item" role="button" href = "../../config/update-status.php?approve_processor=<?php echo $row['status_ref'] ?>">Approve</a>
                                                        <a class="dropdown-item" role="button" href = "../../config/update-status.php?deny_processor=<?php echo $row['status_ref'] ?>">Disapprove</a>
                                                        
                                                    <?php elseif ($status_processor == 1) : ?>
                                                        <a class="dropdown-item disabled" href="#">Approved</a>
                                                    <?php elseif ($status_processor == 3) : ?>
                                                        <a class="dropdown-item disabled" href="#">Disapproved</a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php } elseif (isset($role_name) && ($role_name == 'Cashier')) {  ?>
                                            <div class="btn-group dropleft">
                                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-icon my-1" data-toggle="dropdown">
                                                    Action <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <?php if ($status_cashier == 0) : ?>
                                                        <a class="dropdown-item" role="button"  href = "../../config/update-status.php?approve_cashier=<?php echo $row['status_ref'] ?>">Approve</a>
                                                        <a class="dropdown-item" role="button"  href = "../../config/update-status.php?deny_cashier=<?php echo $row['status_ref'] ?>">Disapprove</a>
                                                    <?php elseif ($status_cashier == 1) : ?>
                                                        <a class="dropdown-item" href = "../../config/update-status.php?release_cash=<?php echo $row['status_ref'] ?>">Release</a>
                                                    <?php elseif ($status_cashier == 2) : ?>
                                                        <a class="dropdown-item disabled" href="#">Released</a>
                                                    <?php elseif ($status_cashier == 3) : ?>
                                                        <a class="dropdown-item disabled" href="#">Disapproved</a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php } else { ''; } ?>

                                            <button class="btn btn-success btn-sm viewloan" 
                                                data-ref_no="<?= $ref_no ?>"
                                                data-borrower_name = "<?= $borrower_name ?>"
                                                data-amount = "<?= number_format($amount, 2) ?>"
                                                data-loan_term = "<?= $loan_term ?> Months"
                                                data-loan_type = "<?= $loan_type ?>"
                                                data-loan_date = "<?= date('M j, Y - g:i A', $loan_date) ?>"
                                                data-purpose = "<?= $purpose ?>"
                                                data-comaker_name = "<?= $comaker_name ?>"
                                                data-status_processor = "<?php if($status_processor == '0'){ echo 'Pending';} elseif($status_processor == '1'){echo 'Approved';} elseif($status_processor == '3'){echo 'Disapproved';}?>"
                                                data-status_manager = "<?php if($status_manager == '0'){ echo 'Pending';} elseif($status_manager == '1'){echo 'Approved';} elseif($status_manager == '3'){echo 'Disapproved';}?>"
                                                data-status_cashier = "<?php if($status_cashier == '0'){ echo 'Pending';} elseif($status_cashier == '1'){echo 'Approved';} elseif($status_cashier == '2'){echo 'Released';} elseif($status_cashier == '3'){echo 'Disapproved';}?>"
                                                data-toggle="modal" 
                                                data-target="#viewloan">
                                                    <i class="fa fa-eye"></i>
                                                    View
                                            </button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="viewloan">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content card-outline card-primary">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Loan Information</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row text-center">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Borrower Name</label>
                                                                <input type="text" id="borrower_name" name="borrower_name" class="form-control form-control-border text-center" disabled>

                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label>Reference Number</label>
                                                                <input type="text" id="ref_no" name="ref_no" class="form-control form-control-border text-center" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label>Loan Amount</label>
                                                                <input type="text" id="amount" name="amount" class="form-control form-control-border text-center" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label>Loan Term</label>
                                                                <input type="text" id="loan_term" name="loan_term" class="form-control form-control-border text-center" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label>Loan Date</label>
                                                                <input type="text" id="loan_date" name="loan_date" class="form-control form-control-border text-center" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label>Loan Type</label>
                                                                <input type="text" id="loan_type" name="loan_type" class="form-control form-control-border text-center" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label>Purpose</label>
                                                                <input type="text" id="purpose" name="purpose" class="form-control form-control-border text-center" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Co-Maker Name</label>
                                                                <input type="text" id="comaker_name" name="comaker_name" class="form-control form-control-border text-center" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label>Processor's Status</label>
                                                                <input type="text" id="status_processor" name="status_processor" class="form-control form-control-border text-center" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label>Manager's Status</label>
                                                                <input type="text" id="status_manager" name="status_manager" class="form-control form-control-border text-center" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label>Cashier's Status</label>
                                                                <input type="text" id="status_cashier" name="status_cashier" class="form-control form-control-border text-center" disabled>
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
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section><!-- /.content -->


<div class="modal fade" id="addloan">
    <div class="modal-dialog modal-md">
        <div class="modal-content card-outline card-primary">
            <form action="../../config/create-userclientloan.php">
                <div class="modal-header">
                    <h4 class="modal-title">Apply New Loan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Borrower Name <small class="text-red">*</small></label>

                                <select class="select2" style="width: 100%;" name="selected-user" data-placeholder="Select borrower" required>
                                    <option></option>
                                    <?php
                                    $query = $conn->query("SELECT * FROM tbl_borrowers");
                                    while ($row = $query->fetch_assoc()) :
                                        $user_id = $row['user_id'];
                                        $firstName = $row['firstName'];
                                        $middleName = $row['middleName'];
                                        $lastName = $row['lastName'];
                                    ?>
                                        <option value="<?= $user_id ?>"><?= $firstName . ' ' . $middleName[0] . '. ' . $lastName; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Loan Amount: <small class="text-red">*</small></label>
                                <input type="number" id="amount" name="amount" class="form-control form-control-border" placeholder="Amount" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Term (month/s): <small class="text-red">*</small></label>
                                <input type="number" id="loan_term" name="loan_term" class="form-control form-control-border" placeholder="Loan Term" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Type of Loan <small class="text-red">*</small></label>
                        <input type="text" class="form-control form-control-border" name="loan_type" placeholder="Type of Loan" required>
                    </div>
                    <div class="form-group">
                        <label>Purpose <small class="text-red">*</small></label>
                        <input type="text" class="form-control form-control-border" name="purpose" placeholder="Purpose" required>
                    </div>

                    <input type="hidden" name="status_manager">
                    <input type="hidden" name="status_processor">
                    <input type="hidden" name="status_cashier">

                    <div class="col-12 d-flex justify-content-end">
                        <div class="form-group">
                            <label class="control-label">&nbsp;</label>
                            <button class="btn btn-primary btn-sm" type="button" id="calculate">Calculate</button>
                        </div>
                    </div>
                    <div id="calculation_table"></div>
                </div>
                <!-- /.card-body -->
                <div class="modal-footer justify-content-end">
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form><!-- /.modal-content -->
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

    $(document).ready(function () {
        $(".viewloan").click(function () {
            $('#borrower_name').val($(this).data('borrower_name'));
            $('#ref_no').val($(this).data('ref_no'));
            $('#amount').val($(this).data('amount'));
            $('#loan_term').val($(this).data('loan_term'));
            $('#loan_type').val($(this).data('loan_type'));
            $('#loan_date').val($(this).data('loan_date'));
            $('#purpose').val($(this).data('purpose'));
            $('#comaker_name').val($(this).data('comaker_name'));
            $('#status_processor').val($(this).data('status_processor'));
            $('#status_manager').val($(this).data('status_manager'));
            $('#status_cashier').val($(this).data('status_cashier'));

            $('#viewloan').modal('show');
        }); 
    }); 
</script>
<!-- <script>
    function deny_processor() {
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
                location.
            }
        })
    }
    
    function approve_processor() {
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
                window.location.
            }
        })
    }
</script> -->