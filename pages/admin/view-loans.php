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
                    <h1>Loans</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item">Borrowers</li>
                        <li class="breadcrumb-item active">View Loans</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <?php
                    $query = "SELECT SUM(t.amount) as total_loan FROM tbl_transaction t INNER JOIN tbl_status s ON s.ref_no = t.ref_no WHERE borrower_id = " . $_GET['uid'] . " AND s.status_cashier = '2'";
                    $results = mysqli_query($conn, $query);
                    $data = $results->fetch_assoc();
                    $total_loan = $data['total_loan'];
                    ?>
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="far fa-credit-card"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Loans</span>
                            <span class="info-box-number">
                                <?= number_format($total_loan, 2) ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <?php
                    $query = "SELECT SUM(p.payment_amount) as payment_amount FROM ((tbl_payments p INNER JOIN tbl_transaction t ON p.ref_no = t.ref_no) INNER JOIN tbl_borrowers b ON t.borrower_id = b.user_id) WHERE b.user_id = " . $_GET['uid'];
                    $results = mysqli_query($conn, $query);
                    $data = $results->fetch_assoc();
                    $payment_amount = $data['payment_amount'];
                    ?>
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-bill-wave"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Payments</span>
                            <span class="info-box-number">
                                <?= number_format($payment_amount, 2) ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
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
                            <?php include_once 'base/data-view-loans.php' ?>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section><!-- /.content -->

    <script>
        $(".approve_processor").click(function() {
            var status_ref = $(this).data('status_ref');
            console.log({
                status_ref
            });
            Swal.fire({
                title: 'Check and Verify?',
                text: "You won\'t be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Check and Verify'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../../config/update-status.php?approve_processor=" + status_ref + "&uid=" + <?= $_GET['uid'] ?> + "&aid=" + <?= $_SESSION['adminuser_id'] ?>;
                }
            })
        });

        $(".approve_manager").click(function() {
            var status_ref = $(this).data('status_ref');
            console.log({
                status_ref
            });
            Swal.fire({
                title: 'Confirm Approve?',
                text: "You won\'t be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Approve'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../../config/update-status.php?approve_manager=" + status_ref + "&uid=" + <?= $_GET['uid'] ?> + "&aid=" + <?= $_SESSION['adminuser_id'] ?>;
                }
            })
        });

        $(".disapprove_manager").click(function() {
            var status_ref = $(this).data('status_ref');
            console.log({
                status_ref
            });
            Swal.fire({
                title: 'Confirm Disapprove?',
                text: "You won\'t be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Disapprove'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../../config/update-status.php?disapprove_manager=" + status_ref + "&uid=" + <?= $_GET['uid'] ?>;
                }
            })
        });

        $(".approve_cashier").click(function() {
            var status_ref = $(this).data('status_ref');
            console.log({
                status_ref
            });
            Swal.fire({
                title: 'Release the loan?',
                text: "Clicking the release button will also complete the loan process.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Release'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../../config/update-status.php?approve_cashier=" + status_ref + "&uid=" + <?= $_GET['uid'] ?> + "&aid=" + <?= $_SESSION['adminuser_id'] ?>;
                }
            })
        });

        $(".disapprove_cashier").click(function() {
            var status_ref = $(this).data('status_ref');
            console.log({
                status_ref
            });
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
                    window.location.href = "../../config/update-status.php?disapprove_cashier=" + status_ref + "&uid=" + <?= $_GET['uid'] ?>;
                }
            })
        });
    </script>
<?php endif ?>