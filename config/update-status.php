<?php
require_once 'data/Database.php';

if (isset($_GET['approveref_no'])) {

    $ref_no = $_GET['approveref_no'];
    $sql = $conn->query("UPDATE tbl_status SET status_comaker = '1', comaker_dateprocess = now() WHERE ref_no = '$ref_no'");

    session_start();
    $_SESSION['status'] = "<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Loan Approved'
    })
    </script>";
    header('location: ../pages/client/index.php?page=dashboard');
}

if (isset($_GET['denyref_no'])) {

    $ref_no = $_GET['denyref_no'];
    $sql = $conn->query("UPDATE tbl_status SET status_comaker = '2', comaker_dateprocess = now() WHERE ref_no = '$ref_no'");

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
    $aid = $_GET['aid'];
    $sql = $conn->query("UPDATE tbl_status SET status_processor = '1', processor_id = '$aid', processor_dateprocess = now() WHERE ref_no = '$ref_no'");

    session_start();
    $_SESSION['status'] = "<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Loan Approved'
    })
    </script>";
    header('location: ../pages/admin/index.php?page=view-loans&uid=' . $_GET['uid']);
}

if (isset($_GET['disapprove_manager'])) {

    $ref_no = $_GET['disapprove_manager'];
    $sql = $conn->query("UPDATE tbl_status SET status_manager = '3', manager_dateprocess = now() WHERE ref_no = '$ref_no'");

    session_start();
    $_SESSION['status'] = "<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Loan Disapproved'
    })
    </script>";
    header('location: ../pages/admin/index.php?page=view-loans&uid=' . $_GET['uid']);
}

if (isset($_GET['approve_manager'])) {

    $ref_no = $_GET['approve_manager'];
    $sql = $conn->query("UPDATE tbl_status SET status_manager = '1', manager_dateprocess = now() WHERE ref_no = '$ref_no'");

    session_start();
    $_SESSION['status'] = "<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Loan Approved'
    })
    </script>";
    header('location: ../pages/admin/index.php?page=view-loans&uid=' . $_GET['uid']);
}

if (isset($_GET['disapprove_cashier'])) {

    $ref_no = $_GET['disapprove_cashier'];
    $sql = $conn->query("UPDATE tbl_status SET status_cashier = '3', cashier_dateprocess = now() WHERE ref_no = '$ref_no'");

    session_start();
    $_SESSION['status'] = "<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Loan Disapproved'
    })
    </script>";
    header('location: ../pages/admin/index.php?page=view-loans&uid=' . $_GET['uid']);
}

if (isset($_GET['release_cashier'])) {
    $ref_no = $_GET['release_cashier'];
    $sql = $conn->query("UPDATE tbl_status SET status_cashier = '2', cashier_dateprocess = now() WHERE ref_no = '$ref_no'");

    session_start();
    $_SESSION['status'] = "<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Cash Released'
    })
    </script>";
    header('location: ../pages/admin/index.php?page=view-loans&uid=' . $_GET['uid']);
}

if (isset($_GET['approve_cashier'])) {
    $ref_no = $_GET['approve_cashier'];
    $sql = $conn->query("UPDATE tbl_status SET status_cashier = '2', cashier_dateprocess = now() WHERE ref_no = '$ref_no'");

    if($sql) {
        $checkmonth = $conn->query("SELECT loan_term FROM tbl_transaction WHERE ref_no = '$ref_no'");
        $data = $checkmonth->fetch_assoc();
        $months = $data['loan_term'];

        $start_date = strtotime(date('Y-m-d'));
        $end_date = strtotime(date('Y-m-d', strtotime(' + ' . $months . ' months')));

        $insert = "INSERT INTO tbl_monthlynotif (loan_ref, month_date) values ";
        for ($i = 2592000 + $start_date; $i < $end_date; $i = $i + 2592000) { //? 2592000 seconds equiv to 1 month
            $monthly_date = date('Y-m-d', $i);
            $insert .= " ('$ref_no', '$monthly_date'),";
        }
        $bulk_insert_query = rtrim($insert, ","); // to remove last comma
        $resultinsert = $conn->query($bulk_insert_query);
    }
    
    session_start();
    $_SESSION['status'] = "<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Loan Approved'
    })
    </script>";
    header('location: ../pages/admin/index.php?page=view-loans&uid=' . $_GET['uid']);
}
