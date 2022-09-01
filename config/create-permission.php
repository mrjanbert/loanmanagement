<?php
require_once 'data/Database.php';
session_start();

if (isset($_POST['submit'])) {
    extract($_POST);

    // $checkrole = $conn->query("SELECT '$selected_user' FROM tbl_users WHERE role_name = '$role_name'");

    // if ($checkrole->num_rows == null) :
    $update = "UPDATE tbl_users SET role_name  = '$role_name' WHERE user_id = '$selected_user'";
    $results = $conn->query($update);
    if ($conn->affected_rows > 0) :
        $_SESSION['status'] = "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Done',
                    text: 'User role updated.'
                })
            </script>";
        header('location: ../pages/admin/index.php?page=user-roles');
    else :
        $_SESSION['status'] = "<script>const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        })
        Toast.fire({
            icon: 'info',
            title: 'No changes made.'
        })</script>";
        header('location: ../pages/admin/index.php?page=user-roles');
    endif;

    // elseif ($checkrole->num_rows > 0 ) :
    //     $_SESSION['status']= "<script>
    //         Swal.fire({
    //             icon: 'error',
    //             title: 'Error.',
    //             text: 'Role is already owned.'
    //         })
    //     </script>";
    //     header('location: ../pages/admin/index.php?page=user-roles&usr='. ($_SESSION['role_name']));

    // $checkname = $conn->query("SELECT '$selected_user' FROM tbl_users WHERE user_id = '$selected_user' AND  role_name = '$role_name'");
    // elseif ($checkname->num_rows > 0) :
    //     $_SESSION['status']= "<script>
    //         Swal.fire({
    //             icon: 'error',
    //             title: 'Error.',
    //             text: 'User already owned a role.'
    //         })
    //     </script>";
    //     header('location: ../pages/admin/index.php?page=user-roles&usr='. ($_SESSION['role_name']));
    // endif;
}
