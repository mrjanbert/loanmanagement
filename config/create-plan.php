<?php
require_once 'data/Database.php';

// Add Loan Plan
if (isset($_POST['submit'])) {
    extract($_POST);
    $data = " plan_term = '$plan_term' ";
    $data .= ", interest_percentage = '$interest_percentage' ";
    $data .= ", mode_of_payment = '$mode_of_payment' ";
  
    $query = "INSERT INTO loan_plans SET ". $data;
        $results = $conn->query($query);
        if ($conn->affected_rows > 0) :
            header('location: ../pages/admin/index.php?page=loan-plans');
        else :
            header('location: ../pages/admin/index.php?page=loan-plans');
        endif;
      
}
