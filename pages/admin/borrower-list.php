<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header('location: http://localhost/loan-management/application/pages/error-pages/403-error.php');
    exit();
};
?>
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
                                    <th>Account No.</th>
                                    <th>Borrower Name</th>
                                    <th>Address</th>
                                    <th>Birth Date</th>
                                    <th>Contact No.</th>
                                    <th>Email Address</th>
                                    <th>Date Registered</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM tbl_borrowers order by userCreated asc";
                                $results = $conn->query($query);
                                ?>
                                <?php while ($row = $results->fetch_row()) : $user_id = $row[0]; ?>
                                    <tr>
                                        <td class="text-center"><?php echo $row[0]; ?></td>
                                        <td><?php echo $row[1]; ?></td>
                                        <td><?php echo $row[2] . ' ' . $row[3] . ' ' . $row[4]; ?> </td>
                                        <td><?php echo $row[5]; ?></td>
                                        <td><?php echo $row[8]; ?></td>
                                        <td><?php echo $row[9]; ?></td>
                                        <td><?php echo $row[11]; ?></td>
                                        <td><?php echo $row[10]; ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-info btn-xs" data-toggle="modal" value=<?php echo $user_id; ?> data-target="#view_borrower"><i class="fa fa-eye"></i></button>
                                            <a href="borrower_update.php?page=borrower_list&account_number=<?php echo $row[1]; ?>" class="btn btn-primary btn-xs my-1"><i class="fa fa-edit"></i></a>
                                            <a onclick="deleteborrower()" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <script>
                                        function deleteborrower() {
                                            Swal.fire({
                                                title: 'Delete <?php echo $row[2]; ?> from database?',
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
                                                        window.location.href = "../../code.php?deleteborrower_id=<?php echo $row[0]; ?>"
                                                    )
                                                }
                                            })
                                        }
                                    </script>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section><!-- /.content -->

<div class="modal fade" id="view_borrower">
    <div class="modal-dialog modal-md">
        <?php
        $query = "SELECT * FROM tbl_borrowers WHERE user_id = $user_id";
        $results = $conn->query($query);
        ?>
        <?php while ($row = $results->fetch_row()) : ?>
            <form action="">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Information of <?php echo $row[2] . ' ' . $row[4]; ?> </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center mb-4">
                                <div class="image">
                                    <img src="../../components/img/uploads/<?php echo $row[7]; ?>" class="img-square elevation-3" alt="User Image" style="max-width: 200px; height: 200px;">
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <div class="form-group">
                                    <label>Account Number:</label>
                                    <p><?php echo $row[1]; ?> </p>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <div class="form-group">
                                    <label>Full Name:</label>
                                    <p><?php echo $row[2] . ' ' . $row[3] . ' ' . $row[4]; ?> </p>
                                </div>
                            </div>
                            <div class="col-md-6 text-center">
                                <div class="form-group">
                                    <label>Age:</label>
                                    <p><?php echo $row[6]; ?> </p>
                                </div>
                            </div>
                            <div class="col-md-6 text-center">
                                <div class="form-group">
                                    <label>Birth Date:</label>
                                    <p><?php echo $row[7]; ?> </p>
                                </div>
                            </div>
                            <div class="col-md-6 text-center">
                                <div class="form-group">
                                    <label>Contact Number:</label>
                                    <p><?php echo $row[9]; ?> </p>
                                </div>
                            </div>
                            <div class="col-md-6 text-center">
                                <div class="form-group">
                                    <label>Email:</label>
                                    <p class="text-primary"><?php echo $row[11]; ?> </p>
                                </div>
                            </div>
                            <div class="col-md-6 text-center">
                                <div class="form-group">
                                    <label>Address:</label>
                                    <p><?php echo $row[5]; ?> </p>
                                </div>
                            </div>
                            <div class="col-md-6 text-center">
                                <div class="form-group">
                                    <label>Date Registered:</label>
                                    <p><?php echo $row[10]; ?> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <a href='#' class="btn btn-primary">Edit</a>
                    </div>
                </div>
            </form><!-- /.modal-content -->
        <?php endwhile; ?>
    </div><!-- /.modal-dialog -->
</div>