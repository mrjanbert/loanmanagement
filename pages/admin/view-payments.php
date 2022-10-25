<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header('location: ../error/404-error.php');
    exit();
};
?>
<?php if (isset($_SESSION['role_name']) && (trim($_SESSION['role_name']) != ('Unknown User'))) : ?>

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
                        <li class="breadcrumb-item">Borrowers</li>
                        <li class="breadcrumb-item">Loans</li>
                        <li class="breadcrumb-item active">View Payments</li>
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
                            <h2 class="card-title">Payment History</h2>
                            <div class="d-flex justify-content-end">
                                <button onclick="history.back()" class="btn btn-warning btn-sm">
                                    <i class="fas fa-arrow-alt-circle-left"></i> &nbsp;
                                    Back
                                </button>
                            </div>
                            <div class="row">
                                <?php
                                $ref_no = $_GET['refid'];
                                $sql = $conn->query("SELECT t.borrower_id, t.interest, t.comaker_id, t.amount, t.monthly, t.loan_term, t.loan_date, concat(b.firstName,' ',b.lastName) as borrower_name, concat(c.firstName,' ',c.lastName) as comaker_name FROM ((tbl_transaction t INNER JOIN tbl_borrowers b ON t.borrower_id = b.user_id) INNER JOIN tbl_comakers c ON t.comaker_id = c.user_id) WHERE ref_no = '$ref_no'");
                                $row = $sql->fetch_assoc();

                                ?>
                                <div class="col-md-3">
                                    <h3 class="card-title">Name: </h3>
                                </div>
                                <div class="col-md-9">
                                    <b><?php echo $row['borrower_name'] ?></b>
                                </div>
                                <div class="col-md-3">
                                    <h3 class="card-title">Loan Amount: </h3>
                                </div>
                                <div class="col-md-9">
                                    <b><?php echo number_format($row['amount'], 2); ?></b>
                                </div>
                                <div class="col-md-3">
                                    <h3 class="card-title">Monthly Amortization: </h3>
                                </div>
                                <div class="col-md-9">
                                    <b><?php echo number_format($row['monthly'], 2); ?></b>
                                </div>
                                <div class="col-md-3">
                                    <h3 class="card-title">Interest Rate: </h3>
                                </div>
                                <div class="col-md-9">
                                    <b><?php echo 1 . '%'; ?></b>
                                </div>
                                <div class="col-md-3">
                                    <h3 class="card-title">Term: </h3>
                                </div>
                                <div class="col-md-9">
                                    <b><?php echo $row['loan_term']; ?> &nbsp;Month/s</b>
                                </div>
                                <div class="col-md-3">
                                    <h3 class="card-title">Loan Date: </h3>
                                </div>
                                <div class="col-md-9">
                                    <b><?php echo date("F j, Y", strtotime($row['loan_date'])) ?></b>
                                </div>
                                <?php if ($row['borrower_id'] == $row['comaker_id']) { ?>
                                    <div class="col-md-3">
                                        <h3 class="card-title">Co-maker: </h3>
                                    </div>
                                    <div class="col-md-9">
                                    </div>
                                <?php } else { ?>
                                    <div class="col-md-3">
                                        <h3 class="card-title">Co-maker: </h3>
                                    </div>
                                    <div class="col-md-9">
                                        <b><?php echo $row['comaker_name'] ?></b>
                                    </div>
                                <?php } ?>
                                <div class="col-md-12 mt-2 mb-1">
                                    <h2 class="card-title">&nbsp;&nbsp;&nbsp;&nbsp;For Adjustments:</h2>
                                </div>
                                <div class="col-md-3">
                                    <h3 class="card-title">Interest <em>(per month)</em>: </h3>
                                </div>
                                <div class="col-md-9">
                                    <b><?php echo number_format($row['interest'], 2); ?></b>
                                </div>
                                <div class="col-md-3">
                                    <h3 class="card-title">Penalty <em>(per month)</em>: </h3>
                                </div>
                                <div class="col-md-9">
                                    <b><?php echo number_format($row['monthly'] * 0.015, 2); ?></b>
                                </div>
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <?php if (isset($_SESSION['role_name']) && (($_SESSION['role_name'] == 'Cashier'))) {  ?>
                                <div class="d-flex justify-content-end mb-2">
                                    <button class="btn btn-primary btn-sm mr-2" data-toggle="modal" data-target="#addpayment">
                                        <i class="fa fa-plus mr-1"></i>
                                        Add Payment
                                    </button>
                                    <button class="btn btn-info text-white btn-sm mr-2" data-toggle="modal" data-target="#adjustments">
                                        <i class="fas fa-sliders-h mr-1"></i>
                                        Add Adjustments
                                    </button>
                                    <a href="index.php?page=view-monthly-reminder&ref_no=<?= $_GET['refid'] ?>" class="btn btn-success btn-sm mr-2">
                                        <i class="far fa-bell mr-1"></i>
                                        Due Date Reminders
                                    </a>
                                </div>
                            <?php } ?>
                            <?php include_once 'base/data-view-payments.php' ?>
                        </div>
                    </div><!-- /.card -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section><!-- /.content -->

    <?php if (isset($_SESSION['role_name']) && (($_SESSION['role_name'] == 'Cashier'))) {  ?>
        <!-- Add Payment -->
        <div class="modal fade" id="addpayment">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <form action="../../config/test.php" method="POST" onsubmit="submitbtn.disabled = true; return true;" autocomplete="off">
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
                                            <label>Loan Reference No.</label>
                                            <input type="text" class="form-control form-control-border" name="ref_no" value="<?= $ref_no ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <!-- <div class="form-group pb-0">
                                            <label>Add Penalty?</label>
                                            <input class="ml-4 form-check-input" type="radio" value="1" name="radio1">
                                            <label class="ml-5 form-check-label">Yes</label>
                                            <input class="ml-4 form-check-input" type="radio" value="0" name="radio1">
                                            <label class="ml-5 form-check-label">No</label>
                                            <div class="d-flex">
                                                <input type="number" id="penaltyinput" name="month" class="form-control form-control-border" placeholder="Enter the number of months">
                                            </div>
                                        </div> -->

                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label>Payment Amount <small class="text-red">*</small></label>
                                            <input type="text" class="form-control form-control-border" name="payment_amount" placeholder="Enter Amount" required>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="form-group">
                                            <label>Forda Month of <small class="text-red">*</small></label>
                                            <select name="month_name" data-placeholder="Select Month" style="width: 100%;" class="select2" required>
                                                <option value=""></option>
                                                <option value="jan">January</option>
                                                <option value="feb">February</option>
                                                <option value="mar">March</option>
                                                <option value="apr">April</option>
                                                <option value="may">May</option>
                                                <option value="jun">June</option>
                                                <option value="jul">July</option>
                                                <option value="aug">August</option>
                                                <option value="sept">September</option>
                                                <option value="oct">October</option>
                                                <option value="nov">November</option>
                                                <option value="dec">December</option>
                                            </select>
                                            <!-- <input type="text" class="form-control form-control-border" name="ref_no" value="" readonly> -->
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>OR Number <small class="text-red">*</small></label>
                                            <input type="text" class="form-control form-control-border" maxlength="10" name="receipt_no" placeholder="Enter OR #" required>
                                        </div>
                                    </div>
                                    <!-- <div class="col-12">
                                        <div class="form-group">
                                            <label>Date <small class="text-red">*</small></label>
                                            <input type="text" class="form-control form-control-border" onfocus="(this.type='date')" onblur="(this.type='text')" name="payment_date" placeholder="Enter Payment Date" required>
                                        </div>
                                    </div> -->
                                </div>
                            <?php } ?>
                        </div>
                        <div class="modal-footer justify-content-end">
                            <input type="hidden" name="submit">
                            <button type="submit" name="submitbtn" class="btn btn-primary">
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
        <!-- Add Payments -->

        <!-- Add Adjustments -->
        <div class="modal fade" id="adjustments">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <form action="../../config/create-adjustment.php" method="POST" autocomplete="off" onsubmit="submitbtn.disabled = true; return true;">
                    <div class="modal-content card-outline card-primary">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Adjustments</h4>
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
                                        <label>Penalty (<i>computed by months</i>)</label>
                                        <input type="number" class="form-control form-control-border" name="penalty" placeholder="Enter the number of months">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Select operation of interest adjustment </label>
                                        <select name="operation" data-placeholder="Select Operation" style="width: 100%;" class="select2">
                                            <option value=""></option>
                                            <option value="add">Add Interest</option>
                                            <option value="minus">Deduct Interest</option>
                                        </select>
                                        <!-- <input type="text" class="form-control form-control-border" name="ref_no" value="" readonly> -->
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Interest</label>
                                        <input type="text" class="form-control form-control-border" name="interest" placeholder="Enter Interest">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Date <small class="text-red">*</small></label>
                                        <input type="text" class="form-control form-control-border" onfocus="(this.type='date')" onblur="(this.type='text')" name="payment_date" placeholder="Enter Adjustment Date" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-end">
                            <input type="hidden" name="addadjustment">
                            <button type="submit" name="submitbtn" class="btn btn-primary">
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
        <!-- Add Adjustments -->

        <div class="modal fade" id="edit_payment">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <form action="../../config/update-payment.php" method="POST" onsubmit="submitbtn.disabled = true; return true;" autocomplete="off">
                    <div class="modal-content card-outline card-primary">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Payment</h4>
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
                                    <input type="hidden" id="id" name="id">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Loan Reference No.</label>
                                            <input type="text" class="form-control form-control-border" name="ref_no" value="<?= $ref_no ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Select operation of interest adjustment </label>
                                            <select name="operation" data-placeholder="Select Operation" style="width: 100%;" class="select2">
                                                <option value=""></option>
                                                <option value="none">-- No Operation Selected --</option>
                                                <option value="add">Add Interest</option>
                                                <option value="minus">Deduct Interest</option>
                                            </select>
                                            <!-- <input type="text" class="form-control form-control-border" name="ref_no" value="" readonly> -->
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Interest</label>
                                            <input type="text" class="form-control form-control-border" id="interest" name="interest" placeholder="Interest">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Penalty</label>
                                            <input type="text" class="form-control form-control-border" id="penalty" name="penalty" placeholder="Penalty">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Payment</label>
                                            <input type="text" class="form-control form-control-border" id="payment_amount" name="payment_amount" placeholder="Payment" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>OR Number</label>
                                            <input type="text" class="form-control form-control-border" id="receipt_no" maxlength="10" name="receipt_no" placeholder="OR Number" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="text" class="form-control form-control-border" onfocus="(this.type='date')" onblur="(this.type='text')" id="payment_date" name="payment_date" placeholder="Date" required>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="modal-footer justify-content-end">
                            <input type="hidden" name="submit">
                            <button type="submit" name="submitbtn" class="btn btn-primary">
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

    <?php } ?>

    <script>
        let count = $('a.edit_payment').length;

        $('a.edit_payment').addClass('d-none');
        $('a.edit_payment').eq(count - 1).removeClass('d-none');


        $('#penaltyinput').hide();
        $('input[name="radio1"]').click(function() {
            var inputValue = $(this).attr("value");
            if (inputValue == 1) {
                $('#penaltyinput').show();
            } else {
                $('#penaltyinput').hide();
                $('#penaltyinput').val('');
            }
        })

        $('.edit_payment').click(function() {
            var id = $(this).data('id');
            var interest = $(this).data('interest');
            var penalty = $(this).data('penalty');
            var payment_amount = $(this).data('payment_amount');
            var receipt_no = $(this).data('receipt_no');
            var payment_date = $(this).data('payment_date');

            $('#id').val(id);
            $('#interest').val(interest);
            $('#penalty').val(penalty);
            $('#payment_amount').val(payment_amount);
            $('#receipt_no').val(receipt_no);
            $('#payment_date').val(payment_date);

        })
    </script>
<?php endif ?>