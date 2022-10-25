<?php
$response = array(
  'status' => 0,
  'message' => '',
  'usrcode' => ''
);

require_once 'data/Database.php';

if (isset($_POST['username'])) {
  extract($_POST);

  if ($middleName == '') {
    $middleName = null;
  }

  $explodedEmail = explode('@', $email);
  $domain = array_pop($explodedEmail);

  $data_inserted = md5(strtotime(date("Y-m-d H:i:s")));

  $otp = date('His');

  $firstName = ucwords($firstName);
  $middleName = ucwords($middleName);
  $lastName = ucwords($lastName);
  $address = ucwords($address);

  $encrypt = password_hash($password, PASSWORD_DEFAULT);

  $checkusername = $conn->query("SELECT * FROM tbl_borrowers WHERE username = '$username'");
  $checkusername1 = $conn->query("SELECT * FROM tbl_users WHERE username = '$username'");
  $checkmobilenumber = $conn->query("SELECT * FROM tbl_users WHERE contactNumber = '$contactNumber'");
  $checkid = $conn->query("SELECT * FROM tbl_users WHERE accountNumber = '$accountNumber'");

  if (mysqli_num_rows($checkusername) == 1) {
    $response['status'] = 0;
    $response['message'] = 'Username already used. Please use another one.';
  } elseif (mysqli_num_rows($checkusername1) == 1) {
    $response['status'] = 0;
    $response['message'] = 'Username already used. Please use another one.';
  } elseif (mysqli_num_rows($checkmobilenumber) == 1) {
    $response['status'] = 0;
    $response['message'] = 'Mobile Number already used. Please use another one.';
  } elseif (mysqli_num_rows($checkid) == 1) {
    $response['status'] = 0;
    $response['message'] = 'ID Number already existed. Use your own ID Number.';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response['status'] = 0;
    $response['message'] = 'Invalid email format';
  } elseif (!($domain == "nmsc.edu.ph")) {
    $response['status'] = 0;
    $response['message'] = 'Please use your institutional email.';
  } elseif (preg_match('/^[0-9]{11}+$/', $contactNumber) === 0) {
    $response['status'] = 0;
    $response['message'] = 'Invalid Mobile Number';
  } else {
    $contactNumber = filter_var($contactNumber, FILTER_SANITIZE_NUMBER_INT);
    $query = "INSERT INTO tbl_tmp_registration
            SET 
                accountNumber = '$accountNumber',
                firstName = '$firstName',
                middleName = '$middleName',
                lastName = '$lastName',
                address = '$address',
                birthDate = '$birthDate',
                contactNumber = '$contactNumber',
                email = '$email',
                username = '$username',
                password = '$encrypt',
                data_inserted = '$data_inserted',
                otp = '$otp'
            ";
    $results = $conn->query($query);
    if ($conn->affected_rows > 0) :
      $response['status'] = 1;
      $response['usrcode'] = $data_inserted;

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

    // header('location: ../auth_check.php?conf='.$data_inserted);

    else :
      $response['status'] = 0;
    endif;
  }
}

echo json_encode($response);
