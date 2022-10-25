<?php

$response = array(
  'status' => 0,
  'message' => ''
);

require_once 'data/Database.php';
session_start();

if (isset($_POST['user_id']) || isset($_FILES['profilePhoto']['name'])) {
  extract($_POST);

  $checkphoto = $conn->query("SELECT profilePhoto FROM tbl_users WHERE user_id = '$user_id'");
  $data = $checkphoto->fetch_array();
  $currentphoto = $data['profilePhoto'];

  $profilePhoto = date('mdYhis') . '_' . $_FILES['profilePhoto']['name'];
  $temp = $_FILES['profilePhoto']['tmp_name'];
  $folder = "../assets/images/uploads/" . $profilePhoto;
  $imgsize = $_FILES['profilePhoto']['size'];

  $firstName = ucwords($firstName);
  $middleName = ucwords($middleName);
  $lastName = ucwords($lastName);
  $address = ucwords($address);

  $explodedEmail = explode('@', $email);
  $domain = array_pop($explodedEmail);

  if ($profilePhoto == '') {
    $profilePhoto = $currentphoto;
  } else {
    $profilePhoto = $profilePhoto;
  }

  $diff = date_diff(date_create($birthDate), date_create(date('Y-m-d')));
  $age = $diff->format("%y");

  $checkusername = $conn->query("SELECT * FROM tbl_users WHERE username = '$username' AND user_id != '$user_id'");
  $checkidnumber = $conn->query("SELECT * FROM tbl_users WHERE accountNumber = '$accountNumber' AND user_id != '$user_id'");
  $checkmobilenumber = $conn->query("SELECT * FROM tbl_users WHERE contactNumber = '$contactNumber' AND user_id != '$user_id'");
  if (mysqli_num_rows($checkusername) == 1) {
    $response['status'] = 0;
    $response['message'] = 'Username already used. Please use another one.';
  } elseif (mysqli_num_rows($checkmobilenumber) == 1) {
    $response['status'] = 0;
    $response['message'] = 'Mobile number already used. Please use a new mobile number.';
  } elseif (mysqli_num_rows($checkidnumber) == 1) {
    $response['status'] = 0;
    $response['message'] = 'ID Number already existed. Use your own ID Number.';
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

    $checkpassword = $conn->query("SELECT password FROM tbl_users WHERE user_id = $user_id");
    $row = $checkpassword->fetch_array();

    if ($password == '') {
      $encrypt = $row['password'];
    } else {
      // $encrypt = md5($password);
      $encrypt = password_hash($password, PASSWORD_DEFAULT);
    }

    $contactNumber = filter_var($contactNumber, FILTER_SANITIZE_NUMBER_INT);

    if (move_uploaded_file($temp, $folder)) {
      unlink("../assets/images/uploads/" . $currentphoto);
      $query = "UPDATE tbl_users 
            SET 
                accountNumber = '$accountNumber',
                firstName = '$firstName',
                middleName = '$middleName',
                lastName = '$lastName',
                address = '$address',
                age = '$age',
                birthDate = '$birthDate',
                profilePhoto = '$profilePhoto',
                contactNumber = '$contactNumber',
                email = '$email',
                username = '$username',
                password = '$encrypt'
              WHERE user_id = $user_id
            ";
      $results = $conn->query($query);
      if ($conn->affected_rows > 0) :
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
      else :
        $response['status'] = 1;
        $_SESSION['status'] = "<script>const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5000
                })
            
                Toast.fire({
                    icon: 'info',
                    title: 'No changes made.'
                })</script>";
      endif;
    } else {
      $query = "UPDATE tbl_users 
            SET 
                accountNumber = '$accountNumber',
                firstName = '$firstName',
                middleName = '$middleName',
                lastName = '$lastName',
                address = '$address',
                age = '$age',
                birthDate = '$birthDate',
                contactNumber = '$contactNumber',
                email = '$email',
                username = '$username',
                password = '$encrypt'
              WHERE user_id = $user_id
            ";
      $results = $conn->query($query);
      if ($conn->affected_rows > 0) :
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
      else :
        $response['status'] = 1;
        $_SESSION['status'] = "<script>const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5000
                })
            
                Toast.fire({
                    icon: 'info',
                    title: 'No changes made.'
                })</script>";
      endif;
    }
  }
}
echo json_encode($response);
