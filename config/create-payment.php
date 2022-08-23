<?php
require_once 'data/Database.php';

if (isset($_POST['submit'])) {
  extract($_POST);

  $checkbal = $conn->query("SELECT t.*, concat(b.firstName,' ',b.lastName) as payee, b.user_id FROM tbl_transaction t INNER JOIN tbl_borrowers b ON t.borrower_id = b.user_id WHERE t.ref_no = $ref_no");
  $databal = $checkbal->fetch_array();
  $payee = $databal['payee'];
  // $loan_term = $databal['loan_term'];
  $user_id = $databal['user_id'];
  $loan_date = $databal['loan_date'];
  $months = $databal['loan_term'];

  $sql = $conn->query("SELECT * FROM tbl_payments WHERE ref_no = $ref_no ORDER BY id DESC ");
  $row = $sql->fetch_array();
  
  $payment_date = date('Y-m-d');
  // $monthly_date = strtotime(date('Y-m-d'));
  // $monthly_temp = $databal['loan_date'];

  $end_date = date('Y-m-d', strtotime(' + '. $months.' months'));

  // $monthly_date = date('Y-m-d');

  // $paid = date_create($monthly_date);
  // $end = date_create($end_date);

  // $diff = date_diff($paid, $end);
  // $formatdiff = $diff->format("%a");

  if ($sql->num_rows > 0) {
    $balance = $row['payment_balance'];
  } else {
    $balance = $databal['balance'];
      $insert = $conn->query("INSERT INTO tbl_monthlyreminder SET loan_ref = '$ref_no', start_date = curdate(), end_date = '$end_date'");

  } 

  $remainbalance = $balance - $payment_amount;

  $data = " ref_no = '$ref_no' ";
  $data .= ", receipt_no = '$receipt_no' ";
  $data .= ", payee = '$payee' ";
  $data .= ", payment_amount = '$payment_amount' ";
  $data .= ", payment_balance = '$remainbalance' ";
  $data .= ", payment_date = '$payment_date'";

  $query = "INSERT INTO tbl_payments SET " . $data;
  $result = $conn->query($query);

  if ($conn->affected_rows > 0) :
    $sql = $conn->query("UPDATE tbl_status SET status_cashier = '2' WHERE ref_no = '$ref_no'");
    session_start();
    $_SESSION['status'] = "<script>
    Swal.fire({
      icon: 'success',
      title: 'Done',
      text: 'Payment added'
    })
    </script>";
    header('location: ../pages/admin/index.php?page=view-payments&refid=' . $ref_no);
  else :
    session_start();
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
