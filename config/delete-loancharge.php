<?php
require_once 'data/Database.php';

// Delete Charges
if (isset($_GET['deleteloancharge_id'])) {
    $charges_id = $_GET['deleteloancharge_id'];
    $result = mysqli_query($conn, "DELETE FROM tbl_charges WHERE charges_id='$charges_id'");
    header('location: ../pages/admin/index.php?page=loan-charges');
}
