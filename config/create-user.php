<?php
require_once 'data/Database.php';

if (isset($_POST['submit'])) {
    $accountNumber = $_POST['accountNumber'];
    $username = $_POST['username'];
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];

    if ($middleName == '') {
        $middleName = '';
    }   

    $lastName = $_POST['lastName'];
    $address = $_POST['address'];
    $diff = date_diff(date_create($birthDate), date_create(date('Y-m-d')));
    $age = $diff->format("%y");


    $birthDate = $_POST['birthDate'];

    $profilePhoto = strtotime(date("i:s")).$_FILES['profilePhoto']['name'];
    $temp = $_FILES['profilePhoto']['tmp_name'];
    $folder = '../components/img/uploads/' . $profilePhoto;

    $contactNumber = '+63' . $_POST['contactNumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $encrypt = md5($password);


    

    if (move_uploaded_file($temp, $folder)) {
        $query = "INSERT INTO tbl_users 
        SET 
            accountNumber = '$accountNumber',
            username = '$username',
            firstName = '$firstName',
            middleName = '$middleName',
            lastName = '$lastName',
            address = '$address',
            age = '$age',
            birthDate = '$birthDate',
            profilePhoto = '$profilePhoto',
            contactNumber = '$contactNumber',
            email = '$email',
            password = '$encrypt'
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
            header('location: ../register.php');
        endif;
    } else {
        session_start();
        $_SESSION['status'] = "<script>const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        })
    
        Toast.fire({
            icon: 'error',
            title: 'Uploading image failed. Please try again.'
        })</script>";
        header('location: ../register.php');
    }
}
?>