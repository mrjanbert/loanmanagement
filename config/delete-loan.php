<?php
require_once 'data/Database.php';
session_start();

if (isset($_GET['delete_loan_id'])) {
  $ref_no = $_GET['delete_loan_id'];

  $deleteloan = mysqli_query($conn, "DELETE FROM tbl_transaction WHERE ref_no ='$ref_no'");
  $deletestatus = mysqli_query($conn, "DELETE FROM tbl_status WHERE ref_no ='$ref_no'");
  $deletenotification = mysqli_query($conn, "DELETE FROM tbl_monthlynotif WHERE loan_ref ='$ref_no'");
  $deletepayment = mysqli_query($conn, "DELETE FROM tbl_payments WHERE ref_no ='$ref_no'");

  $_SESSION['status'] = "<script>
    Swal.fire({
      icon: 'success',
      title: 'Done',
      text: 'Loan deleted successfully.'
    })
  </script>";
  header('location: ../pages/admin/index.php?page=view-loans&uid='.$_GET['uid']);
}
