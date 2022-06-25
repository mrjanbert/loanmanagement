<?php   
require_once 'data/Database.php';

// Delete Loan Plans
if(isset($_GET['deleteplan_id'])){
    $plan_id = $_GET['deleteplan_id'];
    $result = mysqli_query($conn, "DELETE FROM loan_plans WHERE plan_id ='$plan_id'");
    header('location: ../pages/admin/index.php?page=loan-plans');
}

?>