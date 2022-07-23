<?php
require_once 'data/Database.php';

if (isset($_GET['approveref_no'])) {

    $ref_no = $_GET['approveref_no'];
    $sql = $conn->query("UPDATE tbl_status SET status_comaker = '1' WHERE ref_no = '$ref_no'");

    session_start();
    $_SESSION['status'] = "<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Loan Approoved'
    })
    </script>";
    header('location: ../pages/client/index.php?page=dashboard');
}

if (isset($_GET['denyref_no'])) {

    $ref_no = $_GET['denyref_no'];
    $sql = $conn->query("UPDATE tbl_status SET status_comaker = '2' WHERE ref_no = '$ref_no'");

    session_start();
    $_SESSION['status'] = "<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Loan Disapproved'
    })
    </script>";
    header('location: ../pages/client/index.php?page=dashboard');
}

if (isset($_GET['approve_processor'])) {

    $ref_no = $_GET['approve_processor'];
    $sql = $conn->query("UPDATE tbl_status SET status_processor = '1' WHERE ref_no = '$ref_no'");

    session_start();
    $_SESSION['status'] = "<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Loan Approved'
    })
    </script>";
    header('location: ../pages/admin/index.php?page=view-loans&uid=' . $_GET['uid'] . '&usr=' . base64_encode($_SESSION['role_name']));
}

if (isset($_GET['disapprove_manager'])) {

    $ref_no = $_GET['disapprove_manager'];
    $sql = $conn->query("UPDATE tbl_status SET status_manager = '3' WHERE ref_no = '$ref_no'");

    session_start();
    $_SESSION['status'] = "<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Loan Disapproved'
    })
    </script>";
    header('location: ../pages/admin/index.php?page=view-loans&uid=' . $_GET['uid'] . '&usr=' . base64_encode($_SESSION['role_name']));
}

if (isset($_GET['approve_manager'])) {

    $ref_no = $_GET['approve_manager'];
    $sql = $conn->query("UPDATE tbl_status SET status_manager = '1' WHERE ref_no = '$ref_no'");

    session_start();
    $_SESSION['status'] = "<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Loan Approved'
    })
    </script>";
    header('location: ../pages/admin/index.php?page=view-loans&uid=' . $_GET['uid'] . '&usr=' . base64_encode($_SESSION['role_name']));
}

if (isset($_GET['disapprove_cashier'])) {

    $ref_no = $_GET['disapprove_cashier'];
    $sql = $conn->query("UPDATE tbl_status SET status_cashier = '3' WHERE ref_no = '$ref_no'");

    session_start();
    $_SESSION['status'] = "<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Loan Disapproved'
    })
    </script>";
    header('location: ../pages/admin/index.php?page=view-loans&uid=' . $_GET['uid'] . '&usr=' . base64_encode($_SESSION['role_name']));
}

if (isset($_GET['release_cashier'])) {
    $ref_no = $_GET['release_cashier'];
    $sql = $conn->query("UPDATE tbl_status SET status_cashier = '2' WHERE ref_no = '$ref_no'");

    session_start();
    $_SESSION['status'] = "<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Cash Released'
    })
    </script>";
    header('location: ../pages/admin/index.php?page=view-loans&uid=' . $_GET['uid'] . '&usr=' . base64_encode($_SESSION['role_name']));
}

if (isset($_GET['approve_cashier'])) {
    $ref_no = $_GET['approve_cashier'];
    $sql = $conn->query("UPDATE tbl_status SET status_cashier = '1' WHERE ref_no = '$ref_no'");

    session_start();
    $_SESSION['status'] = "<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Loan Approved'
    })
    </script>";
    header('location: ../pages/admin/index.php?page=view-loans&uid=' . $_GET['uid'] . '&usr=' . base64_encode($_SESSION['role_name']));
}
