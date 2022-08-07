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
                            <?php include_once 'base/data-view-loans.php' ?>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section><!-- /.content -->




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

        $(document).ready(function() {
            $(".viewuserloan").click(function() {
                $('#borrower_name').val($(this).data('borrower_name'));
                $('#ref_no').val($(this).data('ref_no'));
                $('#viewloan_amount').val($(this).data('viewloan_amount'));
                $('#viewloan_term').val($(this).data('viewloan_term'));
                $('#loan_date').val($(this).data('loan_date'));
                $('#viewloan_type').val($(this).data('viewloan_type'));
                $('#purpose').val($(this).data('purpose'));
                $('#comaker_name').val($(this).data('comaker_name'));
                $('#status_comaker').val($(this).data('status_comaker'));
                $('#status_processor').val($(this).data('status_processor'));
                $('#status_manager').val($(this).data('status_manager'));
                $('#status_cashier').val($(this).data('status_cashier'));
                $('#comaker_date').val($(this).data('comaker_date'));
                $('#processor_date').val($(this).data('processor_date'));
                $('#manager_date').val($(this).data('manager_date'));
                $('#cashier_date').val($(this).data('cashier_date'));

                $('#viewuserloan').modal('show');
            });
        });
    </script>

    <script>
        $(".approve_processor").click(function() {
            var status_ref = $(this).data('status_ref');
            console.log({
                status_ref
            });
            Swal.fire({
                title: 'Confirm Approve?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Approve'
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
                text: "You won't be able to revert this!",
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
                text: "You won't be able to revert this!",
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
                title: 'Confirm Approve?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Approve'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../../config/update-status.php?approve_cashier=" + status_ref + "&uid=" + <?= $_GET['uid'] ?>;
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

        $(".release_cashier").click(function() {
            var status_ref = $(this).data('status_ref');
            console.log({
                status_ref
            });
            Swal.fire({
                title: 'Confirm Release?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Release'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../../config/update-status.php?release_cashier=" + status_ref + "&uid=" + <?= $_GET['uid'] ?>;
                }
            })
        });

        $(".delete_loan").click(function() {
            var delete_loan = $(this).data('delete_loan');
            console.log({
                delete_loan
            });
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../../config/delete-loan.php?delete_loan_id=" + delete_loan + "&uid=" + <?= $_GET['uid'] ?>;
                }
            })
        });
    </script>
<?php endif ?>