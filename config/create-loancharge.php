<?php
require_once 'data/Database.php';

// Add Loan Charges
if (isset($_POST['submit'])) {
    extract($_POST);
    $data = " charges_type = '$charges_type' ";
    $data .= ", charge_percentage = '$charge_percentage' ";

    $query = "INSERT INTO tbl_charges SET ". $data;
        $results = $conn->query($query);
        if ($conn->affected_rows > 0) :
            header('location: ../pages/admin/index.php?page=loan-charges');
        else :
            header('location: ../pages/admin/index.php?page=loan-charges');
        endif;
      
}