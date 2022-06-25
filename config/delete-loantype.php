<?php 
require_once 'data/Database.php';

// Delete Loan Types
if(isset($_GET['deleteloantype_id'])){
    $loantype_id = $_GET['deleteloantype_id'];
    $result = mysqli_query($conn, "DELETE FROM loan_types WHERE loantype_id ='$loantype_id'");
    header('location: ../pages/admin/index.php?page=loan-types');
}
?>