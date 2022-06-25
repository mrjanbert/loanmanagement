<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Module Permissions</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item active">Module Permissions</li>
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
                        <h3 class="card-title">User Roles</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM tbl_users";
                                $results = $conn->query($query);
                                while ($row = $results->fetch_row()) :
                                    $role = $row[13];
                                ?>
                                    <tr>
                                        <td><?php echo $role; ?> </td>
                                        <td>
                                            <a href="#" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
                                            <!-- <a href="#" class="btn btn-primary btn-xs my-1"><i class="fa fa-edit"></i></a>
                                            <a onclick="deleteuserpermission()" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a> -->
                                        </td>
                                    </tr>
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
        <form action="../../config/create-permission.php">
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
                                    $user = $conn->query("SELECT *,concat(lastName,', ',firstName) as name FROM tbl_users order by concat(lastName,', ',firstName) asc ");
                                ?>
                                <select class="select2" name="selected_user" data-placeholder="Select user" style="width: 100%;">
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
                                <select class="select2" name="role_name" data-placeholder="Set user's role" style="width: 100%;">
                                    <option value=""></option>
                                    <option value="Manager">Manager</option>
                                    <option value="Processor">Processor</option>
                                    <option value="Teller">Teller</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="submit" class="btn btn-primary">
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
