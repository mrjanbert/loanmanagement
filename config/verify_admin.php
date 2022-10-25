<?php
session_start();
require 'data/Database.php';

if ((!isset($_SESSION['adminuser_id']) || (!isset($_SESSION['role_name'])))) {
  $_SESSION['status'] = "<script>const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000
  })
  Toast.fire({
    icon: 'warning',
    title: 'You must login to continue'
  })</script>";
  header('location: ../../login.php');
} else {
  $check = $_SESSION['adminuser_id'];
  $role_name = $_SESSION['role_name'];
  $users = "SELECT * FROM tbl_users WHERE user_id = '$check' AND role_name LIKE BINARY '$role_name'";
  $result = $conn->query($users);
  if (mysqli_num_rows($result) < 1) {
    unset($_SESSION['adminuser_id']);
    unset($_SESSION['role_name']);
    $_SESSION['status'] = "<script>const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 5000
    })
    Toast.fire({
      icon: 'warning',
      title: 'You must login to continue'
    })</script>";
    header('location: ../../login.php');
  }
}
