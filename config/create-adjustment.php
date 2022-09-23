<?php
require_once 'data/Database.php';
session_start();

if (isset($_POST['addpenalty'])) {
  extract($_POST);

  $sql = $conn->query("SELECT * FROM tbl_payments WHERE ref_no = $ref_no ORDER BY id DESC ");
  $row = $sql->fetch_array();

  $query = $conn->query("SELECT * FROM tbl_transaction WHERE ref_no = $ref_no");
  $databal = $query->fetch_array();

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
    $_SESSION['status'] = "<script>
      Swal.fire({
        icon: 'success',
        title: 'Done',
        text: 'Penalty added'
      })
    </script>";
    header('location: ../pages/admin/index.php?page=view-payments&refid=' . $ref_no);
  else :
    $_SESSION['status'] = "<script>
      Swal.fire({
        icon: 'error',
        title: 'Failed',
        text: 'Penalty not added.'
      })
    </script>";
    header('location: ../pages/admin/index.php?page=view-payments&refid=' . $ref_no);
  endif;
}


if(isset($_POST['addadjustment'])) :
  extract($_POST);

  //* SEARCH CURRENT BALANCE AND/OR FULL BALANCE
  $sql = $conn->query("SELECT * FROM tbl_payments WHERE ref_no = $ref_no ORDER BY id DESC ");
  $row = $sql->fetch_array();

  $query = $conn->query("SELECT * FROM tbl_transaction WHERE ref_no = $ref_no");
  $databal = $query->fetch_array();

  if ($sql->num_rows > 0) {
    $balance = $row['payment_balance'];
  } else {
    $balance = $databal['balance'];
  }

  if ($penalty == '') {
    $penalty = 0;
  }
  if ($interest == '') {
    $interest = 0;
  }

  if ($operation == 'add') {
    $remainbalance = $balance + $penalty + $interest;
  } elseif ($operation == 'minus') {
    $remainbalance = $balance + $penalty - $interest;
  } else {
    $remainbalance = $balance + $penalty;
    // $operation = null;
  }

  $data = " ref_no = '$ref_no' ";
  $data .= ", interest = '$interest' ";
  // $data .= ", operation_of_interest = '$operation' ";
  $data .= ", penalty = '$penalty' ";
  $data .= ", payment_balance = '$remainbalance' ";
  $data .= ", payment_date = '$payment_date' ";

  // echo $data;
  $query = "INSERT INTO tbl_payments SET " . $data;
  $result = $conn->query($query);

  if ($conn->affected_rows > 0) :
    $_SESSION['status'] = "<script>
      Swal.fire({
        icon: 'success',
        title: 'Done',
        text: 'Adjustments added successfully.'
      })
    </script>";
    header('location: ../pages/admin/index.php?page=view-payments&refid=' . $ref_no);
  else :
    // $last_id = $conn->insert_id; //id from the last query
    // $delete = $conn->query("DELETE FROM tbl_payments WHERE id = '$last_id'");

    $_SESSION['status'] = "<script>
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Failed to add adjustments.'
      })
    </script>";
    header('location: ../pages/admin/index.php?page=view-payments&refid=' . $ref_no);
  endif;
endif;