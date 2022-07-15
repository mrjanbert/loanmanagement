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


<?php
// $ref_no = $_GET['ref_no'];
// $query = $conn->query("SELECT * FROM tbl_transaction WHERE ref_no = $ref_no");
// $data = $query->fetch_array();
// $amount = $data['amount'];

// // $penalty = $monthly * ($penalty/100);
// $interest = 0.01;
// $total_interest = ($amount * ($interest)) * $months;
// $monthly = ($amount + $total_interest) / $months;

// $share_capital = 0.01 * $amount; 	//fixed capital for members only
// $service_charge = 0.01 * $amount; //fixed service charge
// $notarial_fee = 100; 	//fixed notarial fee

// $total_less = $share_capital + $service_charge + $notarial_fee;
// $net = $amount - ($share_capital + $service_charge + $notarial_fee);
?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Payment History</h3>
                        <?php if (isset($_SESSION['role_name']) && (($_SESSION['role_name'] == 'Cashier') || ($_SESSION['role_name'] == 'Admin'))) {  ?>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addpayment">
                                <i class="fa fa-plus"></i> &nbsp;
                                Add Payment
                            </button>
                        </div>
                        <?php } ?>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="d-flex justify-content-end">
                            <button onclick="history.back()" class="btn btn-warning btn-sm">
                                <i class="fas fa-arrow-alt-circle-left"></i> &nbsp;
                                Back
                            </button>
                        </div>
                        <table id="example2" class="table table-bordered table-striped">
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
                            </tbody>
                        </table>
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