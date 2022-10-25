<?php
require_once 'data/Database.php';
session_start();

if (isset($_POST['addloantype_btn'])) {
  extract($_POST);

  // $data = " user_id = '$user_id' ";
  // $data .= ", firstName = '$firstName' ";
  // $data .= ", lastName = '$lastName' ";

  // echo 'firstname: ' . $firstName . ', lastname: ' . $lastName . ', user_id: ' . $user_id;
  if($loantype_name == '') {
    $_SESSION['status'] = "<script>
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Nothing to add.'
        })
      </script>";
    header('location: ../pages/admin/index.php?page=type-of-loan');
  } else {
    $query = $conn->query("INSERT INTO tbl_loantype SET loantype_name = '$loantype_name'");
    if ($conn->affected_rows > 0) :
      $_SESSION['status'] = "<script>
        Swal.fire({
          icon: 'success',
          title: 'Done',
          text: 'Loan type added.'
        })
      </script>";
      header('location: ../pages/admin/index.php?page=type-of-loan');
    endif;
  }
}
