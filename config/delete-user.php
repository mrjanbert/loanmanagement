<?php
require_once 'data/Database.php';
session_start();

if(isset($_GET['delete_user_id'])) {
  $user_id = $_GET['delete_user_id'];

  $query = $conn->query("DELETE FROM tbl_users WHERE user_id = '$user_id");
  $_SESSION['status'] = "<script>
    Swal.fire({
      icon: 'success',
      title: 'Done',
      text: 'User deleted successfully.'
    })
  </script>";
  header('location: ../pages/admin/index.php?page=user-list');

}