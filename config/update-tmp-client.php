<?php

$response = array(
  'status' => 0,
  'message' => '',
  'usrcode' => ''
);

require_once 'data/Database.php';

if (isset($_POST['user_id']) || isset($_FILES['profilePhoto']['name'])) {
  extract($_POST);

  $checkphoto = $conn->query("SELECT profilePhoto FROM tbl_borrowers WHERE user_id = '$user_id'");
  $data = $checkphoto->fetch_array();
  $currentphoto = $data['profilePhoto'];

  $profilePhoto = date('mdYhis') . '_' . $_FILES['profilePhoto']['name'];
  $temp = $_FILES['profilePhoto']['tmp_name'];
  $folder = "../assets/images/uploads/" . $profilePhoto;
  $imgsize = $_FILES['profilePhoto']['size'];

  $address = ucwords($address);

  $explodedEmail = explode('@', $email);
  $domain = array_pop($explodedEmail);

  $data_inserted = md5(strtotime(date("Y-m-d H:i:s")));

  $otp = date('His');

  if ($profilePhoto == '') {
    $profilePhoto = $currentphoto;
  } else {
    $profilePhoto = $profilePhoto;
  }

  $diff = date_diff(date_create($birthDate), date_create(date('Y-m-d')));
  $age = $diff->format("%y");

  $checkusername = $conn->query("SELECT * FROM tbl_borrowers WHERE username = '$username' AND user_id != '$user_id'");
  $checkmobilenumber = $conn->query("SELECT * FROM tbl_borrowers WHERE contactNumber = '$contactNumber' AND user_id != '$user_id'");
  if (mysqli_num_rows($checkusername) == 1) {
    $response['status'] = 0;
    $response['message'] = 'Username already used. Please use another one.';
  } elseif (mysqli_num_rows($checkmobilenumber) == 1) {
    $response['status'] = 0;
    $response['message'] = 'Mobile number already used. Please use a new mobile number.';
  } elseif ($imgsize > 5000000) {
    $response['status'] = 0;
    $response['message'] = 'The image you have uploaded is too large. The maximum size is 5MB.';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response['status'] = 0;
    $response['message'] = 'Invalid email format';
  } elseif (!($domain == "nmsc.edu.ph")) {
    $response['status'] = 0;
    $response['message'] = 'Please use your institutional email.';
  } elseif (preg_match('/^[0-9]{11}+$/', $contactNumber) === 0) {
    $response['status'] = 0;
    $response['message'] = 'Invalid mobile number';
  } else {

    $checkpassword = $conn->query("SELECT password FROM tbl_borrowers WHERE user_id = $user_id");
    $row = $checkpassword->fetch_array();

    if ($password == '') {
      $encrypt = $row['password'];
    } else {
      $encrypt = password_hash($password, PASSWORD_DEFAULT);
    }

    $contactNumber = filter_var($contactNumber, FILTER_SANITIZE_NUMBER_INT);

    if (move_uploaded_file($temp, $folder)) {
      // unlink("../assets/images/uploads/" . $currentphoto);
      $checkupdate = $conn->query("SELECT * FROM tbl_borrowers WHERE address = '$address' AND age = '$age' AND birthDate = '$birthDate' AND profilePhoto = '$profilePhoto' AND contactNumber = '$contactNumber' AND email = '$email' AND password = '$encrypt' AND user_id = '$user_id'");
      if (mysqli_num_rows($checkupdate) == 1) {
        $response['status'] = 0;
        $response['message'] = 'No changes made.';
      } else {
        $query = "INSERT INTO tbl_tmp_registration 
        SET 
          borrower_id = '$user_id',
          address = '$address',
          age = '$age',
          birthDate = '$birthDate',
          profilePhoto = '$profilePhoto',
          contactNumber = '$contactNumber',
          email = '$email',
          username = '$username',
          password = '$encrypt',
          data_inserted = '$data_inserted',
          otp = '$otp'";
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
        endif;
      }
    } else {
      $checkupdate1 = $conn->query("SELECT * FROM tbl_borrowers WHERE address = '$address' AND age = '$age' AND birthDate = '$birthDate' AND profilePhoto = '$currentphoto' AND contactNumber = '$contactNumber' AND email = '$email' AND password = '$encrypt' AND user_id = '$user_id'");
      if (mysqli_num_rows($checkupdate1) == 1) {
        $response['status'] = 0;
        $response['message'] = 'No changes made.';
      } else {
        $query = "INSERT INTO tbl_tmp_registration 
        SET 
          borrower_id = '$user_id',
          address = '$address',
          age = '$age',
          birthDate = '$birthDate',
          contactNumber = '$contactNumber',
          profilePhoto = '$currentphoto',
          email = '$email',
          username = '$username',
          password = '$encrypt',
          data_inserted = '$data_inserted',
          otp = '$otp'";
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
        endif;
      }
    }
  }
}
echo json_encode($response);
