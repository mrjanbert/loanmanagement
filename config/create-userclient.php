<?php
require_once 'data/Database.php';

if (isset($_POST['submit'])) {
    $accountNumber = $_POST['accountNumber'];
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];

    if ($middleName == '') {
        $middleName = null;
    }

    $lastName = $_POST['lastName'];
    $address = $_POST['address'];
    $birthDate = $_POST['birthDate'];

    $diff = date_diff(date_create($birthDate), date_create(date('Y-m-d')));
    $age = $diff->format("%y");

    $contactNumber = '+63' . $_POST['contactNumber'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $encrypt = md5($password);

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
        header('location: ../pages/client/login.php');
    else :
        session_start();
        $_SESSION['status'] = "<script>const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
            })
        
            Toast.fire({
                icon: 'error',
                title: 'Signing up failed. Please try again.'
            })</script>";
        header('location: ../pages/client/register.php');
    endif;
}
