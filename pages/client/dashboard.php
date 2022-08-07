<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header('location: http://localhost/loanmanagement/pages/err/404-error.php');
    exit();
};
?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <?php include_once 'base/data-dashboard.php' ?>
    </div>
    <!-- /.container-fluid -->

</section>
<!-- /.content -->

<script>
    function approve() {
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
                window.location.href = "../../config/update-status.php?approveref_no=<?php echo $row['status_ref']; ?>"
            }
        })
    }

    function disapprove() {
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
                window.location.href = "../../config/update-status.php?denyref_no=<?php echo $row['status_ref']; ?>"
            }
        })
    }
</script>