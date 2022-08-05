<?php
session_start();
// session_destroy();


if(isset($_GET['logout_id']) && ($_GET['logout_id'] == 'client')) {
  unset($_SESSION['user_id']);
  session_start();
  $_SESSION['status'] = "<script>const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000
  })

  Toast.fire({
    icon: 'success',
    title: 'Logged out successfully'
  })</script>";
  header('location: ../login.php');

}

if (isset($_GET['logout_id']) && ($_GET['logout_id'] == 'admin')) {
  unset($_SESSION['adminuser_id']);
  session_start();
  $_SESSION['status'] = "<script>const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000
  })

  Toast.fire({
    icon: 'success',
    title: 'Logged out successfully'
  })</script>";
  header('location: ../login.php');
}