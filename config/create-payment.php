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

  if($month == '') {
    $month = 0;
  }

  $penalty = $monthly * 0.015;
  $total_penalty = $penalty * $month;

  $remainbalance = $balance - $payment_amount + $total_penalty;

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
    $data .= ", payment_amount = '$payment_amount' ";
    $data .= ", payment_balance = '$remainbalance' ";
    $data .= ", payment_date = '$payment_date'";

    $query = "INSERT INTO tbl_payments SET " . $data;
    $result = $conn->query($query);

    if ($conn->affected_rows > 0) :
      $url = "https://semysms.net/api/3/sms.php"; //Url address for sending SMS
      $phone = $contactNumber; // Phone number
      $msg = 'FROM NMSCST LMS: You have paid P' . number_format($payment_amount, 2) . ' with OR Number ' . $receipt_no . '.' . PHP_EOL . 'Your current balance is P' . number_format($remainbalance, 2) . '.' . PHP_EOL . 'Loan ref no.: ' . $ref_no . PHP_EOL . '(computer msg)'; //Message
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
