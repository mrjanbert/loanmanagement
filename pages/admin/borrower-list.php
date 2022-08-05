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
                            <table id="example1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Employee ID</th>
                                        <th class="text-center">Borrower Name</th>
                                        <th class="text-center">Date Registered</th>
                                        <th class="text-center">Membership Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $query = $conn->query("SELECT * FROM tbl_borrowers order by userCreated asc");
                                    while ($row = $query->fetch_assoc()) :
                                        $userCreated = strtotime($row['userCreated']);
                                        $birthDate = strtotime($row['birthDate']);
                                        $name = $row['firstName'] . ' ' . $row['middleName'] . ' ' . $row['lastName'];
                                        $accountNumber = $row['accountNumber'];
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $i++; ?></td>
                                            <td><?= $row['accountNumber']; ?></td>
                                            <td><?= $name ?> </td>
                                            <td><?= date('F j, Y', $userCreated); ?></td>
                                            <td><?php if ($row['membership'] == 1) {
                                                    echo 'Member';
                                                } else {
                                                    echo 'Non-member';
                                                }
                                                ?></td>
                                            <td class="text-center">
                                                <a class="btn btn-info btn-xs my-1 view_borrower" 
                                                href="javascript:void(0);" 
                                                data-toggle="modal" 
                                                data-target="#view_borrower"
                                                data-info_idnumber="<?= $accountNumber ?>" 
                                                data-info_name="<?= $name ?>" 
                                                <?php if($row['profilePhoto'] != null) { ?> data-info_image="../../assets/images/uploads/<?= $row['profilePhoto']; ?>" <?php } else { ?> data-info_image="../../assets/images/profile.png" <?php } ?>  
                                                data-info_age="<?= $row['age']; ?>" 
                                                data-info_mobilenumber="<?= $row['contactNumber']; ?>" 
                                                data-info_email="<?= $row['email']; ?>" 
                                                data-info_address="<?= $row['address']; ?>" 
                                                data-info_membership="<?= ($row['membership'] == 1) ? 'Member' : 'Non-member'; ?>" 
                                                data-info_birthdate="<?= date('F j, Y', $birthDate); ?>" 
                                                data-info_usercreated="<?= date('F j, Y', $userCreated); ?>">
                                                    View Info
                                                </a>
                                                <a href="index.php?page=view-loans&uid=<?= $row['user_id'] ?>" class="btn btn-primary btn-xs my-1">View Loans</a>

                                                <!-- Action for Admin only -->
                                                <?php if (isset($_SESSION['role_name']) && ($_SESSION['role_name'] == 'Admin')) {  ?>
                                                    <a class="btn btn-success btn-xs my-1 update_borrower" 
                                                    href="javascript:void(0);" 
                                                    data-toggle="modal" 
                                                    data-target="#update_borrower" 
                                                    data-update_userid="<?= $row['user_id'] ?>" 
                                                    data-update_info_idnumber="<?= $accountNumber ?>" 
                                                    data-update_info_name="<?= $name ?>" 
                                                    <?php if($row['profilePhoto'] != null) { ?> data-update_info_image="../../assets/images/uploads/<?= $row['profilePhoto']; ?>" <?php } else { ?> data-update_info_image="../../assets/dist/img/profile.png" <?php } ?>  
                                                    data-update_info_age="<?= $row['age']; ?>" 
                                                    data-update_info_mobilenumber="<?= $row['contactNumber']; ?>" 
                                                    data-update_info_email="<?= $row['email']; ?>" 
                                                    data-update_info_address="<?= $row['address']; ?>" 
                                                    data-update_info_membership="<?= ($row['membership'] == 1) ? 'Member' : 'Non-member'; ?>" 
                                                    data-update_info_birthdate="<?= date('F j, Y', $birthDate); ?>" 
                                                    data-update_info_usercreated="<?= date('F j, Y', $userCreated); ?>">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-danger btn-xs delete_borrower" data-del_borrowerid="<?= $row['user_id'] ?>"><i class="fas fa-trash"></i></a>
                                                <?php } else {
                                                    '';
                                                } ?>
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

    <!-- MODAL TO VIEW BORROWER -->
    <div class="modal fade" id="view_borrower">
        <div class="modal-dialog modal-lg">
            <form action="">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Personal Information </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 d-flex justify-content-center">
                                <div class="image">
                                    <img id="info_image" class="img-circle elevation-3" alt="User Image" style="width: 250px; height: 250px;">
                                </div>
                            </div>
                            <div class="col-md-6 text-center">
                                <div class="form-group">
                                    <label>ID Number:</label>
                                    <input type="text" id="info_idnumber" class="form-control form-control-border text-center" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Full Name:</label>
                                    <input type="text" id="info_name" class="form-control form-control-border text-center" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input type="text" id="info_email" class="form-control form-control-border text-center" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="form-group">
                                    <label>Age:</label>
                                    <input type="text" id="info_age" class="form-control form-control-border text-center" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="form-group">
                                    <label>Contact Number:</label>
                                    <input type="text" id="info_mobilenumber" class="form-control form-control-border text-center" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="form-group">
                                    <label>Membership Status:</label>
                                    <input type="text" id="info_membership" class="form-control form-control-border text-center" readonly>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <div class="form-group">
                                    <label>Address:</label>
                                    <input type="text" id="info_address" class="form-control form-control-border text-center" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 text-center">
                                <div class="form-group">
                                    <label>Birth Date:</label>
                                    <input type="text" id="info_birthdate" class="form-control form-control-border text-center" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 text-center">
                                <div class="form-group">
                                    <label>Date Registered:</label>
                                    <input type="text" id="info_usercreated" class="form-control form-control-border text-center" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </form><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- END OF MODAL VIEW -->

    <!-- MODAL TO UPDATE BORROWER FOR ADMIN -->
    <div class="modal fade" id="update_borrower">
        <div class="modal-dialog modal-lg">
            <form action="../../config/update-info.php" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Personal Information </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <input type="text" id="update_userid" name="user_id" hidden>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 d-flex justify-content-center">
                                <div class="image">
                                    <img id="update_info_image" class="img-circle elevation-3" alt="User Image" style="width: 250px; height: 250px;">
                                </div>
                            </div>
                            <div class="col-md-6 text-center">
                                <div class="form-group">
                                    <label>ID Number:</label>
                                    <input type="text" id="update_info_idnumber" name="accountNumber" class="form-control form-control-border text-center">
                                </div>
                                <div class="form-group">
                                    <label>Full Name:</label>
                                    <input type="text" id="update_info_name" class="form-control form-control-border text-center">
                                </div>
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input type="text" id="update_info_email" name="email" class="form-control form-control-border text-center">
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="form-group">
                                    <label>Age:</label>
                                    <input type="text" id="update_info_age" class="form-control form-control-border text-center">
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="form-group">
                                    <label>Contact Number:</label>
                                    <input type="text" id="update_info_mobilenumber" name="contactNumber" class="form-control form-control-border text-center">
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="form-group">
                                    <label>Membership Status:</label>
                                    <input type="text" id="update_info_membership" class="form-control form-control-border text-center">
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <div class="form-group">
                                    <label>Address:</label>
                                    <input type="text" id="update_info_address" name="address" class="form-control form-control-border text-center">
                                </div>
                            </div>
                            <div class="col-md-6 text-center">
                                <div class="form-group">
                                    <label>Birth Date:</label>
                                    <input type="text" id="update_info_birthdate" class="form-control form-control-border text-center">
                                </div>
                            </div>
                            <div class="col-md-6 text-center">
                                <div class="form-group">
                                    <label>Date Registered:</label>
                                    <input type="text" id="update_info_usercreated" class="form-control form-control-border text-center">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button name="update_borrower" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </form><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


    <script>
        function deleteborrower() {
            Swal.fire({
                title: 'Delete ... from database?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete this user'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../../code.php?deleteborrower_id=..."
                }
            })
        }

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

        $(document).ready(function() {
            $(".update_borrower").click(function() {
                $('#update_userid').val($(this).data('update_userid'));
                $('#update_info_name').val($(this).data('update_info_name'));
                $('#update_info_idnumber').val($(this).data('update_info_idnumber'));
                $('#update_info_age').val($(this).data('update_info_age'));
                $('#update_info_birthdate').val($(this).data('update_info_birthdate'));
                $('#update_info_mobilenumber').val($(this).data('update_info_mobilenumber'));
                $('#update_info_address').val($(this).data('update_info_address'));
                $('#update_info_membership').val($(this).data('update_info_membership'));
                $('#update_info_email').val($(this).data('update_info_email'));
                $('#update_info_usercreated').val($(this).data('update_info_usercreated'));
                $('#update_info_image').attr('src', $(this).data('update_info_image'));

                $('#update_borrower').modal('show');
            });
        });
    </script>
<?php endif; ?>