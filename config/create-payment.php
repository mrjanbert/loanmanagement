<?php 
require_once 'data/Database.php';

if(isset($_POST['submit'])) {
    extract($_POST);

    $receipt_no = 16 .rand(10000000,99999999);

    $checkbal = $conn->query("SELECT * FROM tbl_transaction WHERE ref_no = $ref_no");
    $databal = $checkbal->fetch_array();
    $balance = $databal['balance'];

    $remainbalance = $balance - $payment_amount + $penalty;

    $data = " ref_no = '$ref_no' ";
    $data .= ", receipt_no = '$receipt_no' ";
    $data .= ", payee = '$payee' ";
    $data .= ", payment_amount = '$payment_amount' ";
    $data .= ", penalty = '$penalty' ";
    $data .= ", balance = '$remainbalance' ";

    $query = "INSERT INTO tbl_payments SET ". $data;
    $result = $conn->query($query);

    if ($conn->affected_rows > 0) :
        session_start();
        $_SESSION['status']= "<script>
        Swal.fire({
            icon: 'success',
            title: 'Done',
            text: 'Payment added'
        })
        </script>";
        header('location: ../pages/admin/index.php?page=payments&usr='.base64_encode($_SESSION['role_name']));
    else :
        session_start();
        $_SESSION['status']= "<script>
            Swal.fire({
                icon: 'error',
                title: 'Failed',
                text: 'Payment not added.'
            })
        </script>";
        header('location: ../pages/admin/index.php?page=payments&usr='.base64_encode($_SESSION['role_name']));
    endif;

    
}