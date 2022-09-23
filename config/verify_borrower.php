<?php 
session_start();  
require 'data/Database.php';

if((!isset($_SESSION['user_id']) || (!isset($_SESSION['membership'])))){
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
  $check = $_SESSION['user_id'];
  $membershhip = $_SESSION['membership'];
  $users = "SELECT * FROM tbl_borrowers WHERE user_id = '$check' AND membership LIKE BINARY '$membershhip'";
  $result = $conn->query($users);
  if(mysqli_num_rows($result) < 1) {
    unset($_SESSION['user_id']);
    unset($_SESSION['membership']);
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