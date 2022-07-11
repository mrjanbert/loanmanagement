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
                                    <th width="5%" class="text-center">#</th>
                                    <th width="20%" class="text-center">Loan Reference Number</th>
                                    <th width="20%"class="text-center">Borrower Name</th>
                                    <th width="20%" class="text-center">Principal Amount</th>
                                    <th width="15%"class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $i = 1;

                                $borrower = $conn->query("SELECT * FROM tbl_borrowers WHERE user_id in (SELECT user_id FROM tbl_transaction)");
                                while ($row = $borrower->fetch_assoc()) {
                                    $borrower_array[$row['user_id']] = $row;
                                }                                 
                                $query = $conn->query("SELECT * FROM tbl_transaction WHERE status_cashier = '2' ORDER BY id DESC");
                                while ($row = $query->fetch_assoc()) :
                                ?>
                                    <tr>
                                        <td>
                                            <?php echo $i++ ?>
                                        </td>
                                        <td>
                                            <?php echo $row['ref_no'] ?>
                                        </td>
                                        <td>
                                            <?php echo $borrower_array[$row['user_id']]['firstName'] . ' ' . $borrower_array[$row['user_id']]['middleName'][0] . '. ' . $borrower_array[$row['user_id']]['lastName']; ?>
                                        </td>
                                        <td>
                                            <?php echo number_format($row['amount'], 2) ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="index.php?page=view-payments&ref_no=<?php echo $row['ref_no']?>&usr=<?php echo base64_encode($_SESSION['role_name'])?>" class="btn btn-success btn-sm" title="View Payments" data-toggle="tooltip" data-placement="top" role="button">
                                                <i class="fas fa-eye"></i>&nbsp;
                                                View Payments
                                            </a>
                                        </td>
                                    </tr>   
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end mt-3">
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
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Loan Reference No. <small class="text-red">*</small></label>
                                
                                <select class="select2" style="width: 100%;" name="ref_no" data-placeholder="Select Loan Reference No." required>
                                    <option></option>
                                    <?php 
                                    $borrower = $conn->query("SELECT * FROM tbl_borrowers WHERE user_id in (SELECT user_id FROM tbl_transaction)");
                                    while ($row = $borrower->fetch_assoc()) {
                                        $borrower_array[$row['user_id']] = $row;
                                    }    
                                    $query = $conn->query("SELECT * FROM tbl_transaction WHERE status_cashier = '2' ORDER BY id DESC");
                                    while ($row = $query->fetch_assoc()) :
                                    ?>
                                    <option value="<?php echo $row['ref_no']?>"><?php echo $row['ref_no'] . ' - ' . $borrower_array[$row['user_id']]['firstName'] . ' ' . $borrower_array[$row['user_id']]['middleName'][0] . '. ' . $borrower_array[$row['user_id']]['lastName']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Payee <small class="text-red">*</small> </label>
                                <select class="select2" style="width: 100%;" name="payee" data-placeholder="Choose Payee" required>
                                    <option></option>
                                    <option value="Borrower">Borrower</option>
                                    <option value="Co-maker">Co-maker</option>
                                </select>
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
                                <label>Penalty</label>
                                <input type="number" class="form-control form-control-border" name="penalty" placeholder="Enter Penalty Amount">
                            </div>
                        </div>

                    </div>
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