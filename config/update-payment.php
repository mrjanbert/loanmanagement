<?php
require_once 'data/Database.php';
session_start();

if (isset($_POST['submit'])) {
  extract($_POST);

  //* SEARCH CURRENT BALANCE AND/OR FULL BALANCE
  $sql = $conn->query("SELECT * FROM tbl_payments WHERE ref_no = $ref_no ORDER BY id DESC ");
  $row = $sql->fetch_array();
  $payee = $row['payee'];

  $query = $conn->query("SELECT * FROM tbl_transaction WHERE ref_no = $ref_no");
  $databal = $query->fetch_array();

  $getborrowerphone = $conn->query("SELECT b.contactNumber FROM tbl_borrowers b INNER JOIN tbl_transaction t ON t.borrower_id = b.user_id WHERE t.ref_no = '$ref_no'");
  $fetchphone = $getborrowerphone->fetch_array();
  $contactNumber = $fetchphone['contactNumber'];

  $checkORnumber = $conn->query("SELECT receipt_no FROM tbl_payments WHERE receipt_no = '$receipt_no' AND id != '$id'");

  //get cashier name
  $getcashier = $conn->query("SELECT concat(firstname,' ',lastName) as cashier_name FROM tbl_users WHERE user_id = " . $_SESSION['adminuser_id']);
  $fetchname = $getcashier->fetch_array();
  $cashier_name = $fetchname['cashier_name'];

  if ($sql->num_rows > 0) {
    $balance = $row['payment_balance'];
  } else {
    $balance = $databal['balance'];
  }
  
  if ($checkORnumber->num_rows > 0) {
      echo "OR number already exist";
  } else {
    if($interest == '') {
      $interest = 0;
    }

    if($penalty == '') {
      $penalty = 0;
    }

    if ($operation == 'add') {
      $remainbalance = $balance + $penalty + $interest;
    } elseif ($operation == 'minus') {
      $remainbalance = $balance + $penalty - $interest;
    } elseif($operation == 'none') {
      $interest = 0;
      $remainbalance = $balance + $penalty;
    } elseif($operation == '') {
      $interest = 0;
      $remainbalance = $balance + $penalty;
      $operation = 'none';
    }
  
    $data = " interest = '$interest'";
    $data .= ", penalty = '$penalty'";
    $data .= ", operation_of_interest = '$operation' ";
    $data .= ", payment_amount = '$payment_amount'";
    $data .= ", receipt_no = '$receipt_no'";
    $data .= ", payment_balance = '$remainbalance'";
    $data .= ", payment_date = '$payment_date'";

    // echo $data;
    $query = "UPDATE tbl_payments SET " . $data . " WHERE id = '$id'";
    $result = $conn->query($query);

    if ($conn->affected_rows > 0) :
      $url = "https://semysms.net/api/3/sms.php"; //Url address for sending SMS
      $phone = $contactNumber; // Phone number
      $msg = 'FROM NMSCST LMS:' . PHP_EOL . $cashier_name . '(Cashier) updated your last payment details.' . PHP_EOL . 'Loan ref no.: ' . $ref_no . PHP_EOL . '(computer msg)'; //Message
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
        text: 'Payment details updated'
      })
      </script>";
      header('location: ../pages/admin/index.php?page=view-payments&refid=' . $ref_no);
    else :
      $_SESSION['status'] = "<script>
      Swal.fire({
        icon: 'error',
        title: 'Failed',
        text: 'Payment details not updated.'
      })
      </script>";
      header('location: ../pages/admin/index.php?page=view-payments&refid=' . $ref_no);
    endif;
  }
}