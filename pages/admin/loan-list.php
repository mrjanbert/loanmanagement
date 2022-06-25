<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Loans</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                                        <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editloan">
                                            <i class="fa fa-edit"></i>
                                        </button>
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
            <form action="#">
                <div class="modal-header">
                    <h4 class="modal-title">Apply New Loan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Borrower</label>
                        <select class="custom-select form-control-border">
                            <option value="" disabled selected>Select Borrower</option>
                            <option>Value 2</option>
                            <option>Value 3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Loan Plan</label>
                        <select class="custom-select form-control-border">
                            <option value="" disabled selected>Select Loan Plan</option>
                            <option>Value 2</option>
                            <option>Value 3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Loan Type</label>
                        <select class="custom-select form-control-border">
                            <option value="" disabled selected>Select Loan Type</option>
                            <option>Value 2</option>
                            <option>Value 3</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Purpose<small class="text-red">*</small></label>
                                <input type="text" class="form-control form-control-border" placeholder="Purpose" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Amount<small class="text-red">*</small></label>
                                <input type="text" class="form-control form-control-border"  placeholder="Enter amount" required>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- /.card-body -->
                <div class="modal-footer justify-content-end">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form><!-- /.modal-content -->
        </div>
    </div><!-- /.modal-dialog -->
</div>