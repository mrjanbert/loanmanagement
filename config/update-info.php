<?php
require_once 'data/Database.php';
session_start();

if (isset($_POST['update_info'])) {
    extract($_POST);

    $query = "UPDATE tbl_borrowers SET contactNumber = '$contactNumber', address = '$address' WHERE user_id = '$borrower_id' ";
    $results = $conn->query($query);
    if ($conn->affected_rows > 0) :
        $_SESSION['status'] = "<script>
        Swal.fire({
            icon: 'success',
            title: 'Done',
            text: 'User information Updated.'
        })
    </script>";
        header('location: ../pages/client/index.php?page=dashboard');
    else :
        $_SESSION['status'] = "<script>
        Swal.fire({
            icon: 'success',
            title: 'Done',
            text: 'User information Updated.'
        })
    </script>";
        header('location: ../pages/client/index.php?page=dashboard');
    endif;
}
