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
                    <h1>Borrowers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Borrowers</li>
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
                            <h3 class="card-title">List of Borrowers</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php include_once 'base/data-borrower-list.php' ?>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section><!-- /.content -->




    <script>
        $(document).ready(function() {
            $(".view_borrower").click(function() {
                $('#info_name').val($(this).data('info_name'));
                $('#info_idnumber').val($(this).data('info_idnumber'));
                $('#info_age').val($(this).data('info_age'));
                $('#info_birthdate').val($(this).data('info_birthdate'));
                $('#info_mobilenumber').val($(this).data('info_mobilenumber'));
                $('#info_address').val($(this).data('info_address'));
                $('#info_membership').val($(this).data('info_membership'));
                $('#info_email').val($(this).data('info_email'));
                $('#info_usercreated').val($(this).data('info_usercreated'));
                $('#info_image').attr('src', $(this).data('info_image'));

                $('#view_borrower').modal('show');
            });
        });

        $(".delete_borrower").click(function() {
            var del_borrowerid = $(this).data('del_borrowerid');
            console.log({
                del_borrowerid
            });
            Swal.fire({
                title: 'Delete this borrower from database?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../../config/delete-user.php?delete_borrower_id=" + del_borrowerid;
                }
            })
        });
    </script>
<?php endif; ?>