<?php
require_once 'data/Database.php';

if (isset($_POST['submit'])) {
	extract($_POST);
	$encrypt = md5($password);

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
        <img class=\"animation__wobble\" src=\"../../components/img/lms_logo.png\" height=\"200\" width=\"200\"></div>";
		header('location: ../pages/admin/index.php?page=dashboard&usr=' . ($_SESSION['role_name']));
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