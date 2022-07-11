
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
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Employee ID</th>
                                    <th>Borrower Name</th>
                                    <th>Date Registered</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i = 1;
                                    $query = $conn->query("SELECT * FROM tbl_borrowers order by userCreated asc");
                                    while ($row = $query->fetch_assoc()) : 
                                        $userCreated = strtotime($row['userCreated']);
                                        $birthDate = strtotime($row['birthDate']);
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $i++; ?></td>
                                        <td><?= $row['accountNumber']; ?></td>
                                        <td><?= $row['firstName'] . '  ' . $row['middleName'] . ' ' . $row['lastName']; ?> </td>
                                            <td><?= date('F j, Y', $userCreated); ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-info btn-xs" data-toggle="modal" id="view" name="<?= $row['user_id'];?>" value="<?= $row['user_id']; ?>" data-target="#view_borrower"><i class="fa fa-eye"></i></button>
                                            <?php if(isset($_SESSION['role_name']) && ($_SESSION['role_name'] == 'Admin')) {  ?>
                                            <a href="borrower_update.php?page=borrower_list&account_number=<?= $row['accountNumber']; ?>" class="btn btn-primary btn-xs my-1"><i class="fa fa-edit"></i></a>
                                            <a onclick="deleteborrower()" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
                                            <?php } else {'';}?>
                                        </td>
                                    </tr>
                                    <script>
                                        function deleteborrower() {
                                            Swal.fire({
                                                title: 'Delete <?php echo $row['accountNumber']; ?> from database?',
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
                                                        window.location.href = "../../code.php?deleteborrower_id=<?= $row['user_id']; ?>"
                                                    )
                                                }
                                            })
                                        }
                                    </script>

                                    <div class="modal fade" id="view_borrower">
                                        <div class="modal-dialog modal-md">\
                                            <form action="">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="name" value="<?= $row['firstName'] . ' ' . $row['lastName']; ?>">Information of <?= $row['firstName'] . ' ' . $row['lastName']; ?> </h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-12 d-flex justify-content-center mb-4">
                                                                <div class="image">
                                                                    <img src="../../components/img/uploads/<?= $row['profilePhoto']; ?>" class="img-square elevation-3" alt="User Image" style="max-width: 200px; height: 200px;">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 text-center">
                                                                <div class="form-group">
                                                                    <label>Account Number:</label>
                                                                    <p id="account" name="account" value="<?= $row['accountNumber']; ?>"><?= $row['accountNumber']; ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 text-center">
                                                                <div class="form-group">
                                                                    <label>Full Name:</label>
                                                                    <p><?= $row['firstName'] . ' ' . $row['middleName'] . ' ' . $row['lastName']; ?> </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 text-center">
                                                                <div class="form-group">
                                                                    <label>Age:</label>
                                                                    <p><?= $row['age']; ?> </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 text-center">
                                                                <div class="form-group">
                                                                    <label>Birth Date:</label>
                                                                    <p><?= $row['birthDate']; ?> </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 text-center">
                                                                <div class="form-group">
                                                                    <label>Contact Number:</label>
                                                                    <p><?= $row['contactNumber']; ?> </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 text-center">
                                                                <div class="form-group">
                                                                    <label>Email:</label>
                                                                    <p class="text-primary"><?= $row['email']; ?> </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 text-center">
                                                                <div class="form-group">
                                                                    <label>Address:</label>
                                                                    <p><?= $row['address']; ?> </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 text-center">
                                                                <div class="form-group">
                                                                    <label>Date Registered:</label>
                                                                    <p><?= $row['userCreated']; ?> </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-end">
                                                        <a href='#' class="btn btn-primary">Edit</a>
                                                    </div>
                                                </div>
                                            </form><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div>

                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section><!-- /.content -->

<script>
    $('#view').click(function() {
        view_user()
    })

    function view_user() {

        // $tr = $(this).closest('tr');
        // var data = $tr.children("td").map(function() {
        //     return $(this).text();
        // }).get();
        console.log({
            account: $('[name="account"]').val()
        })
    }
</script>