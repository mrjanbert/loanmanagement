<?php
session_start();
require_once 'data/Database.php';

if (isset($_POST['submit'])) {
  extract($_POST);

  $checkbal = $conn->query("SELECT t.*, b.contactNumber, concat(b.firstName,' ',b.lastName) as payee, b.user_id FROM tbl_transaction t INNER JOIN tbl_borrowers b ON t.borrower_id = b.user_id WHERE t.ref_no = $ref_no");
  $databal = $checkbal->fetch_array();
  $payee = $databal['payee'];
  $contactNumber = $databal['contactNumber'];
  $months = $databal['loan_term'];
  $monthly = $databal['monthly'];

  $checkbalance = $conn->query("SELECT payment_balance FROM tbl_payments WHERE ref_no = $ref_no ORDER BY id DESC ");
  $bal = $checkbalance->fetch_array();

  $checkORnumber = $conn->query("SELECT receipt_no FROM tbl_payments WHERE receipt_no = '$receipt_no'");

  if ($checkbalance->num_rows > 0) {
    $balance = $bal['payment_balance'];
  } else {
    $balance = $databal['balance'];
  }

  $total_penalty = 0;
  $payment_date = date('Y-m-d');
  $remainbalance = $balance - $payment_amount;

  if ($checkORnumber->num_rows > 0) {
    $_SESSION['status'] = "<script>
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'OR Number already exist.'
    })
    </script>";
    header('location: ../pages/admin/index.php?page=view-payments&refid=' . $ref_no);
  } else {
    $data = " ref_no = '$ref_no' ";
    $data .= ", receipt_no = '$receipt_no' ";
    $data .= ", payee = '$payee' ";
    $data .= ", penalty = '$total_penalty' ";
    // $data .= ", month_name = '$month_name' ";
    $data .= ", payment_amount = '$payment_amount' ";
    $data .= ", payment_balance = '$remainbalance' ";
    $data .= ", payment_date = '$payment_date'";

    $query = "INSERT INTO tbl_payments SET " . $data;
    $result = $conn->query($query);

    if ($conn->affected_rows > 0) :

      $_SESSION['status'] = "<script>
      Swal.fire({
        icon: 'success',
        title: 'Done',
        text: 'Payment added'
      })
      </script>";
      header('location: ../pages/admin/index.php?page=view-payments&refid=' . $ref_no);
    else :
      $_SESSION['status'] = "<script>
      Swal.fire({
        icon: 'error',
        title: 'Failed',
        text: 'Payment not added.'
      })
      </script>";
      header('location: ../pages/admin/index.php?page=view-payments&refid=' . $ref_no);
    endif;
  }
}
