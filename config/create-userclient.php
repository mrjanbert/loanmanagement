<?php
require_once 'data/Database.php';
session_start();

if (isset($_POST['submit'])) {

  $conf = $_POST['data_inserted'];
  $code = $_POST['code'];


  $sql = $conn->query("SELECT * FROM tbl_tmp_registration WHERE data_inserted = '$conf'");
  $user = $sql->fetch_array();

  $otp = $user['otp'];
  $accountNumber = $user['accountNumber'];
  $firstName = $user['firstName'];
  $middleName = $user['middleName'];
  $lastName = $user['lastName'];
  $address = $user['address'];
  $birthDate = $user['birthDate'];
  $contactNumber = $user['contactNumber'];
  $email = $user['email'];
  $username = $user['username'];
  $password = $user['password'];

  $userCreated = date('Y-m-d H:i:s');
  $diff = date_diff(date_create($birthDate), date_create(date('Y-m-d')));
  $age = $diff->format("%y");

  if ($otp == $code) {
    $query = "INSERT INTO tbl_borrowers 
      SET 
        accountNumber = '$accountNumber',
        firstName = '$firstName',
        middleName = '$middleName',
        lastName = '$lastName',
        address = '$address',
        age = '$age',
        profilePhoto = '',
        birthDate = '$birthDate',
        contactNumber = '$contactNumber',
        email = '$email',
        userCreated = '$userCreated',
        username = '$username',
        password = '$password'
      ";
    $results = $conn->query($query);
    if ($conn->affected_rows > 0) {
      $deletetmp = $conn->query("DELETE FROM tbl_tmp_registration WHERE data_inserted = '$conf'");

      $sendmessage = $conn->query("SELECT * FROM tbl_users WHERE role_name = 'Admin'");
      while($row = $sendmessage->fetch_assoc()) {

        $name = $row['firstName'] . ' ' . $row['lastName'];

        $url = "https://semysms.net/api/3/sms.php"; //Url address for sending SMS
        $phone = $row['contactNumber']; // Phone number
        $msg = 'NMSCST LMS: ' . PHP_EOL . 'New borrower registered.' . PHP_EOL . 'Name: '. $firstName . ' ' . $lastName . PHP_EOL . '(computer msg)'; // Message
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

        echo $msg;
        if ($output) {
          $addmsg = $conn->query("INSERT INTO tbl_smslogs SET contactNumber = '$phone', name = '$name', message = '$msg', date = now()");
        } else {
          '';
        }
      }

      $_SESSION['status'] = "<script>const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
      })
          
      Toast.fire({
        icon: 'success',
        title: 'Registered Successfully.'
      })</script>";

      header('location: ../login.php');
    }
  } else {
    $_SESSION['status'] = "<script>const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 5000
    })

    Toast.fire({
      icon: 'error',
      title: 'Wrong authentication code. Please try again.'
    })</script>";
    header('location: ../auth_check.php?conf=' . $conf. '&usr=borrower');
  }
}
