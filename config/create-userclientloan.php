<?php 
    require_once 'data/Database.php';

    if (isset($_POST['submit'])) {
        $ref_no = '15' . rand(100000, 1000000);

        $user_id = $_POST['user_id'];
        $plan_id = $_POST['plan_id'];
        $loantype_id = $_POST['loantype_id'];
        $purpose = $_POST['purpose'];
        $amount = $_POST['amount'];
        $status = $_POST['status'];

        $query = "INSERT INTO tbl_transactions 
        SET  
            ref_no = '$ref_no', 
            user_id = '$user_id',
            plan_id = '$plan_id',
            loantype_id = '$loantype_id',
            purpose = '$purpose',
            amount = '$amount',
            status = '$status' ";
        $result = $conn->query($query);

        if ($conn->affected_rows > 0) :
            header('location: ../pages/client/index.php?page=loan-list');
        else :
            header('location: ../pages/client/index.php?page=loan-list');
        endif;

    }
?>