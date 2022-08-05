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
                    <h1>User List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item">User List</li>
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
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Employee ID</th>
                                        <th>Borrower Name</th>
                                        <th>Address</th>
                                        <th>Contact No.</th>
                                        <th>Email Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $query = "SELECT * FROM tbl_users";
                                    $results = $conn->query($query);
                                    ?>
                                    <?php while ($row = $results->fetch_assoc()) : $user_id = $row['user_id']; ?>

                                        <tr>
                                            <td class="text-center"><?php echo $i++; ?></td>
                                            <td><?php echo $row['accountNumber']; ?></td>
                                            <td><?php echo $row['lastName'] . ', ' . $row['firstName'] . ' ' . $row['middleName'][0] . '.'; ?> </td>
                                            <td><?php echo $row['address']; ?></td>
                                            <td><?php echo $row['contactNumber']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td>
                                                <button class="btn btn-primary btn-xs view_userlist" 
                                                data-toggle="modal" 
                                                data-target="#view_userlist" 
                                                <?php if($row['profilePhoto'] != null) { ?> data-profilephoto="../../components/img/uploads/<?= $row['profilePhoto']; ?>" <?php } else { ?> data-profilephoto="../../assets/dist/img/profile.png" <?php } ?>  
                                                data-userid="<?= $row['user_id'] ?>" 
                                                data-idnumber="<?= $row['accountNumber'] ?>" 
                                                data-name="<?= $row['firstName'] . ' ' . $row['middleName'] . ' ' . $row['lastName'] ?>" 
                                                data-email="<?= $row['email'] ?>" 
                                                data-birthdate="<?= date('F j, Y', strtotime($row['birthDate'])) ?>" 
                                                data-contactnumber="<?= $row['contactNumber'] ?>" 
                                                data-rolename="<?= $row['role_name'] ?>" 
                                                data-address="<?= $row['address'] ?>" 
                                                data-usercreated="<?= date('F j, Y', strtotime($row['userCreated'])) ?>"><i class="fas fa-edit"></i> Edit</button>
                                                <a href="javascript:void(0);" class="btn btn-danger btn-xs delete_user" data-del_user_id="<?= $row['user_id'] ?>"><i class="fas fa-trash"></i> Delete</a>
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

    <div class="modal fade" id="view_userlist">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="../../config/update-info.php" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">Personal Information</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <input type="text" id="userid" name="user_id" hidden>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 d-flex justify-content-center">
                                <div class="image">
                                    <img id="profilephoto" class="img-circle elevation-3" alt="User Image" style="width: 250px; height: 250px;">
                                </div>
                            </div>
                            <div class="col-md-6 text-center">
                                <div class="form-group">
                                    <label>Account Number:</label>
                                    <input type="text" id="idnumber" name="accountNumber" class="form-control form-control-border text-center">
                                </div>
                                <div class="form-group">
                                    <label>Full Name:</label>
                                    <input type="text" id="name" class="form-control form-control-border text-center">
                                </div>
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input type="text" id="email" name="email" class="form-control form-control-border text-center">
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="form-group">
                                    <label>Birth Date:</label>
                                    <input type="text" id="birthdate" class="form-control form-control-border text-center">
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="form-group">
                                    <label>Contact Number:</label>
                                    <input type="text" id="contactnumber" name="contactNumber" class="form-control form-control-border text-center">
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="form-group">
                                    <label>User Role:</label>
                                    <input type="text" id="rolename" name="role_name" class="form-control form-control-border text-center">
                                </div>
                            </div>
                            <div class="col-md-6 text-center">
                                <div class="form-group">
                                    <label>Address:</label>
                                    <input type="text" id="address" name="address" class="form-control form-control-border text-center">
                                </div>
                            </div>
                            <div class="col-md-6 text-center">
                                <div class="form-group">
                                    <label>Date Registered:</label>
                                    <input type="text" id="usercreated" class="form-control form-control-border text-center">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button class="btn btn-secondary" id="cancel_btn" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="update_user_info">Save</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <script>
        $(document).ready(function() {
            $(".view_userlist").click(function() {
                $('#userid').val($(this).data('userid'));
                $('#idnumber').val($(this).data('idnumber'));
                $('#name').val($(this).data('name'));
                $('#email').val($(this).data('email'));
                $('#birthdate').val($(this).data('birthdate'));
                $('#contactnumber').val($(this).data('contactnumber'));
                $('#rolename').val($(this).data('rolename'));
                $('#address').val($(this).data('address'));
                $('#usercreated').val($(this).data('usercreated'));
                $('#profilephoto').attr('src', $(this).data('profilephoto'));
            });
        });

        $(".delete_user").click(function() {
            var del_user_id = $(this).data('del_user_id');
            console.log({
                del_user_id
            });
            Swal.fire({
                title: 'Delete this user from database?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../../config/delete-user.php?delete_user_id=" + del_user_id;
                }
            })
        });
    </script>

<?php else : ?>
    <script>
        window.location.href = "../err/403-error.php";
    </script>

<?php endif; ?>