<?php
require_once 'data/Database.php';

if (isset($_POST['submit'])) {
  extract($_POST);
  // $encrypt = md5($password);

  $admin = "SELECT * FROM tbl_users WHERE username = '" . $username ."'";
  $adminquery = mysqli_query($conn, $admin);
  $checkadmin = mysqli_num_rows($adminquery);

  $borrower = "SELECT * FROM tbl_borrowers WHERE username = '" . $username ."'";
  $borrowerquery = mysqli_query($conn, $borrower);
  $checkborrower = mysqli_num_rows($borrowerquery);

  if ($checkborrower > 0) {
    $data = $borrowerquery->fetch_assoc();
    if(password_verify($password, $data['password'])) {
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
        title: 'Wrong password! Please try again.'
      })</script>";
      header('location: ../login.php');
    }
  } else {
    if ($checkadmin > 0) {
      $data1 = $adminquery->fetch_assoc();
      if (password_verify($password, $data1['password'])) {
        session_start();
        $_SESSION['adminuser_id'] = $data1['user_id'];
        $_SESSION['role_name'] = $data1['role_name'];
        $_SESSION['status'] = "<div id=\"preloader\"><div class=\"loader\"></div></div>";
        header('location: ../pages/admin/index.php?page=dashboard');
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
          title: 'Wrong password! Please try again.'
        })</script>";
        header('location: ../login.php');
      }
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
        title: 'Username not found. Please try again.'
      })</script>";
      header('location: ../login.php');
    }
  } 
}
