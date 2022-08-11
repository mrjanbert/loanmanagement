<?php
require_once 'data/Database.php';
session_start();

if (isset($_GET['delete_borrower_id'])) {
  $user_id = $_GET['delete_borrower_id'];

  $result = mysqli_query($conn, "DELETE FROM tbl_borrowers WHERE user_id ='$user_id'");
  $_SESSION['status'] = "<script>
    Swal.fire({
      icon: 'success',
      title: 'Done',
      text: 'Borrower deleted successfully.'
    })
  </script>";
  header('location: ../pages/admin/index.php?page=borrower-list');
}