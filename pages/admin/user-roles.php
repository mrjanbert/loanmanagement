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
                    <h1>User Roles</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item">Users</li>
                        <li class="breadcrumb-item active">User Roles List</li>
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
                            <h3 class="card-title">List of Users</h3>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#create-permission">
                                    <i class="fa fa-plus"></i> &nbsp;
                                    Add New Permission
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php include_once 'base/data-user-roles.php' ?>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section><!-- /.content -->

    <div class="modal fade" id="create-permission">
        <div class="modal-dialog modal-md">
            <form action="../../config/create-permission.php" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Permision</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Select User</label>
                                    <?php
                                    $user = $conn->query("SELECT *,concat(lastName,', ',firstName) AS name FROM tbl_users WHERE user_id != $user_id ORDER BY lastName ASC ");
                                    ?>
                                    <select class="select2" name="selected_user" data-placeholder="Select user" style="width: 100%;" required>
                                        <option value=""></option>
                                        <?php while ($row = $user->fetch_assoc()) : ?>
                                            <option value="<?= $row['user_id'] ?>"><?= $row['name'] . ' ' . $row['middleName'][0] . '. | Account No.: ' . $row['accountNumber'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Set Role</label>
                                    <select class="select2" name="role_name" data-placeholder="Set user's role" style="width: 100%;" required>
                                        <option value=""></option>
                                        <option value="Manager">Manager</option>
                                        <option value="Processor">Processor</option>
                                        <option value="Cashier">Cashier</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="submit" name="submit" class="btn btn-primary">
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



    <script>
        $(".delete_role").click(function() {
            var perm_user_id = $(this).data('perm_user_id');
            console.log({
                perm_user_id
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
                    window.location.href = "../../config/delete-role.php?delete_permission_id=" + perm_user_id;
                }
            })
        });
    </script>

<?php else : ?>
    <script>
        window.location.href = "../err/403-error.php";
    </script>

<?php endif; ?>