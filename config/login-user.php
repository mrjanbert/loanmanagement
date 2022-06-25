<?php 
require_once 'data/Database.php';

if (isset($_POST['submit'])) {
	$email = $_POST['email']; 
	$password = $_POST['password'];
    $encrypt = base64_encode($password);

	$query = "SELECT * FROM tbl_users WHERE email = '" . $email . "' AND password = '" . $encrypt . "'";
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
		$_SESSION['birthDate'] = $data['birthDate'];
		$_SESSION['profilePhoto'] = $data['profilePhoto'];
		$_SESSION['contactNumber'] = $data['contactNumber'];
		$_SESSION['userCreated'] = $data['userCreated'];
		$_SESSION['user_role'] = $data['user_role'];
		$_SESSION['email'] = $email;

		header('location: ../pages/admin/index.php');
	} else {
		$_SESSION['status']="<script>const Toast = Swal.mixin({
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