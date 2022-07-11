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
                            <?php if(isset($_SESSION['role_name']) && ($_SESSION['role_name'] == 'Admin')) {  ?>
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
                                    <?php if(isset($_SESSION['role_name']) && ($_SESSION['role_name'] == null) || $_SESSION['role_name'] == 'Admin') {'';} 
                                    else { ?>
                                        <th class="text-center">Status</th>
                                    <?php } ?>
                                    <th class="text-center">View</th>
                                    
                                    <?php if(isset($_SESSION['role_name']) && ($_SESSION['role_name'] == null) || $_SESSION['role_name'] == 'Admin') { ?> 
                                        <th class="text-center">Action</th>
                                    <?php } ?>
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
                                $query = $conn->query("SELECT * FROM tbl_transaction ORDER BY id DESC");
                                while ($row = $query->fetch_assoc()) :
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i++; ?></td>
                                        <td><?php echo $row['ref_no']; ?></td>
                                        <td><?php echo $borrower_array[$row['user_id']]['firstName'] . ' ' . $borrower_array[$row['user_id']]['middleName'] . '. ' . $borrower_array[$row['user_id']]['lastName']; ?></td>
                                        <td><?php echo $row['loan_type']; ?></td>
                                        <td><b style="color: blue"><?php echo number_format($row['amount'], 2); ?></b></td>
                                        
                                        <?php if(isset($_SESSION['role_name']) && ($_SESSION['role_name'] == 'Manager')) {  ?>
                                        <td class="text-center">
                                            <?php if ($row['status_manager'] == 0) : ?>
                                            <button type="button" class="btn btn-warning btn-sm my-1">Pending</button>
                                            <?php elseif ($row['status_manager'] == 1) : ?>
                                            <button type="button" class="btn btn-info btn-sm my-1">Approved</button>
                                            <?php elseif ($row['status_manager'] == 3) : ?>
                                            <button type="button" class="btn btn-danger btn-sm my-1">Denied</button>
                                            <?php endif; ?>
                                        </td>
                                        <?php } elseif(isset($_SESSION['role_name']) && ($_SESSION['role_name'] == 'Processor')) {  ?>
                                        <td class="text-center">
                                            <?php if ($row['status_processor'] == 0) : ?>
                                            <button type="button" class="btn btn-warning btn-sm my-1">Pending</button>
                                            <?php elseif ($row['status_processor'] == 1) : ?>
                                            <button type="button" class="btn btn-info btn-sm my-1">Approved</button>
                                            <?php elseif ($row['status_processor'] == 3) : ?>
                                            <button type="button" class="btn btn-danger btn-sm my-1">Denied</button>
                                        </td>
                                            <?php endif; ?>
                                        <?php } elseif(isset($_SESSION['role_name']) && ($_SESSION['role_name'] == 'Cashier')) {  ?>
                                        <td class="text-center">
                                            <?php if ($row['status_cashier'] == 0) : ?>
                                            <button type="button" class="btn btn-warning btn-sm my-1">Pending</button>
                                            <?php elseif ($row['status_cashier'] == 1) : ?>
                                            <button type="button" class="btn btn-info btn-sm my-1">Approved</button>
                                            <?php elseif ($row['status_cashier'] == 2) : ?>
                                            <button type="button" class="btn btn-primary btn-sm my-1">Released</button>
                                            <?php elseif ($row['status_cashier'] == 3) : ?>
                                            <button type="button" class="btn btn-danger btn-sm my-1">Denied</button>
                                        </td>
                                            <?php endif; ?>
                                        <?php } else {'';} ?>

                                        <td class="text-center">
                                            <a href="index.php?page=grace-period&ref_no=<?php echo $row['ref_no']?>&usr=<?php echo base64_encode($_SESSION['role_name'])?>" class="btn btn-primary btn-sm" title="View Grace Period" data-toggle="tooltip" data-placement="top">
                                                <i class="fas fa-calendar-alt"></i>&nbsp; Grace Period
                                            </a>
                                            <a href="index.php?page=application-form&ref_no=<?php echo $row['ref_no']?>&usr=<?php echo base64_encode($_SESSION['role_name'])?>" class="btn btn-success btn-sm my-1" title="Print Application Form" data-toggle="tooltip" data-placement="top">
                                                <i class="fa fa-print"></i>&nbsp; Application Form
                                            </a>
                                        </td>
                                        <?php if(isset($_SESSION['role_name']) && ($_SESSION['role_name'] == 'Admin')) {  ?>

                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm my-1" title="Edit" data-toggle="tooltip" data-placement="top">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-danger btn-sm my-1" title="Delete" data-toggle="tooltip" data-placement="top">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                        <?php } ?>

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
                                    ?>
                                    <option value="<?php echo $row['user_id']?>"><?php echo $row['firstName'] . ' ' . $row['middleName'][0] . '. ' . $row['lastName']; ?></option>
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
</script>