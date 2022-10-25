<?php
require_once 'data/Database.php';
session_start();

if (isset($_POST['submit'])) {

  $conf = $_POST['data_inserted'];
  $code = $_POST['code'];

  $sql = $conn->query("SELECT * FROM tbl_tmp_registration WHERE data_inserted = '$conf'");
  $user = $sql->fetch_array();

  $otp = $user['otp'];
  $user_id = $user['admin_id'];
  $accountNumber = $user['accountNumber'];
  $firstName = $user['firstName'];
  $middleName = $user['middleName'];
  $lastName = $user['lastName'];
  $address = $user['address'];
  $birthDate = $user['birthDate'];
  $age = $user['age'];
  $profilePhoto = $user['profilePhoto'];
  $contactNumber = $user['contactNumber'];
  $email = $user['email'];
  $username = $user['username'];
  $password = $user['password'];

  $checkphoto = $conn->query("SELECT profilePhoto FROM tbl_users WHERE user_id = '$user_id'");
  $data = $checkphoto->fetch_array();
  $currentphoto = $data['profilePhoto'];


  if($otp == $code) {
    if($profilePhoto == $currentphoto) {
      $query = "UPDATE tbl_users 
        SET 
          address = '$address',
          age = '$age',
          birthDate = '$birthDate',
          profilePhoto = '$currentphoto',
          contactNumber = '$contactNumber',
          email = '$email',
          username = '$username',
          password = '$password'
        WHERE user_id = $user_id
      ";
    } else {
      unlink("../assets/images/uploads/" . $currentphoto);
      $query = "UPDATE tbl_users 
        SET 
          address = '$address',
          age = '$age',
          birthDate = '$birthDate',
          profilePhoto = '$profilePhoto',
          contactNumber = '$contactNumber',
          email = '$email',
          username = '$username',
          password = '$password'
        WHERE user_id = $user_id
      ";
    }
    $results = $conn->query($query);
    if ($conn->affected_rows > 0) :
      $deletetmp = $conn->query("DELETE FROM tbl_tmp_registration WHERE data_inserted = '$conf'");
      $response['status'] = 1;
      $_SESSION['status'] = "<script>const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
      })
            
      Toast.fire({
        icon: 'success',
        title: 'Profile information updated.'
      })</script>";
      header('location: ../pages/admin/index.php?page=profile');
    endif;
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
    header('location: ../pages/admin/index.php?page=auth-code&conf='.$conf);
  }
}