<?php
require_once 'data/Database.php';
session_start();

if (isset($_POST['submit'])) {
  extract($_POST);

  $query = "SELECT * FROM tbl_borrowers WHERE username = '$username'";
  $result = mysqli_query($conn, $query);
  $findborrower = mysqli_num_rows($result);

  $query1 = "SELECT * FROM tbl_users WHERE username = '$username'";
  $results = mysqli_query($conn, $query1);
  $findadmin = mysqli_num_rows($results);

  if ($findborrower > 0) {
    $data1 = $result->fetch_array();
    if ($data1['contactNumber'] == $contactNumber) {
      $tmp_pass = base64_encode(date("gis"));
      $encrypt = password_hash($tmp_pass, PASSWORD_DEFAULT);
      $query = "UPDATE tbl_borrowers SET password = '$encrypt' WHERE username = '$username' AND contactNumber = '$contactNumber'";
      $results = $conn->query($query);
      if ($conn->affected_rows > 0) {
        $url = "https://semysms.net/api/3/sms.php"; //Url address for sending SMS
        $phone = $data1['contactNumber']; // Phone number
        $msg = 'NMSCST LMS Account Recovery:' . PHP_EOL . 'Note: New password is set just for you. You can change it anytime.' . PHP_EOL . PHP_EOL .'Username: ' . $data1['username'] . PHP_EOL . 'Password: ' . $tmp_pass;  // Message
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

        $_SESSION['status'] = "<script>
        Swal.fire({
          icon: 'success',
          title: 'Sent',
          text: 'A message was sent to your mobile number. Check your message now.'
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
        title: 'Wrong mobile number used in your account. Please try again.'
      })</script>";
      header('location: ../forgot-password.php');
    }
  } else {
    if ($findadmin > 0) {
      $data2 = $result->fetch_array();
      if ($data2['contactNumber'] == $contactNumber) {
        $tmp_pass = base64_encode(date("gis"));
        $encrypt = password_hash($tmp_pass, PASSWORD_DEFAULT);
        $query = "UPDATE tbl_users SET password = '$encrypt' WHERE username = '$username' AND contactNumber = '$contactNumber'";
        $results = $conn->query($query);
        if ($conn->affected_rows > 0) {
          $url = "https://semysms.net/api/3/sms.php"; //Url address for sending SMS
          $phone = $data2['contactNumber']; // Phone number
          $msg = 'NMSCST LMS Account Recovery:' . PHP_EOL . 'Note: New password is set just for you. You can change it anytime.' . PHP_EOL . PHP_EOL . 'Username: ' . $data2['username'] . PHP_EOL . 'Password: ' . $tmp_pass;  // Message
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

          $_SESSION['status'] = "<script>
          Swal.fire({
            icon: 'success',
            title: 'Sent',
            text: 'A message was sent to your mobile number. Check your message now.'
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
        title: 'Wrong mobile number used in your account. Please try again.'
      })</script>";
        header('location: ../forgot-password.php');
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
        title: 'Sorry, we couldn\'t find your username. Please try again.'
      })</script>";
      header('location: ../forgot-password.php');
    } 
  }
}