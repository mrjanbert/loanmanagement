<?php
require_once 'data/Database.php';

if (isset($_POST['submit'])) {
    $accountNumber = $_POST['accountNumber'];
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $birthDate = $_POST['birthDate'];

    $profilePhoto = strtotime(date("i:s")).$_FILES['profilePhoto']['name'];
    $temp = $_FILES['profilePhoto']['tmp_name'];
    $folder = '../components/img/uploads/' . $profilePhoto;

    $contactNumber = '+63' . $_POST['contactNumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_name = $_POST['role_name'];
    $encrypt = base64_encode($password);

    if (move_uploaded_file($temp, $folder)) {
        $query = "INSERT INTO tbl_users 
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
            password = '$encrypt',
            role_name = '$role_name'
        ";
        $results = $conn->query($query);
        if ($conn->affected_rows > 0) :
            session_start();
            $_SESSION['status']="<script>const Toast = Swal.mixin({
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
        else :
            header('location: ../register.php');
        endif;
    } else {
        header('location: ../register.php');
    }
}
?>