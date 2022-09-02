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
    $query = "INSERT INTO tbl_users 
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
        role_name = 'Unknown User',
        password = '$password'
      ";
    $results = $conn->query($query);
    if ($conn->affected_rows > 0) {
      $deletetmp = $conn->query("DELETE FROM tbl_tmp_registration WHERE data_inserted = '$conf'");
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
    header('location: ../auth_check.php?conf=' . $conf . '&usr=admin');
  }
}
