<?php
require_once 'data/Database.php';
session_start();

if (isset($_GET['delete_permission_id'])) {
  $user_id = $_GET['delete_permission_id'];

  $sql = "UPDATE tbl_users SET role_name = 'Unknown User' WHERE user_id = '$user_id'";

  $results = $conn->query($sql);
  if ($conn->affected_rows > 0) :
    $_SESSION['status'] = "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Done',
                    text: 'User\'s role deleted successfully.'
                })
            </script>";
    header('location: ../pages/admin/index.php?page=user-roles');
  endif;
}
