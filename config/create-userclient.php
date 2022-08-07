<?php

$response = array(
    'status' => 0,
    'message' => ''
);

require_once 'data/Database.php';

if (isset($_POST['username'])) {
    extract($_POST);

    if ($middleName == '') {
        $middleName = null;
    }

    $diff = date_diff(date_create($birthDate), date_create(date('Y-m-d')));
    $age = $diff->format("%y");

    $encrypt = md5($password);

    $checkusername = $conn->query("SELECT * FROM tbl_borrowers WHERE username = '$username'");
    $checkusername1 = $conn->query("SELECT * FROM tbl_users WHERE username = '$username'");
    $checkmobilenumber = $conn->query("SELECT * FROM tbl_users WHERE contactNumber = '$contactNumber'");
    $checkmobilenumber1 = $conn->query("SELECT * FROM tbl_borrowers WHERE contactNumber = '$contactNumber'");

    if(mysqli_num_rows($checkusername) == 1) {
        $response['status'] = 0;
        $response['message'] = 'Username already exist. Please use another one.';
    } elseif(mysqli_num_rows($checkusername1) == 1) {
        $response['status'] = 0;
        $response['message'] = 'Username already exist. Please use another one.';
    } elseif (mysqli_num_rows($checkmobilenumber) == 1) {
        $response['status'] = 0;
        $response['message'] = 'Mobile Number already exist. Please use another one.';
    } elseif (mysqli_num_rows($checkmobilenumber1) == 1) {
        $response['status'] = 0;
        $response['message'] = 'Mobile Number already exist. Please use another one.';
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['status'] = 0;
        $response['message'] = 'Invalid email format';
    } elseif(preg_match('/^[0-9]{11}+$/', $contactNumber) === 0) {
        $response['status'] = 0;
        $response['message'] = 'Invalid Mobile Number';
    } else {
        $contactNumber = filter_var($contactNumber, FILTER_SANITIZE_NUMBER_INT);
        $query = "INSERT INTO tbl_borrowers 
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
            ";
        $results = $conn->query($query);
        if ($conn->affected_rows > 0) :
            $response['status'] = 1;
            session_start();
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
            // header('location: ../pages/client/login.php');
            
            else :
                $response['status'] = 0;
                // session_start();
                // $_SESSION['status'] = "<script>const Toast = Swal.mixin({
                //         toast: true,
                //         position: 'top-end',
                //         showConfirmButton: false,
                //         timer: 5000
                //     })
                
                //     Toast.fire({
                //         icon: 'error',
                //         title: 'Signing up failed. Please try again.'
                //     })</script>";
                // header('location: ../pages/client/register.php');
        endif;
    }
}

echo json_encode($response);
