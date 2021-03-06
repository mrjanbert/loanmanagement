<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header('location: http://localhost/loanmanagement/pages/err/404-error.php');
    exit();
};
?>
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
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $user_id = $_SESSION['user_id'];
                                $query = "SELECT * FROM tbl_users WHERE user_id != $user_id ";
                                $results = $conn->query($query);
                                while ($row = $results->fetch_assoc()) :
                                    $name = $row['lastName'] . ', ' . $row['firstName'] . ' ' . $row['middleName'][0] . '.';
                                    $role = $row['role_name'];
                                ?>
                                    <tr>
                                        <td><?php echo $name; ?> </td>
                                        <td><?php echo $role; ?> </td>
                                        <td>
                                            <a href="#" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
                                            <a href="#" class="btn btn-primary btn-xs my-1"><i class="fa fa-edit"></i></a>
                                            <a onclick="deleteuserpermission()" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <!-- <script>
                                        function deleteuserpermission() {
                                            Swal.fire({
                                                title: 'Delete <?php echo $name; ?> from database?',
                                                text: "You won't be able to revert this!",
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'Delete this user'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    Swal.fire(
                                                        'Deleting ...',
                                                        window.location.href = "../../code.php?permission_id=<?php echo $accountNumber ?>"
                                                    )
                                                }
                                            })
                                        }
                                    </script> -->
                                <?php endwhile; ?>
                            </tbody>
                        </table>
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
                                $user = $conn->query("SELECT *,concat(lastName,', ',firstName) AS name FROM tbl_users WHERE user_id != $user_id ORDER BY concat(lastName,', ',firstName) ASC ");
                                ?>
                                <select class="select2" name="selected_user" data-placeholder="Select user" style="width: 100%;" required>
                                    <option value=""></option>
                                    <?php while ($row = $user->fetch_assoc()) : ?>
                                        <option value="<?php echo $row['user_id'] ?>" <?php echo isset($user_id) && $user_id == $row['user_id'] ? "selected" : '' ?>><?php echo $row['name'] . ' ' . $row['middleName'][0] . '. | Account No.: ' . $row['accountNumber'] ?></option>
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