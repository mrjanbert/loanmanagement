<?php
require_once 'data/Database.php';

if (isset($_POST['submit'])) {
    $accountNumber = '12'.rand(1000000,10000000);
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $address = $_POST['address'];
    $age = $_POST['age'];

    $profilePhoto = $_FILES['profilePhoto']['name'];
    $temp = $_FILES['profilePhoto']['tmp_name'];
    $folder = '../components/img/uploads/' . $profilePhoto;

    $birthDate = $_POST['birthDate'];
    $contactNumber = '+63' .$_POST['contactNumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $encrypt = base64_encode($password);

	if(move_uploaded_file($temp,$folder)) {
        $query = "INSERT INTO tbl_borrowers
            SET
                accountNumber = '$accountNumber',
                firstName = '$firstName',
                middleName = '$middleName',
                lastName = '$lastName',
                address = '$address',
                age = '$age',
                profilePhoto = '$profilePhoto',
                birthDate = '$birthDate',
                contactNumber = '$contactNumber',
                email = '$email',
                password = '$encrypt'
            ";
        $results = $conn->query($query);
        if ($conn->affected_rows > 0) :
            header('location: ../pages/client/login.php');
        else :
            header('location: ../pages/client/register.php');
        endif;
    } else {
        header('location: ../pages/client/register.php');
    }
}


?>