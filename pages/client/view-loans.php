<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header('location: ../error/404-error.php');
    exit();
};
?>
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
                            <?php include_once 'base/data-loans.php'; ?>
                        </table>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section><!-- /.content -->

<?php include_once 'base/data-modals.php'; ?>

<script>
    $('#calculate').click(function() {
        calculate()
    })

    function calculate() {
        if ($('[name="loan_term"]').val() == '' || $('[name="amount"]').val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops ...',
                text: 'Enter amount and loan term to calculate the value.'
            })
            return false;
        }
        $.ajax({
            url: "base/calculation_table.php",
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
        $("#close_modal").click(function() {
            $('#view_loan_amount').val('');
            $('#view_loan_months').val('');
            $('#view_loan_type').val('');
            $('#view_loan_purpose').val('');
            $('#view_loan_comaker').prop('selectedIndex', 0);
            $('#addloan').modal('hide');
        });
    });
</script>