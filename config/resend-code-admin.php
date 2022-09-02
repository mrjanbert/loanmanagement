<?php
require_once 'data/Database.php';
session_start();

if (isset($_GET['conf'])) {

  $conf = $_GET['conf'];
  $sql = $conn->query("SELECT otp, contactNumber FROM tbl_tmp_registration WHERE data_inserted = '$conf'");
  $row = $sql->fetch_array();
  $contactNumber = $row['contactNumber'];
  $otp = $row['otp'];

  $url = "https://semysms.net/api/3/sms.php"; //Url address for sending SMS
  $phone = $contactNumber; // Phone number
  $msg = 'DO NOT share this CODE with anyone. Enter ' . $otp . ' to verify your account on NMSCST LMS.';
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

  $_SESSION['status'] = "<script>const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000
  })
          
  Toast.fire({
    icon: 'success',
    title: 'Send Successfully.'
  })</script>";
  header('location: ../pages/admin/index.php?page=auth-code&conf=' . $conf);
}
