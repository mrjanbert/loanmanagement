<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header('location: http://localhost/loanmanagement/pages/err/404-error.php');
    exit();
};
?>

<?php if (isset($_SESSION['role_name']) && (trim($_SESSION['role_name']) == ("Admin"))) : ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Co-makers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Co-makers</li>
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
                            <h3 class="card-title">List of Co-makers</h3>
                            <div class="d-flex justify-content-end">
                                <?php if (isset($_SESSION['role_name']) && ($_SESSION['role_name'] == 'Admin')) {  ?>
                                    <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#addcomaker">
                                        <i class="fa fa-plus"></i> &nbsp;
                                        Add New Co-maker
                                    </button>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php include_once 'base/data-comakers.php' ?>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section><!-- /.content -->


    

    <script>
        $(".delete_comaker").click(function() {
            var del_comaker_id = $(this).data('del_comaker_id');
            console.log({
                del_comaker_id
            });
            Swal.fire({
                title: 'Confirm Delete?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete' 
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../../config/update-info.php?delete_comaker_id=" + del_comaker_id;
                }
            })
        });
    </script>

<?php else : ?>
    <script>
        window.location.href = "../err/403-error.php";
    </script>

<?php endif; ?>