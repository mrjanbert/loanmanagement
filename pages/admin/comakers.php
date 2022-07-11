
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
                            <?php if(isset($_SESSION['role_name']) && ($_SESSION['role_name'] == 'Admin')) {  ?>
                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addcomaker">
                                <i class="fa fa-plus"></i> &nbsp;
                                Add New Co-maker
                            </button>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="10%" class="text-center">#</th>
                                    <th>Borrower Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $i = 1;
                                $query = $conn->query("SELECT * FROM tbl_comakers ORDER BY lastName ASC");
                                while($row = $query->fetch_assoc()):
                                    $name = $row['lastName'] . ' ' . $row['firstName'];

                            ?>
                            <tr>
                                <td class="text-center">
                                    <?= $i++; ?>
                                </td>
                                <td>
                                    <?= $name; ?>
                                </td>
                                <td></td>
                            </tr>
                                <?php endwhile ?>
                            </tbody>
                        </table>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section><!-- /.content -->


<div class="modal fade" id="addcomaker">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content card-outline card-primary">
            <form action="../../config/create-comaker.php" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Co-maker</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Borrower Name <small class="text-red">*</small></label>
                                <select class="select2" style="width: 100%;" name="user_id" data-placeholder="Select borrower" required>
                                    <option></option>
                                    <?php    
                                        $query = $conn->query("SELECT * FROM tbl_borrowers WHERE membership != '1' ");
                                        while ($row = $query->fetch_assoc()) :
                                    ?>
                                    <option value="<?php echo $row['user_id']?>"><?php echo $row['firstName'] . ' ' . $row['middleName'] . '. ' . $row['lastName']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="modal-footer justify-content-end">
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form><!-- /.modal-content -->
        </div>
    </div><!-- /.modal-dialog -->
</div>