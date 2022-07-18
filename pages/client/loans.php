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
                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addloan">
                                <i class="fa fa-plus"></i> &nbsp;
                                Apply New Loan
                            </button>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <?php
                                $i = 1;
                                $user_id = $_SESSION['user_id'];
                                $query = $conn->query("SELECT * FROM tbl_transaction WHERE borrower_id = $user_id ORDER BY id DESC");
                                $row = $query->fetch_assoc();
                            ?>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Reference No.</th>
                                    <th class="text-center">Principal Amount</th>
                                    <th class="text-center">Loan Date</th>
                                    <th class="text-center">Comaker's Status</th>
                                    <th class="text-center">CC Member's Status</th>
                                    <th class="text-center">Manager's Status</th>
                                    <th class="text-center">Cashier's Status</th>
                                    <th class="text-center">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = $conn->query("SELECT t.*, 
                                                    s.status_comaker, s.status_processor, s.status_manager, s.status_cashier, concat(c.firstName,' ', c.lastName) as comaker_name
                                                FROM tbl_transaction t 
                                                    INNER JOIN tbl_status s ON t.ref_no = s.ref_no 
                                                    INNER JOIN tbl_comakers c ON t.comaker_id = c.user_id 
                                                WHERE t.borrower_id = $user_id ORDER BY id DESC");
                                while ($row = $query->fetch_assoc()) :
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i++; ?></td>
                                        <td><?php echo $row['ref_no']; ?></td>
                                        <td><b style="color: blue"><?php echo number_format($row['amount'],2); ?></b></td>
                                        <td><?php echo date('F j, Y', strtotime($row['loan_date'])); ?></td>
                                        <td class="text-center">
                                            <?php if ($row['status_comaker'] == 0) : ?>
                                                <button type="button" style="pointer-events:none" class="btn btn-warning btn-sm btn-block">Pending</button>
                                            <?php elseif ($row['status_comaker'] == 1) : ?>
                                                <button type="button" style="pointer-events:none" class="btn btn-success btn-sm btn-block">Approved</button>
                                            <?php elseif ($row['status_comaker'] == 2) : ?>
                                                <button type="button" style="pointer-events:none" class="btn btn-danger btn-block btn-sm btn-block">Disapproved by: <?= $row['comaker_name'] ?></button>
                                            <?php endif; ?>
                                        </td>

                                        <?php if (($row['status_comaker'] == 1) && ($row['status_processor'] == 0) && ($row['status_manager'] == 0) && ($row['status_cashier'] == 0)) : ?>
                                            <td class="text-center">
                                                <button type="button" style="pointer-events:none" class="btn btn-warning btn-sm btn-block">Pending</button>
                                            </td>
                                            <td class="text-center">
                                            </td>
                                            <td class="text-center">
                                            </td>

                                        <?php elseif (($row['status_comaker'] == 1) && ($row['status_processor'] == 1) && ($row['status_manager'] == 0) && ($row['status_cashier'] == 0)) : ?>
                                            <td class="text-center">
                                                <button type="button" style="pointer-events:none"  class="btn btn-primary btn-sm btn-block">Checked and Verified</button>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" style="pointer-events:none" class="btn btn-warning btn-sm btn-block">Pending</button>
                                            </td>
                                            <td class="text-center">
                                            </td>

                                        <?php elseif (($row['status_comaker'] == 2) && ($row['status_processor'] == 0) && ($row['status_manager'] == 0) && ($row['status_cashier'] == 0)) : ?>
                                            <td class="text-center">
                                            </td>
                                            <td class="text-center">
                                            </td>
                                            <td class="text-center">
                                            </td>

                                        <?php elseif (($row['status_comaker'] == 0) && ($row['status_processor'] == 0) && ($row['status_manager'] == 0) && ($row['status_cashier'] == 0)) : ?>
                                            <td class="text-center">
                                            </td>
                                            <td class="text-center">
                                            </td>
                                            <td class="text-center">
                                            </td>

                                        <?php elseif (($row['status_comaker'] == 1) && ($row['status_processor'] == 1) && ($row['status_manager'] == 3) && ($row['status_cashier'] == 0)) : ?>
                                            <td class="text-center">
                                                <button type="button" style="pointer-events:none" class="btn btn-primary btn-sm btn-block">Checked and Verified</button>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" style="pointer-events:none" class="btn btn-danger btn-sm btn-block">Disapproved</button>
                                            </td>
                                            <td class="text-center">
                                            </td>
                                            
                                        <?php elseif (($row['status_comaker'] == 1) && ($row['status_processor'] == 1) && ($row['status_manager'] == 1) && ($row['status_cashier'] == 0)) : ?>
                                            <td class="text-center">
                                                <button type="button" style="pointer-events:none" class="btn btn-primary btn-sm btn-block">Checked and Verified</button>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" style="pointer-events:none" class="btn btn-primary btn-sm btn-block">Approved</button>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" style="pointer-events:none" class="btn btn-warning btn-sm btn-block">Pending</button>
                                            </td>
                                            
                                        <?php elseif (($row['status_comaker'] == 1) && ($row['status_processor'] == 1) && ($row['status_manager'] == 1) && ($row['status_cashier'] == 1)) : ?>
                                            <td class="text-center">
                                                <button type="button" style="pointer-events:none" class="btn btn-primary btn-sm btn-block">Checked and Verified</button>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" style="pointer-events:none" class="btn btn-primary btn-sm btn-block">Approved</button>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" style="pointer-events:none" class="btn btn-primary btn-sm btn-block">Approved</button>
                                            </td>
                                            
                                        <?php elseif (($row['status_comaker'] == 1) && ($row['status_processor'] == 1) && ($row['status_manager'] == 1) && ($row['status_cashier'] == 2)) : ?>
                                            <td class="text-center">
                                                <button type="button" style="pointer-events:none" class="btn btn-primary btn-sm btn-block">Checked and Verified</button>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" style="pointer-events:none" class="btn btn-primary btn-sm btn-block">Approved</button>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" style="pointer-events:none" class="btn btn-success btn-sm btn-block">Completed</button>
                                            </td>
                                            
                                        <?php elseif (($row['status_comaker'] == 1) && ($row['status_processor'] == 1) && ($row['status_manager'] == 1) && ($row['status_cashier'] == 3)) : ?>
                                            <td class="text-center">
                                                <button type="button" style="pointer-events:none" class="btn btn-primary btn-sm btn-block">Checked and Verified</button>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" style="pointer-events:none" class="btn btn-primary btn-sm btn-block">Approved</button>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" style="pointer-events:none" class="btn btn-info btn-sm btn-block">Disapproved</button>
                                            </td>
                                        <?php endif; ?>

                                        <td class="text-center">
                                            <a href="index.php?page=grace-period&ref_no=<?= $row['ref_no']?>" class="my-1 btn btn-primary btn-block btn-sm" title="View Grace Period" data-toggle="tooltip" data-placement="top">
                                                <i class="fas fa-calendar-alt"></i>&nbsp; Grace Period
                                            </a>
                                            <a href="index.php?page=application-form&ref_no=<?= $row['ref_no']?>" class="my-1 btn btn-success btn-block btn-sm" title="Print Application Form" data-toggle="tooltip" data-placement="top">
                                                <i class="fa fa-print"></i>&nbsp; Application Form
                                            </a>
                                            <button class="my-1 btn btn-info btn-sm btn-block viewloan" data-toggle="modal" data-target="#viewloan"
                                                data-borrower_name="<?= $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] ?>"
                                                data-ref_no="<?= $row['ref_no'] ?>"
                                                data-loan_amount="<?= number_format($row['amount'], 2) ?>"
                                                data-loan_terms = "<?= $row['loan_term'] ?> Months"
                                                data-loan_type = "<?= $row['loan_type'] ?>"
                                                data-loan_date = "<?= date('M j, Y - g:i A', strtotime($row['loan_date'])) ?>"
                                                data-purpose = "<?= $row['purpose'] ?>"
                                                data-comaker_name = "<?= $row['comaker_name'] ?>"
                                                data-status_comaker = "<?php 
                                                    if($row['status_comaker'] == '0'){ 
                                                        echo 'Pending';
                                                    } elseif($row['status_comaker'] == '1'){
                                                        echo 'Approved';
                                                    } elseif($row['status_comaker'] == '2'){
                                                        echo 'Disapproved';
                                                    }?>"
                                                data-status_processor = "<?php 
                                                    if(($row['status_comaker'] == '1') &&  ($row['status_processor'] == '0')){ 
                                                        echo 'Pending';
                                                    } elseif(($row['status_comaker'] == '1') &&  ($row['status_processor'] == '1')){
                                                        echo 'Checked and Verified';
                                                    } elseif(($row['status_comaker'] == '1') &&  ($row['status_processor'] == '3')){
                                                        echo 'Disapproved';
                                                    }else {
                                                        echo '';
                                                    }?>"
                                                data-status_manager = "<?php 
                                                    if(($row['status_processor'] == '1') && ($row['status_manager'] == '0')){
                                                        echo 'Pending';
                                                    }elseif(($row['status_processor'] == '1') && ($row['status_manager'] == '1')){
                                                        echo 'Approved';
                                                    } elseif(($row['status_processor'] == '1') && ($row['status_manager'] == '3')){
                                                            echo 'Disapproved';
                                                    }else {
                                                        echo '';
                                                    }?>"
                                                data-status_cashier = "<?php 
                                                    if(($row['status_manager'] == '1') && ($row['status_cashier'] == '0')){
                                                        echo 'Pending';
                                                    }elseif(($row['status_manager'] == '1') && ($row['status_cashier'] == '1')){
                                                        echo 'Approved';
                                                    }elseif(($row['status_manager'] == '1') && ($row['status_cashier'] == '2')){
                                                        echo 'Completed';
                                                    } elseif(($row['status_manager'] == '1') && ($row['status_cashier'] == '3')){
                                                            echo 'Disapproved';
                                                    }else {
                                                        echo '';
                                                    }?>">
                                                <i class="fa fa-eye"></i>
                                                View Loan
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


<div class="modal fade" id="addloan">
    <div class="modal-dialog modal-md">
        <div class="modal-content card-outline card-primary">
            <form action="../../config/create-userclientloan.php" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Apply New Loan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 m-0 p-0">
                            <?php if(isset($_SESSION['membership']) && ($_SESSION['membership']) == '0') :?>
                                <p>Status: <b class="text-warning">Non-member</b></p>
                            <?php elseif (isset($_SESSION['membership']) && ($_SESSION['membership']) == '1') : ?>
                                <p>Status: <b class="text-success">Member</b></p>
                            <?php endif; ?>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Loan Amount: <small class="text-red">*</small></label>
                                <input type="number" id="view_loan_amount" name="amount" class="form-control form-control-border" placeholder="Amount" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Term (month/s): <small class="text-red">*</small></label>
                                <input type="number" id="view_loan_months" name="loan_term" class="form-control form-control-border" placeholder="Loan Term" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Type of Loan <small class="text-red">*</small></label>
                        <input type="text" class="form-control form-control-border" id="view_loan_type" name="loan_type" placeholder="Type of Loan" required>
                    </div>
                    <div class="form-group">
                        <label>Purpose <small class="text-red">*</small></label>
                        <input type="text" class="form-control form-control-border" id="view_loan_purpose" name="purpose" placeholder="Purpose" required>
                    </div>
                    
                    <?php if(isset($_SESSION['membership']) && ($_SESSION['membership']) == '0') :?>
                    
                    <div class="form-group">
                        <label>Co-maker <small class="text-red">*</small></label>
                        
                        <select class="select2" style="width: 100%;" name="comaker_id" id="view_loan_comaker" data-placeholder="Choose Co-maker" required>
                            <option value=""></option>
                            <?php   
                                $query = $conn->query("SELECT * FROM tbl_comakers ORDER BY lastName DESC");
                                while ($row = $query->fetch_assoc()) :
                            ?>
                            <option value="<?php echo $row['user_id']?>"><?php echo $row['firstName'] . ' ' . $row['lastName']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                                
                    <?php elseif (isset($_SESSION['membership']) && ($_SESSION['membership']) == '1') : ?>

                    <div class="form-group">
                        <label>Co-maker <small>(optional)</small></label>
                        
                        <select class="select2" style="width: 100%;" name="comaker_id" id="view_loan_comaker" data-placeholder="Choose Co-maker">
                            <option value=""></option>
                            <?php
                                $query = $conn->query("SELECT * FROM tbl_comakers WHERE user_id != $user_id ORDER BY lastName ASC");
                                while ($row = $query->fetch_assoc()) :
                            ?>
                            <option value="<?php echo $row['user_id']?>"><?php echo $row['firstName'] . ' ' . $row['lastName']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <?php endif; ?>

                    <input type="hidden" name="borrower_id"  value="<?= $_SESSION['user_id']; ?>">
                    <input type="hidden" name="membership"  id="membership" value="<?= $_SESSION['membership']; ?>">

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
                        <button type="submit" name="submit" class="btn btn-primary">Apply</button>
                        <button type="button" class="btn btn-secondary" id="close_modal" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form><!-- /.modal-content -->
        </div>
    </div><!-- /.modal-dialog -->
</div>


<div class="modal fade" id="viewloan">
    <div class="modal-dialog modal-lg">
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
                            <input type="text" id="borrower_name" class="form-control form-control-border text-center" disabled>

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Reference Number</label>
                            <input type="text" id="ref_no" class="form-control form-control-border text-center" disabled>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Loan Amount</label>
                            <input type="text" id="loan_amount" class="form-control form-control-border text-center" disabled>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Loan Term</label>
                            <input type="text" id="loan_terms" class="form-control form-control-border text-center" disabled>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Loan Date</label>
                            <input type="text" id="loan_date" class="form-control form-control-border text-center" disabled>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Loan Type</label>
                            <input type="text" id="loan_type" class="form-control form-control-border text-center" disabled>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Purpose</label>
                            <input type="text" id="purpose" class="form-control form-control-border text-center" disabled>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Co-Maker Name</label>
                            <input type="text" id="comaker_name" class="form-control form-control-border text-center" disabled>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Comaker's Status</label>
                            <input type="text" id="status_comaker" class="form-control form-control-border text-center" disabled>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Processor's Status</label>
                            <input type="text" id="status_processor" class="form-control form-control-border text-center" disabled>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Manager's Status</label>
                            <input type="text" id="status_manager" class="form-control form-control-border text-center" disabled>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Cashier's Status</label>
                            <input type="text" id="status_cashier" class="form-control form-control-border text-center" disabled>
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
        if ($('[name="loan_term"]').val() == '' || $('[name="amount"]').val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops ...',
                text: 'Enter amount and loan term to calculate the value.'
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
            $('#loan_amount').val($(this).data('loan_amount'));
            $('#loan_terms').val($(this).data('loan_terms'));
            $('#loan_type').val($(this).data('loan_type'));
            $('#loan_date').val($(this).data('loan_date'));
            $('#purpose').val($(this).data('purpose'));
            $('#comaker_name').val($(this).data('comaker_name'));
            $('#status_comaker').val($(this).data('status_comaker'));
            $('#status_processor').val($(this).data('status_processor'));
            $('#status_manager').val($(this).data('status_manager'));
            $('#status_cashier').val($(this).data('status_cashier'));

            $('#viewloan').modal('show');
        }); 
    }); 
    
    $(document).ready(function () {
        $("#close_modal").click(function () {
            $('#view_loan_amount').val('');
            $('#view_loan_months').val('');
            $('#view_loan_type').val('');
            $('#view_loan_purpose').val('');
            $('view_#loan_comaker').val('');


            $('#addloan').modal('hide');
        }); 
    }); 
    
</script>