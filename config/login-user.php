<?php
require_once 'data/Database.php';

if (isset($_POST['submit'])) {
	extract($_POST);
	$encrypt = base64_encode($password);

	$query = "SELECT * FROM tbl_users WHERE accountNumber = '" . $accountNumber . "' AND password = '" . $encrypt . "'";
	$result = mysqli_query($conn, $query);
	$count = mysqli_num_rows($result);

	if ($count > 0) {
		$data = $result->fetch_array();
		session_start();
		$_SESSION['adminuser_id'] = $data['user_id'];
		$_SESSION['accountNumber'] = $data['accountNumber'];
		$_SESSION['firstName'] = $data['firstName'];
		$_SESSION['middleName'] = $data['middleName'];
		$_SESSION['lastName'] = $data['lastName'];
		$_SESSION['address'] = $data['address'];
		$_SESSION['age'] = $data['age'];
		$_SESSION['birthDate'] = $data['birthDate'];
		$_SESSION['profilePhoto'] = $data['profilePhoto'];
		$_SESSION['contactNumber'] = $data['contactNumber'];
		$_SESSION['userCreated'] = $data['userCreated'];
		$_SESSION['role_name'] = $data['role_name'];
		$_SESSION['email'] = $data['email'];
		$_SESSION['status'] = "<div class=\"preloader flex-column justify-content-center align-items-center\">
        <img class=\"animation__wobble\" src=\"../../components/img/logo.png\" height=\"200\" width=\"200\"></div>";
		header('location: ../pages/admin/index.php?page=dashboard&usr=' . base64_encode($_SESSION['role_name']));
	} else {
		session_start();
		$_SESSION['status'] = "<script>const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
          })
      
          Toast.fire({
            icon: 'error',
            title: 'Invalid username or password! Please try again.'
          })</script>";
		header('location: ../login.php');
	}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found - NMSC Loan Management</title>
    <link rel="icon" type="image/x-icon" href="https://www.nmsc.edu.ph/application/themes/nmsc/favicon.ico">

    <?php include_once('../components/inc/header.php'); ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed" id="switch-mode">
    <div class="wrapper">
        <!-- Main content -->
        <section class="content " style="margin-top: 100px;">
            <div class="error-page">
                <h2 class="headline text-danger"> 403</h2>

                <div class="error-content">
                    <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Page forbidden.</h3>
                    <p>
                        You don't have permission to access this resource.
                    </p>

                </div>
                <!-- /.error-content -->
            </div>
            <!-- /.error-page -->
        </section>
        <!-- /.content -->
    </div>
    </div><!-- /.wrapper -->

    <?php include_once('../components/inc/footer.php'); ?>
</body>

</html>
