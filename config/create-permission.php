<?php 
    require_once 'data/Database.php';

    if (isset($_GET['selected_user'])) {
        $user_id = $_GET['selected_user'];
        $role_name = $_GET['role_name'];
    
        $check = $conn->query("SELECT '$user_id' FROM tbl_users WHERE role_name = '$role_name'");
        if ($check->num_rows > 0) {
            echo 'permission already exist';
            header('location: ../pages/admin/index.php?page=user-roles');
        } else {
            echo 'execute update';
            $update = "UPDATE tbl_users SET role_name  = '$role_name' WHERE user_id = '$user_id'";
            $results = $conn->query($update);
            if ($conn->affected_rows > 0) {
                header('location: ../pages/admin/index.php?page=user-roles');
            }
        }

        
    }