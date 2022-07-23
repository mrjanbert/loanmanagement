<?php
require_once 'data/Database.php';

if (isset($_POST['submit'])) {
    extract($_POST);

    $checkbal = $conn->query("SELECT t.*, concat(b.firstName,' ',b.lastName) as payee FROM tbl_transaction t INNER JOIN tbl_borrowers b WHERE ref_no = $ref_no");
    $databal = $checkbal->fetch_array();
    $balance = $databal['balance'];
    $payee = $databal['payee'];


    $remainbalance = $balance - $payment_amount;

    $data = " ref_no = '$ref_no' ";
    $data .= ", receipt_no = '$receipt_no' ";
    $data .= ", payee = '$payee' ";
    $data .= ", payment_amount = '$payment_amount' ";
    $data .= ", payment_balance = '$remainbalance' ";


    $query = "INSERT INTO tbl_payments SET " . $data;
    $result = $conn->query($query);

    if ($conn->affected_rows > 0) :
        session_start();
        $_SESSION['status'] = "<script>
        Swal.fire({
            icon: 'success',
            title: 'Done',
            text: 'Payment added'
        })
        </script>";
        header('location: ../pages/admin/index.php?page=view-payments&refid=' . $ref_no . '&usr=' . base64_encode($_SESSION['role_name']));
    else :
        session_start();
        $_SESSION['status'] = "<script>
            Swal.fire({
                icon: 'error',
                title: 'Failed',
                text: 'Payment not added.'
            })
        </script>";
        header('location: ../pages/admin/index.php?page=view-payments&refid=' . $ref_no . '&usr=' . base64_encode($_SESSION['role_name']));
    endif;
}
