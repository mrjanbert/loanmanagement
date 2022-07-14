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
                                $query = $conn->query("SELECT * FROM tbl_transaction WHERE user_id = $user_id ORDER BY id DESC");
                                $row = $query->fetch_assoc();
                            ?>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Reference No.</th>
                                    <th class="text-center">Principal Amount</th>
                                    <th class="text-center">Loan Date</th>
                                    <th class="text-center">Comaker's Status</th>
                                    <th class="text-center">Processor's Status</th>
                                    <th class="text-center">Manager's Status</th>
                                    <th class="text-center">Cashier's Status</th>
                                    <th class="text-center">View</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $i = 1;
                                
                                $user_id = $_SESSION['user_id'];
                                $query = $conn->query("SELECT t.*, 
                                                    s.status_comaker, s.status_processor, s.status_manager, s.status_cashier, 
                                                    concat(c.firstName,' ', c.lastName) as comaker_name
                                                FROM tbl_transaction t 
                                                    INNER JOIN tbl_status s ON t.ref_no = s.ref_no 
                                                    INNER JOIN tbl_comakers c ON t.comaker_id = c.user_id 
                                                WHERE t.user_id = $user_id ORDER BY id DESC");
                                while ($row = $query->fetch_assoc()) :
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i++; ?></td>
                                        <td><?php echo $row['ref_no']; ?></td>
                                        <td><b style="color: blue"><?php echo number_format($row['amount'],2); ?></b></td>
                                        <td><?php echo date('F j, Y', strtotime($row['loan_date'])); ?></td>
                                        <td class="text-center">
                                            <?php if ($row['status_comaker'] == 0) : ?>
                                                <button type="button" class="btn btn-warning btn-sm">Pending</button>
                                            <?php elseif ($row['status_comaker'] == 1) : ?>
                                                <button type="button" class="btn btn-success btn-sm">Approved</button>
                                            <?php elseif ($row['status_comaker'] == 2) : ?>
                                                <button type="button" class="btn btn-danger btn-block btn-sm">Disapproved by: <?= $row['comaker_name'] ?></button>
                                            <?php endif; ?>
                                        </td>
                                        <?php if ($row['status_comaker'] == 1) : ?>
                                            <td class="text-center">
                                                <?php if ($row['status_processor'] == 0) : ?>
                                                    <button type="button" class="btn btn-warning btn-sm">Pending</button>
                                                <?php elseif ($row['status_processor'] == 1) : ?>
                                                    <button type="button" class="btn btn-info btn-sm">Approved</button>
                                                <?php elseif ($row['status_processor'] == 3) : ?>
                                                    <button type="button" class="btn btn-danger btn-sm">Disapproved</button>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($row['status_manager'] == 0) : ?>
                                                    <button type="button" class="btn btn-warning btn-sm">Pending</button>
                                                <?php elseif ($row['status_manager'] == 1) : ?>
                                                    <button type="button" class="btn btn-info btn-sm">Approved</button>
                                                <?php elseif ($row['status_manager'] == 3) : ?>
                                                    <button type="button" class="btn btn-danger btn-sm">Disapproved</button>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($row['status_cashier'] == 0) : ?>
                                                    <button type="button" class="btn btn-warning btn-sm">Pending</button>
                                                <?php elseif ($row['status_cashier'] == 1) : ?>
                                                    <button type="button" class="btn btn-info btn-sm">Approved</button>
                                                <?php elseif ($row['status_cashier'] == 2) : ?>
                                                    <button type="button" class="btn btn-primary btn-sm">Released</button>
                                                <?php elseif ($row['status_cashier'] == 3) : ?>
                                                    <button type="button" class="btn btn-danger btn-sm">Disapproved</button>
                                                <?php endif; ?>
                                            </td>
                                        <?php else : ?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <?php endif; ?>
                                        <td class="text-center">
                                            <a href="index.php?page=grace-period&ref_no=<?php echo $row['ref_no']?>" class="btn btn-primary btn-block btn-sm" title="View Grace Period" data-toggle="tooltip" data-placement="top">
                                                <i class="fas fa-calendar-alt"></i>&nbsp; Grace Period
                                            </a>
                                            <a href="index.php?page=application-form&ref_no=<?php echo $row['ref_no']?>" class="btn btn-success btn-block btn-sm my-1" title="Print Application Form" data-toggle="tooltip" data-placement="top">
                                                <i class="fa fa-print"></i>&nbsp; Application Form
                                            </a>
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
                    
                    <?php if(isset($_SESSION['membership']) && ($_SESSION['membership']) == '0') :?>
                    
                    <div class="form-group">
                        <label>Co-maker <small class="text-red">*</small></label>
                        
                        <select class="select2" style="width: 100%;" name="comaker_id" data-placeholder="Choose Co-maker" required>
                            <option value=""></option>
                            <?php   
                                $user_id = $_SESSION['user_id'];
                                $query = $conn->query("SELECT * FROM tbl_comakers ORDER BY lastName DESC");
                                while ($row = $query->fetch_assoc()) :
                            ?>
                            <option value="<?php echo $row['user_id']?>"><?php echo $row['firstName'] . ' ' . $row['lastName']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                                
                    <?php elseif (isset($_SESSION['membership']) && ($_SESSION['membership']) == '1') : ?>

                    <!-- <div class="form-group">
                        <label>Co-maker <small>(optional)</small></label>
                        
                        <select class="select2" style="width: 100%;" name="comaker_id" data-placeholder="Choose Co-maker">
                            <option value=""></option>
                            <?php
                                $query = $conn->query("SELECT * FROM tbl_comakers WHERE user_id != $user_id ORDER BY lastName ASC");
                                while ($row = $query->fetch_assoc()) :
                            ?>
                            <option value="<?php echo $row['user_id']?>"><?php echo $row['firstName'] . ' ' . $row['lastName']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div> -->
                    <input type="hidden" name="comaker_id"  value="<?php echo $_SESSION['user_id']; ?>">
                    <?php endif; ?>

                    <input type="hidden" name="user_id"  value="<?php echo $_SESSION['user_id']; ?>">
                    <input type="hidden" name="membership"  id="membership" value="<?php echo $_SESSION['membership']; ?>">

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
                        <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Cancel</button>
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

    $('#close').click(function() {
        close();
    })
    function close() {
        $(".modal").on("hidden.bs.modal", function(){
            $('#addloan').find("input[type=text], select").val("");
        });
    }
</script>