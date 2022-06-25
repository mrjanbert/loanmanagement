<?php
require_once 'data/Database.php';

// Add Loan Plan
if (isset($_POST['submit'])) {
    extract($_POST);
    $data = " typeofLoan = '$typeofLoan' ";
    $data .= ", description = '$description' ";
  
    $query = "INSERT INTO loan_types SET ". $data;
        $results = $conn->query($query);
        if ($conn->affected_rows > 0) :
            header('location: ../pages/admin/index.php?page=loan-types');
        else :
            header('location: ../pages/admin/index.php?page=loan-types');
        endif;
      
}