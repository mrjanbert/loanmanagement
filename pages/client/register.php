<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register :: NMSCST Loan Management System</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">


    <div class="register-box">
        <div class="card card-outline card-primary my-5">
            <div class="card-header d-flex justify-content-center">
                <h3><b>Register</b></h3>
            </div>
            <div class="card-body">
                <form action="../../config/create-userclient.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" name="user_id" required>
                    <div class="col-12">
                        <label>Profile Picture</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputFile" name="profilePhoto" required>
                                <label class="custom-file-label" for="inputFile">Choose photo</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label>First Name</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="firstName" placeholder="Enter First Name" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label>Middle Name</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="middleName" placeholder="Enter Middle Name" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label>Last Name</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="lastName" placeholder="Enter Last Name" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label>Address</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="address" placeholder="Enter Address" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <label>Age</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" name="age" placeholder="Enter Age" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label>Birth Date</label>
                        <div class="input-group mb-3">
                            <input type="date" class="form-control" name="birth_date" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label>Contact Number</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+63</span>
                            </div>
                            <input type="text" class="form-control" name="contact_number" maxlength="10" placeholder="Ex. 9123456789" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label>Email</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="email_address" placeholder="Ex. some.email@nmsc.edu.ph" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label>Password</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="password" placeholder="Enter New Password" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary float-right">Register</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-center">
                    <p>Already have an account? <a href="login.php">Login here</a></p>
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery -->
    <script src="../../assets/plugins/jquery/jquery.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../assets/dist/js/adminlte.js"></script>
</body>

</html>