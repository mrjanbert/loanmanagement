<?php
require_once 'data/Database.php';

if (isset($_POST['submit'])) {
    extract($_POST);

    $checkbal = $conn->query("SELECT t.*, concat(b.firstName,' ',b.lastName) as payee FROM tbl_transaction t INNER JOIN tbl_borrowers b WHERE ref_no = $ref_no");
    $databal = $checkbal->fetch_array();
    $payee = $databal['payee'];

    // $remainbalance = $balance - $payment_amount;

    // echo "$ref_no, $receipt_no, $payment_amount, $payee, $remainbalance";

    $sql = $conn->query("SELECT * FROM tbl_payments WHERE ref_no = $ref_no ORDER BY id DESC ");
    $row = $sql->fetch_array();

    if ($sql->num_rows > 0) {
        $balance = $row['payment_balance'];
    } else {
        $balance = $databal['balance'];
    }

    $remainbalance = $balance - $payment_amount;
    
    $payment_date = date('Y-m-d H:i:s');

    $data = " ref_no = '$ref_no' ";
    $data .= ", receipt_no = '$receipt_no' ";
    $data .= ", payee = '$payee' ";
    $data .= ", payment_amount = '$payment_amount' ";
    $data .= ", payment_balance = '$remainbalance' ";
    $data .= ", payment_date = '$payment_date' ";

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
        header('location: ../pages/admin/index.php?page=view-payments&refid=' . $ref_no . '&usr=' . ($_SESSION['role_name']));
    else :
        session_start();
        $_SESSION['status'] = "<script>
      Swal.fire({
        icon: 'error',
        title: 'Failed',
        text: 'Payment not added.'
      })
      </script>";
        header('location: ../pages/admin/index.php?page=view-payments&refid=' . $ref_no . '&usr=' . ($_SESSION['role_name']));
    endif;
}

if(isset($_POST['addpenalty'])) {
  extract($_POST);

  $sql = $conn->query("SELECT * FROM tbl_payments WHERE ref_no = $ref_no ORDER BY id DESC ");
  $row = $sql->fetch_array();

  if ($sql->num_rows > 0) {
    $balance = $row['payment_balance'];
  } else {
    $balance = $databal['balance'];
  }

  $sql = $conn->query("SELECT * FROM tbl_payments WHERE ref_no = $ref_no ORDER BY id DESC ");
  $row = $sql->fetch_array();

  if ($sql->num_rows > 0) {
    $balance = $row['payment_balance'];
  } else {
    $balance = $databal['balance'];
  }

  $remainbalance = $balance + $penalty;

  $data = " ref_no = '$ref_no' ";
  $data .= ", penalty = '$penalty' ";
  $data .= ", payment_balance = '$remainbalance' ";
  $data .= ", payment_date = '$payment_date' ";

  // echo $data;
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
    header('location: ../pages/admin/index.php?page=view-payments&refid=' . $ref_no . '&usr=' . ($_SESSION['role_name']));
  else :
    session_start();
    $_SESSION['status'] = "<script>
      Swal.fire({
        icon: 'error',
        title: 'Failed',
        text: 'Payment not added.'
      })
      </script>";
    header('location: ../pages/admin/index.php?page=view-payments&refid=' . $ref_no . '&usr=' . ($_SESSION['role_name']));
  endif;
}