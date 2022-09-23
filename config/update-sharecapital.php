<?php
require_once 'data/Database.php';
session_start();

if (isset($_POST['submit'])) {
  extract($_POST);


  $checkbalance = $conn->query("SELECT balance FROM tbl_sharecapital WHERE borrower_id = '$uid' ORDER BY id DESC ");
  $bal = $checkbalance->fetch_array();

  $checkuser = $conn->query("SELECT * FROM tbl_sharecapital WHERE borrower_id = '$uid'");

  if($checkuser->num_rows > 0) {
      if ($operator == 'add') {
      $deposit = $amount;
      $withdrawal = 0;
      $status = "deposited";
      $balance = $bal['balance'] + $deposit;
    } elseif ($operator == 'minus') {
      $deposit = 0;
      $withdrawal = $amount;
      $status = "withdrawn";
      $balance = $bal['balance'] - $withdrawal;
    }
    $updateshare = $conn->query("UPDATE tbl_totalshares SET borrower_id = '$uid', share_capital = '$balance', date_modified = now() WHERE borrower_id = '$uid'");
  } else {
    if ($operator == 'add') {
      $deposit = $amount;
      $withdrawal = 0;
      $balance = $amount;
      $status = "deposited";
    } elseif ($operator == 'minus') {
      $deposit = 0;
      $withdrawal = $amount;
      $status = "withdrawn";
      $balance = 0;
    }
    $addshare = $conn->query("INSERT INTO tbl_totalshares SET borrower_id = '$uid', share_capital = '$balance', date_modified = now()");
  }

  $data = " borrower_id = '$uid'";
  $data .= ", description = '$description'";
  $data .= ", deposit = '$deposit'";
  $data .= ", withdrawal = '$withdrawal'";
  $data .= ", balance = '$balance'";

  // echo $data;
  $insert = "INSERT INTO tbl_sharecapital SET ". $data;
  $result = $conn->query($insert);
  if ($conn->affected_rows > 0) {

    $user = $conn->query("SELECT contactNumber, concat(firstName,' ',lastName) as borrower_name FROM tbl_borrowers WHERE user_id = '$uid'");
    $fetch = $user->fetch_array();
    $borrower_name = $fetch['borrower_name'];

    $url = "https://semysms.net/api/3/sms.php"; //Url address for sending SMS
    $phone = $fetch['contactNumber']; // Phone number
    $msg = 'FROM NMSCST LMS:' . PHP_EOL . number_format($deposit + $withdrawal, 2) . ' pesos has been ' . $status . ' in your share capital.' . PHP_EOL . '(computer msg)';
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

    // echo $msg;
    if ($output) {
      $addmsg = $conn->query("INSERT INTO tbl_smslogs SET contactNumber = '$phone', name = '$borrower_name', message = '$msg', date = now()");
    }

    $_SESSION['status'] = "<script>const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
      })
            
      Toast.fire({
        icon: 'success',
        title: 'Share capital $status successfully.'
      })</script>";
    header('location: ../pages/admin/index.php?page=view-share-capital&uid=' . $uid);
  } else {
    $_SESSION['status'] = "<script>const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
      })
            
      Toast.fire({
        icon: 'error',
        title: 'Update failed. Please try again.'
      })</script>";
    header('location: ../pages/admin/index.php?page=view-share-capital&uid=' . $uid);
  }
}
