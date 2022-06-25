<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Loan List</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Loan List</li>
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
                        <h3 class="card-title">Loans History</h3>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#addloan">
                                <i class="fa fa-plus"></i> &nbsp;
                                Apply New Loan
                            </button>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Account No.</th>
                                    <th>Type of Loan</th>
                                    <th>Mode of Payment</th>
                                    <th>Loan Amount</th>
                                    <th>Purpose</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>123</td>
                                    <td>Loan</td>
                                    <td>Salary Deduction</td>
                                    <td><b style="color: blue">300,000.00</b></td>
                                    <td>Renovation</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-xs">Approved</button>
                                    </td>
                                    <td>
                                        <button class="btn btn-success btn-xs my-1">
                                            <i class="fa fa-print"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section><!-- /.content -->


<style>
    option[value=""][disabled] {
        display: none;
    }
</style>


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
                    <div class="form-group">
                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Loan Plan<small class="text-red">*</small></label>
                        <?php
                            $plan = $conn->query("SELECT * FROM loan_plans order by `plan_term` desc ");
                        ?>
                        <select class="select2" name="plan_id" data-placeholder="Select Loan Plan" style="width: 100%;" required>
                            <option value=""></option>
                            <?php while ($row = $plan->fetch_assoc()) : ?>
                                <option value="<?php echo $row['plan_id'] ?>" <?php echo isset($plan_id) && $plan_id == $row['plan_id'] ? "selected" : '' ?> data-months="<?php echo $row['plan_term'] ?>" data-interest_percentage="<?php echo $row['interest_percentage'] ?>"><?php echo $row['plan_term'] . ' month/s [ ' . $row['interest_percentage'] . '%, ' . $row['mode_of_payment'] . ' ]' ?></option>
                            <?php endwhile; ?>
                        </select>
                        <small>months [interest%, mode of payment]</small>
                    </div>
                    <div class="form-group">
                        <label>Loan Type<small class="text-red">*</small></label>
                        <?php
                        $type = $conn->query("SELECT * FROM loan_types order by `typeofLoan` desc ");
                        ?>
                        <select class="select2" name="loantype_id" data-placeholder="Select Loan Type" style="width: 100%;" required>
                            <option value=""></option>
                            <?php while ($row = $type->fetch_assoc()) : ?>
                                <option value="<?php echo $row['loantype_id'] ?>" <?php echo isset($loantype_id) && $loantype_id == $row['loantype_id'] ? "selected" : '' ?>><?php echo $row['typeofLoan'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Purpose<small class="text-red">*</small></label>
                                <input type="text" name="purpose" class="form-control form-control-border" placeholder="Purpose" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Amount<small class="text-red">*</small></label>
                                <input type="number" name="amount" class="form-control form-control-border" placeholder="Enter amount" required>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="status" value="Pending">
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