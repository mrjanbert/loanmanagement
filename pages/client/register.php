<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Register :: NMSCST Loan Management System</title>
    <link rel="icon" type="image/x-icon" href="https://www.nmsc.edu.ph/application/themes/nmsc/favicon.ico">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    
    <!-- Theme style -->
    <link rel="stylesheet" href="../../assets/dist/css/adminlte.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../../assets/plugins/sweetalert2/sweetalert2.min.css">
    <script src="../../assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    
    <!-- MDB -->
    <link rel="stylesheet" href="../../components/hometemplate/css/mdb.min.css" />
    <!-- Custom styles -->
    <link rel="stylesheet" href="../../components/hometemplate/css/style2.css" />
</head>

<body>
    <!--Main layout-->
    <main>
        <div class="container">
            <!--Section: Content-->
            <section class="vh-100">
                <div class="container h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-lg-12 col-xl-11">
                            <div class="card text-black">
                                <div class="card-body p-md-5">
                                    <div class="row justify-content-center">
                                        <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                            <p class="text-center h1 fw-bold mb-3 mx-1 mx-md-4 mt-4">Sign up</p>
                                            <p class="text-center h5 mb-5">Create your account</p>

                                            <form class="mx-1 mx-md-4" action="../../config/create-userclient.php" method="POST" enctype="multipart/form-data">

                                                <div class="d-flex flex-row align-items-center mb-4">
                                                    <i class="fas fa-id-badge fa-lg me-3 fa-fw"></i>
                                                    <div class="form-outline flex-fill mb-0">
                                                        <input type="text" name="accountNumber" class="form-control" />
                                                        <label class="form-label">ID Number</label>
                                                    </div>
                                                </div>

                                                <div class="d-flex flex-row align-items-center mb-2">
                                                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                                    <div class="form-outline flex-fill mb-0">
                                                        <input type="text" name="firstName" class="form-control" />
                                                        <label class="form-label">First Name</label>
                                                    </div>
                                                </div>

                                                <div class="d-flex flex-row align-items-center mb-2">
                                                    <i class="fas fa-lg me-3 fa-fw"></i>
                                                    <div class="form-outline flex-fill mb-0">
                                                        <input type="text" name="middleName" class="form-control" />
                                                        <label class="form-label">Middle Name</label>
                                                    </div>
                                                </div>

                                                <div class="d-flex flex-row align-items-center mb-4">
                                                    <i class="fas fa-lg me-3 fa-fw"></i>
                                                    <div class="form-outline flex-fill mb-0">
                                                        <input type="text" name="lastName" class="form-control" />
                                                        <label class="form-label">Last Name</label>
                                                    </div>
                                                </div>

                                                <div class="d-flex flex-row align-items-center mb-4">
                                                    <i class="fas fa-address-book fa-lg me-3 fa-fw"></i>
                                                    <div class="form-outline flex-fill mb-0">
                                                        <input type="text" name="address" class="form-control" />
                                                        <label class="form-label">Address</label>
                                                    </div>
                                                </div>

                                                <div class="d-flex flex-row align-items-center mb-1">
                                                    <i class="fas fa-birthday-cake fa-lg me-3 fa-fw"></i>
                                                    <div class="form-outline flex-fill mb-0">
                                                        <input type="number" name="age" class="form-control" />
                                                        <label class="form-label">Age</label>
                                                    </div>
                                                </div>

                                                <div class="d-flex flex-row align-items-center mb-4">
                                                    <i class="fas fa-lg me-3 fa-fw"></i>
                                                    <div class="form-outline flex-fill mb-0">
                                                        <input type="date" name="birthDate" class="form-control" />
                                                    </div>
                                                </div>

                                                <div class="d-flex flex-row align-items-center mb-4">
                                                    <i class="fas fa-mobile-alt fa-lg me-3 fa-fw"></i>
                                                    <div class="form-outline flex-fill mb-0">
                                                        <input type="number" name="contactNumber" maxlength="10" placeholder="Ex. 9123456789" class="form-control" />
                                                        <label class="form-label">Mobile Number</label>
                                                    </div>
                                                </div>

                                                <div class="d-flex flex-row align-items-center mb-0">
                                                    <i class="fas fa-image fa-lg me-3 fa-fw"></i>
                                                    <div class="form-outline flex-fill mb-0">
                                                        <input type="file" name="profilePhoto" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-row align-items-center mb-4">
                                                    <i class="fas fa-lg me-3 fa-fw"></i>
                                                    <div class="small text-muted mt-2">Upload your Profile Picture</div>
                                                </div>

                                                <div class="d-flex flex-row align-items-center mb-4">
                                                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                                    <div class="form-outline flex-fill mb-0">
                                                        <input type="email" name="email" class="form-control" />
                                                        <label class="form-label">Email</labe l>
                                                    </div>
                                                </div>

                                                <div class="d-flex flex-row align-items-center mb-4">
                                                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                                    <div class="form-outline flex-fill mb-0">
                                                        <input type="password" name="password" class="form-control" />
                                                        <label class="form-label">Password</label>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                                    <button type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#register">Register</button>
                                                </div>
                                            </form>
                                        </div>  

                                        <!-- Modal -->
                                        <div class="modal fade" id="register" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Terms and Conditions</h5>
                                                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        
                                                        <div class="form-check d-flex justify-content-center mb-5">
                                                            <input class="form-check-input me-2" type="checkbox" value=""
                                                                id="form2Example3c" />
                                                            <label class="form-check-label" for="form2Example3">
                                                                I agree all statements in <a href="#!">Terms of service</a>
                                                            </label>    
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                                                        <a type="submit" value="submit" name="submit" class="btn btn-primary">Save changes</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                            <img src="../../components/hometemplate/img/signup.webp" class="img-fluid" alt="Sample image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--Section: Content-->
        </div>
    </main>

  <!-- unset toast notification to avoid popup every load -->
  <?php unset($_SESSION["status"]); ?>

  <!-- jQuery -->
  <script src="../../assets/plugins/jquery/jquery.min.js"></script>
  <!-- MDB -->
  <script type="text/javascript" src="../../components/hometemplate/js/mdb.min.js"></script>
  <!-- Custom scripts -->
  <!-- <script type="text/javascript" src="js/script.js"></script> -->
</body>

</html>