<?php
require_once 'data/Database.php';
session_start();

if (isset($_GET['type_id'])) {
  $type_id = $_GET['type_id'];
  $sql = "DELETE FROM tbl_loantype WHERE loantype_id = '$type_id'";

  $results = $conn->query($sql);
    $_SESSION['status'] = "<script>
      Swal.fire({
        icon: 'success',
        title: 'Done',
        text: 'Selected loan type deleted.'
      })
    </script>";
    header('location: ../pages/admin/index.php?page=type-of-loan');
}
