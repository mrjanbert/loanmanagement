<?php
require_once 'data/Database.php';
session_start();

if (isset($_POST['update_info'])) {
    extract($_POST);

    $query = "UPDATE tbl_borrowers SET contactNumber = '$contactNumber', username = '$username', address = '$address' WHERE user_id = '$borrower_id' ";
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

if(isset($_GET['delete_permission_id'])) {
    $user_id = $_GET['delete_permission_id'];

    // echo $user_id;

    $sql = "UPDATE tbl_users SET role_name = null WHERE user_id = '$user_id'";

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


if (isset($_GET['delete_comaker_id'])) {
    $user_id = $_GET['delete_comaker_id'];

    echo $user_id;

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

if(isset($_POST['update_user_info'])) {
    extract($_POST);

    $data = " accountNumber = '$accountNumber' ";
    $data .= ", email = '$email' ";
    $data .= ", contactNumber = '$contactNumber' ";
    $data .= ", role_name = '$role_name' ";
    $data .= ", address = '$address' ";

    // echo $data;

    $sql = $conn->query("UPDATE tbl_users SET $data WHERE user_id = $user_id");
    if ($conn->affected_rows >= 0) :

        $_SESSION['status'] = "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Done',
                    text: 'User updated successfully.'
                })
            </script>";
        header('location: ../pages/admin/index.php?page=user-list');
    endif;
}

if(isset($_POST['update_borrower'])) {
    extract($_POST);

    $data = "accountNumber = '$accountNumber'";
    $data .= ", email = '$email' ";
    $data .= ", contactNumber = '$contactNumber' ";
    $data .= ", address = '$address' ";

    $sql = $conn->query("UPDATE tbl_borrowers SET $data WHERE user_id = $user_id");
    if ($conn->affected_rows >= 0) :

        $_SESSION['status'] = "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Done',
                    text: 'Borrower updated successfully.'
                })
            </script>";
        header('location: ../pages/admin/index.php?page=borrower-list');
    endif;
}