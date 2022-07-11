<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Update Information</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Update Information</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<?php
$user_id = $_GET['user_id'];
$query = "SELECT * FROM tbl_users WHERE user_id = " . base64_decode($user_id);
$results = $conn->query($query);
while ($row = $results->fetch_assoc()) :
?>
<!-- Main content -->
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="../../code.php" method="POST">
                    <div class="card mb-5">
                        <div class="card-header">
                            Update Information of <?php echo $row['firstName'] . ' ' . $row['lastName']; ?>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="user_id  " value="<?php echo $row[0]; ?>">
                            <div class="form-group">
                                <label class="control-label">Account Number</label>
                                <div class="input-group">
                                    <input type="number" name="accountNumber" class="form-control" value="<?php echo $row['accountNumber']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">First Name</label>
                                <div class="input-group">
                                    <input type="text" name="firstName" class="form-control" value="<?php echo $row['firstName']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Middle Name</label>
                                <div class="input-group">
                                    <input type="text" name="middleName" class="form-control" value="<?php echo $row['middleName']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Last Name</label>
                                <div class="input-group">
                                    <input type="text" name="lastName" class="form-control" value="<?php echo $row['lastName']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Address</label>
                                <div class="input-group">
                                    <input type="text" name="address" class="form-control" value="<?php echo $row['address']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Age</label>
                                <div class="input-group">
                                    <input type="text" name="age" class="form-control" value="<?php echo $row['age']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Birth Date</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" name="birthDate" value="<?php echo $row['birthDate']; ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Contact Number</label>
                                <div class="input-group">
                                    <input type="text" name="contactNumber" class="form-control" value="<?php echo $row['contactNumber']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Email Address</label>
                                <div class="input-group">
                                    <input type="text" name="email" class="form-control" value="<?php echo $row['email']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Profile Photo</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="profilePhoto" value="<?php echo $row['profilePhoto']; ?>">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-primary offset-md-3" type="submit" value="submit" name="editUser_btn" onclick="return confirm('Confirm save?');"> Save</button>
                                    <button class="btn btn-secondary" id="cancel" type="button" onclick="history.back()"> Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section><!-- /.content -->
<?php endwhile; ?>