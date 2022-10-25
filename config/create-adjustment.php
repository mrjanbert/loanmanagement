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

  $query = $conn->query("SELECT t.*, b.contactNumber, concat(b.firstName,' ',b.lastName) as payee FROM tbl_transaction t INNER JOIN tbl_borrowers b ON t.borrower_id = b.user_id WHERE t.ref_no = $ref_no");
  $databal = $query->fetch_array();
  $monthly = $databal['monthly'];
  $contactNumber = $databal['contactNumber'];
  $payee = $databal['payee'];

  //get cashier name
  $getcashier = $conn->query("SELECT concat(firstname,' ',lastName) as cashier_name FROM tbl_users WHERE user_id = " . $_SESSION['adminuser_id']);
  $fetchname = $getcashier->fetch_array();
  $cashier_name = $fetchname['cashier_name'];

  if ($sql->num_rows > 0) {
    $balance = $row['payment_balance'];
  } else {
    $balance = $databal['balance'];
  }

  if (($penalty == '' && $interest == '' && $operation == '') || ($operation == '' && $interest != '') || ($operation != '' && $interest == '')) {
    $_SESSION['status'] = "<script>
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Failed to add adjustments.'
      })
    </script>";
    header('location: ../pages/admin/index.php?page=view-payments&refid=' . $ref_no);
  } else {
    if ($penalty == '') {
      $penalty = 0;
    }
    if ($interest == '') {
      $interest = 0;
    }

    $penalty_percentage = $monthly * 0.015;
    $total_penalty = $penalty_percentage * $penalty;
    if ($operation == 'add') {
      $remainbalance = $balance + $total_penalty + $interest;
    } elseif ($operation == 'minus') {
      $remainbalance = $balance + $total_penalty - $interest;
    } else {
      $remainbalance = $balance + $total_penalty;
      $operation = null;
    }

    $data = " ref_no = '$ref_no' ";
    $data .= ", interest = '$interest' ";
    $data .= ", operation_of_interest = '$operation' ";
    $data .= ", penalty = '$total_penalty' ";
    $data .= ", payment_balance = '$remainbalance' ";
    $data .= ", payment_date = '$payment_date' ";

    // echo $data;
    $query = "INSERT INTO tbl_payments SET " . $data;
    $result = $conn->query($query);

    if ($conn->affected_rows > 0) :

      $url = "https://semysms.net/api/3/sms.php"; //Url address for sending SMS
      $phone = $contactNumber; // Phone number
      $msg = 'FROM NMSCST LMS:' . PHP_EOL . $cashier_name . '(Cashier) added an adjustment on your loan payment.' . PHP_EOL . 'Loan ref no.: ' . $ref_no . PHP_EOL . '(computer msg)'; //Message
      $device = '319799';  //  Device code
      $token = '16f034060c14278c0615d329f4d02643';  //  Your token (secret)

      $data = array(
        "phone" => $phone,
        "msg" => $msg,
        "device" => $device,
        "token" => $token
      );

      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
      $output = curl_exec($curl);
      curl_close($curl);

      if ($output) {
        $addmsg = $conn->query("INSERT INTO tbl_smslogs SET contactNumber = '$phone', name = '$payee', message = '$msg', date = now()");
      }

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
  }
endif;