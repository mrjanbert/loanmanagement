<?php
require_once 'data/Database.php';

if (isset($_POST['submit'])) {
	extract($_POST);
	$encrypt = base64_encode($password);

	$query = "SELECT * FROM tbl_borrowers WHERE username = '" . $username . "' AND password = '" . $encrypt . "'";
	$result = mysqli_query($conn, $query);
	$count = mysqli_num_rows($result);

	if ($count > 0) {
		$data = $result->fetch_array();
		session_start();
		$_SESSION['user_id'] = $data['user_id'];
		$_SESSION['accountNumber'] = $data['accountNumber'];
		$_SESSION['firstName'] = $data['firstName'];
		$_SESSION['middleName'] = $data['middleName'];
		$_SESSION['lastName'] = $data['lastName'];
		$_SESSION['address'] = $data['address'];
		$_SESSION['age'] = $data['age'];
		$_SESSION['profilePhoto'] = $data['profilePhoto'];
		$_SESSION['birthDate'] = $data['birthDate'];
		$_SESSION['contactNumber'] = $data['contactNumber'];
		$_SESSION['userCreated'] = $data['userCreated'];
		$_SESSION['membership'] = $data['membership'];
		$_SESSION['email'] = $data['email'];
		$_SESSION['username'] = $data['username'];
		$_SESSION['status'] = "<div class=\"preloader flex-column justify-content-center align-items-center\">
        <img class=\"animation__wobble\" src=\"../../components/img/lms_logo.png\" height=\"200\" width=\"200\"></div>";
		header('location: ../pages/client/index.php?page=dashboard');
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
			title: 'Invalid username or password!'
		})</script>";
		header('location: ../pages/client/login.php');
	}
}
