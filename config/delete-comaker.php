<?php
require_once 'data/Database.php';
session_start();

if (isset($_GET['delete_comaker_id'])) {
  $user_id = $_GET['delete_comaker_id'];

  $sql = "DELETE FROM tbl_comakers WHERE user_id = '$user_id'";
  
  $results = $conn->query($sql);
  if ($conn->affected_rows > 0) :
    $query = $conn->query("UPDATE tbl_borrowers SET membership = '0' WHERE user_id = '$user_id'");
    $_SESSION['status'] = "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Done',
                    text: 'Co-maker deleted successfully.'
                })
            </script>";
    header('location: ../pages/admin/index.php?page=comakers');
  endif;
}
