<?php 
require_once 'data/Database.php';

if (isset($_GET['approveref_no'])) {

    $ref_no = $_GET['approveref_no'];
    $sql = $conn->query("UPDATE tbl_status SET status_comaker = '1' WHERE ref_no = '$ref_no'");

    session_start();
    $_SESSION['status']= "<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Loan Approoved'
    })
    </script>";
    header('location: ../pages/client/index.php?page=dashboard');

}

if (isset($_GET['denyref_no'])) {

    $ref_no = $_GET['denyref_no'];
    $sql = $conn->query("UPDATE tbl_status SET status_comaker = '2' WHERE ref_no = '$ref_no'");

    session_start();
    $_SESSION['status']= "<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Loan Denied'
    })
    </script>";
    header('location: ../pages/client/index.php?page=dashboard');

}