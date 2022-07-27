<?php

// $bdate = date_create("1999-10-11");
// $now = date_create(date('Y-m-d'));

// $diff = date_diff($bdate, $now);
// $age = $diff->format("%y");


// echo "$age";

require_once 'data/Database.php';

if (isset($_POST['submit'])) {
  extract($_POST);

  $checkbal = $conn->query("SELECT t.*, concat(b.firstName,' ',b.lastName) as payee FROM tbl_transaction t INNER JOIN tbl_borrowers b WHERE ref_no = $ref_no");
  $databal = $checkbal->fetch_array();
  $payee = $databal['payee'];
  $loan_date = $databal['loan_date'];
  $monthly = $databal['monthly'];

  echo "$ref_no, $receipt_no, $payment_amount, $payee, $remainbalance";

  $sql = $conn->query("SELECT * FROM tbl_payments WHERE ref_no = $ref_no ORDER BY id DESC ");
  $row = $sql->fetch_array();

  if ($sql->num_rows > 0) {
    $balance = $row['payment_balance'];
  } else {
    $balance = $databal['balance'];
  }

  $remainbalance = $balance - $payment_amount;

  $loandate_query = $conn->query("SELECT date_add(loan_date, INTERVAL 1 month) AS loan_date FROM tbl_transaction WHERE ref_no = $ref_no");
  $data_date = $loandate_query->fetch_assoc();
  $penaltyloan_date = $data_date['loan_date'];

  // echo date('M j, Y', strtotime($loan_date));

  if (strtotime($loan_date) <= strtotime($penaltyloan_date)) {
    $penalty_rate = 1.5; //* fixed penalty rate for payment amount
    $penalty = ($penalty_rate / 100);
  }

  $total_penalty = $monthly + $penalty;


  $data = " ref_no = '$ref_no' ";
  $data .= ", receipt_no = '$receipt_no' ";
  $data .= ", payee = '$payee' ";
  $data .= ", payment_amount = '$payment_amount' ";
  $data .= ", payment_balance = '$remainbalance' ";

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
    header('location: ../pages/admin/index.php?page=view-payments&refid=' . $ref_no . '&usr=' . base64_encode($_SESSION['role_name']));
  else :
    session_start();
    $_SESSION['status'] = "<script>
      Swal.fire({
        icon: 'error',
        title: 'Failed',
        text: 'Payment not added.'
      })
      </script>";
    header('location: ../pages/admin/index.php?page=view-payments&refid=' . $ref_no . '&usr=' . base64_encode($_SESSION['role_name']));
  endif;
}
