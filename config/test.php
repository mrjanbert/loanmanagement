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

  $checkbalance = $conn->query("SELECT payment_balance FROM tbl_payments WHERE ref_no = $ref_no ORDER BY id DESC ");
  $bal = $checkbalance->fetch_array();

  $checkORnumber = $conn->query("SELECT receipt_no FROM tbl_payments WHERE receipt_no = '$receipt_no'");

  $checkmonth = $conn->query("SELECT month_date FROM tbl_monthlynotif WHERE loan_ref = '$ref_no'");

  // if(date())

  if ($checkbalance->num_rows > 0) {
    $balance = $bal['payment_balance'];
  } else {
    $balance = $databal['balance'];
  }

  // $checkmonth = $conn->query("SELECT payment_date FROM tbl_payments WHERE ref_no = '$ref_no'");  

  $remainbalance = $balance - $payment_amount;

  if ($checkORnumber->num_rows > 0) {
    header('location: ../pages/admin/index.php?page=view-payments&refid=' . $ref_no);
  } else {
    $data = " ref_no = '$ref_no' ";
    $data .= ", receipt_no = '$receipt_no' ";
    $data .= ", payee = '$payee' ";
    $data .= ", payment_amount = '$payment_amount' ";
    $data .= ", payment_balance = '$remainbalance' ";
    $data .= ", payment_date = '$payment_date'";

    $query = "INSERT INTO tbl_payments SET " . $data;
    $result = $conn->query($query);

    if ($conn->affected_rows > 0) :
      header('location: ../pages/admin/index.php?page=view-payments&refid=' . $ref_no);
    else :
      header('location: ../pages/admin/index.php?page=view-payments&refid=' . $ref_no);
    endif;
  }
}
