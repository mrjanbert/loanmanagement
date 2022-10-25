<?php
require_once 'data/Database.php';
session_start();

if (isset($_GET['notif_id'])) {
  $id = $_GET['notif_id'];

  $search = $conn->query("SELECT * FROM tbl_monthlynotif WHERE id = '$id'");
  $row = $search->fetch_assoc();
  $loan_ref = $row['loan_ref'];

  $query = $conn->query("DELETE FROM tbl_monthlynotif WHERE id = '$id'");
  $results = $conn->query($sql);
  
  if ($conn->affected_rows > 0) :
    $_SESSION['status'] = "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Done',
                    text: 'Selected date has been deleted.'
                })
            </script>";
    header('location: ../pages/admin/index.php?page=view-monthly-reminder&ref_no='.$loan_ref);
  endif;
}
