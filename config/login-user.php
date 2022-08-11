<?php
require_once 'data/Database.php';

if (isset($_POST['submit'])) {
  extract($_POST);
  $encrypt = md5($password);

  $admin = "SELECT * FROM tbl_users WHERE username = '" . $username . "' AND password = '" . $encrypt . "'";
  $adminquery = mysqli_query($conn, $admin);
  $checkadmin = mysqli_num_rows($adminquery);

  $borrower = "SELECT * FROM tbl_borrowers WHERE username = '" . $username . "' AND password = '" . $encrypt . "'";
  $borrowerquery = mysqli_query($conn, $borrower);
  $checkborrower = mysqli_num_rows($borrowerquery);

  if ($checkadmin > 0) {
    $data = $adminquery->fetch_array();
    session_start();
    $_SESSION['adminuser_id'] = $data['user_id'];
    $_SESSION['role_name'] = $data['role_name'];
		$_SESSION['status'] = "<div id=\"preloader\"><div class=\"loader\"></div></div>";
		header('location: ../pages/admin/index.php?page=dashboard');
  } else {

    if ($checkborrower > 0) {
      $data = $borrowerquery->fetch_array();
      session_start();
      $_SESSION['user_id'] = $data['user_id'];
      $_SESSION['membership'] = $data['membership'];		
			$_SESSION['status'] = "<div id=\"preloader\"><div class=\"loader\"></div></div>";
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
      header('location: ../login.php');
    }
    
  }
}
