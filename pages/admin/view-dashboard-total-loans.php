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
                                        <th class="text-center">Borrower Name</th>
                                        <th class="text-center">Type of Loan</th>
                                        <th class="text-center">Principal Amount</th>
                                        <th class="text-center">View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $sql = mysqli_query($conn, "SELECT t.*, concat(b.firstName, ' ' ,b.lastName) as borrower_name FROM tbl_transaction t INNER JOIN tbl_borrowers b on b.user_id = t.borrower_id");

                                    while ($row = $sql->fetch_assoc()) {
                                        $ref_no = $row['ref_no'];
                                        $borrower_name = $row['borrower_name'];
                                        $loan_type = $row['loan_type'];
                                        $loan_type = $row['loan_type'];
                                        $amount = $row['amount'];
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $i++ ?></td>
                                            <td class="text-center"><?= $ref_no ?></td>
                                            <td><?= $borrower_name ?></td>
                                            <td><?= $loan_type ?></td>
                                            <td class="text-center"><?= number_format($amount, 2) ?></td>
                                            <td class="text-center">
                                                <a class="btn btn-info btn-xs my-1" href="index.php?page=view-dashboard-loan-information&ref_no=<?= $ref_no ?>">
                                                    Loan Information
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section><!-- /.content -->

<?php endif ?>