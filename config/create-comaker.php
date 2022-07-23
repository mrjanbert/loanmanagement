<?php
require_once 'data/Database.php';

if (isset($_POST['submit'])) {
    extract($_POST);

    $check = $conn->query("SELECT * FROM tbl_borrowers WHERE user_id = $user_id");
    $get = $check->fetch_array();
    $firstName = $get['firstName'];
    $lastName = $get['lastName'];

    $data = " user_id = '$user_id' ";
    $data .= ", firstName = '$firstName' ";
    $data .= ", lastName = '$lastName' ";

    // echo 'firstname: ' . $firstName . ', lastname: ' . $lastName . ', user_id: ' . $user_id;
    $query = $conn->query("INSERT INTO tbl_comakers SET " . $data);

    if ($conn->affected_rows > 0) :

        //Set borrower to member
        $query1 = $conn->query("UPDATE tbl_borrowers SET membership = '1' WHERE user_id = $user_id");

        session_start();
        $_SESSION['status'] = "<script>
        Swal.fire({
            icon: 'success',
            title: 'Done',
            text: 'Co-maker added successfully.'
        })
        </script>";
        header('location: ../pages/admin/index.php?page=comakers&usr=' . base64_encode($_SESSION['role_name']));
    else :
        session_start();
        $_SESSION['status'] = "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Co-maker not added on the list.'
            })
        </script>";
        header('location: ../pages/admin/index.php?page=comakers&usr=' . base64_encode($_SESSION['role_name']));

    endif;
}
