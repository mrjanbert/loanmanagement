<?php
require_once 'data/Database.php';
session_start();

if (isset($_GET['approveref_no'])) {

    $ref_no = $_GET['approveref_no'];

    $user = $conn->query("SELECT b.contactNumber, concat(b.firstName,' ',b.lastName) as borrower_name, concat(c.firstName,' ',c.lastName) as comaker_name FROM ((tbl_transaction t INNER JOIN tbl_borrowers b ON t.borrower_id = b.user_id) INNER JOIN tbl_comakers c ON t.comaker_id = c.user_id) WHERE t.ref_no = '$ref_no'");
    $fetch = $user->fetch_array();
    $borrower_name = $fetch['borrower_name'];
    $comaker_name = $fetch['comaker_name'];

    $sql = $conn->query("UPDATE tbl_status SET status_comaker = '1', comaker_dateprocess = now() WHERE ref_no = '$ref_no'");

    $url = "https://semysms.net/api/3/sms.php"; //Url address for sending SMS
    $phone = $fetch['contactNumber']; // Phone number
    $msg = 'FROM NMSCST LMS:' . PHP_EOL . $comaker_name . '(co-maker) approved your loan.' . PHP_EOL . 'Loan ref no.: ' . $ref_no . PHP_EOL . '(computer msg)';
    $device = '319799';  //  Device code
    $token = '16f034060c14278c0615d329f4d02643';  //  Your token (secret)

    $data = array(
        "phone" => $phone,
        "msg" => $msg,
        "device" => $device,
        "token" => $token
    );

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    $output = curl_exec($curl);
    curl_close($curl);

    // echo $msg;
    if ($output) {
        $addmsg = $conn->query("INSERT INTO tbl_smslogs SET contactNumber = '$phone', name = '$borrower_name', message = '$msg', date = now()");
    }

    $_SESSION['status'] = "<script>
    Swal.fire({
        icon: 'success',
        title: 'Done',
        text: 'Co-maker request approved'
    })
    </script>";
    header('location: ../pages/client/index.php?page=comakers');
}

if (isset($_GET['denyref_no'])) {

    $ref_no = $_GET['denyref_no'];

    $user = $conn->query("SELECT b.contactNumber, concat(b.firstName,' ',b.lastName) as borrower_name, concat(c.firstName,' ',c.lastName) as comaker_name FROM ((tbl_transaction t INNER JOIN tbl_borrowers b ON t.borrower_id = b.user_id) INNER JOIN tbl_comakers c ON t.comaker_id = c.user_id) WHERE t.ref_no = '$ref_no'");
    $fetch = $user->fetch_array();
    $borrower_name = $fetch['borrower_name'];
    $comaker_name = $fetch['comaker_name'];

    $sql = $conn->query("UPDATE tbl_status SET status_comaker = '2', comaker_dateprocess = now() WHERE ref_no = '$ref_no'");

    $url = "https://semysms.net/api/3/sms.php"; //Url address for sending SMS
    $phone = $fetch['contactNumber']; // Phone number
    $msg = 'FROM NMSCST LMS:' . PHP_EOL . $comaker_name . '(Co-maker) disapproved your loan.' . PHP_EOL . 'Loan ref no.: ' . $ref_no . PHP_EOL . '(computer msg)';
    $device = '319799';  //  Device code
    $token = '16f034060c14278c0615d329f4d02643';  //  Your token (secret)

    $data = array(
        "phone" => $phone,
        "msg" => $msg,
        "device" => $device,
        "token" => $token
    );

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    $output = curl_exec($curl);
    curl_close($curl);

    // echo $msg;
    if ($output) {
        $addmsg = $conn->query("INSERT INTO tbl_smslogs SET contactNumber = '$phone', name = '$borrower_name', message = '$msg', date = now()");
    }

    $_SESSION['status'] = "<script>
    Swal.fire({
        icon: 'success',
        title: 'Done',
        text: 'Co-maker request disapproved'
    })
    </script>";
    header('location: ../pages/client/index.php?page=comakers');
}

if (isset($_GET['approve_processor'])) {

    $ref_no = $_GET['approve_processor'];
    $aid = $_GET['aid'];

    $borrower = $conn->query("SELECT b.contactNumber, concat(b.firstName,' ',b.lastName) as borrower_name FROM tbl_transaction t INNER JOIN tbl_borrowers b ON t.borrower_id = b.user_id WHERE t.ref_no = '$ref_no'");
    $fetch = $borrower->fetch_array();
    $borrower_name = $fetch['borrower_name'];

    $user = $conn->query("SELECT concat(firstName,' ',lastName) as processor_name FROM tbl_users WHERE user_id = '$aid'");
    $row = $user->fetch_array();
    $processor_name = $row['processor_name'];

    $sql = $conn->query("UPDATE tbl_status SET status_processor = '1', processor_id = '$aid', processor_dateprocess = now() WHERE ref_no = '$ref_no'");

    $url = "https://semysms.net/api/3/sms.php"; //Url address for sending SMS
    $phone = $fetch['contactNumber']; // Phone number
    $msg = 'FROM NMSCST LMS:' . PHP_EOL . $processor_name . '(CC Member) checked and verified your loan. Please check your account now.' . PHP_EOL . 'Loan ref no.: ' . $ref_no . PHP_EOL . '(computer msg)';
    $device = '319799';  //  Device code
    $token = '16f034060c14278c0615d329f4d02643';  //  Your token (secret)

    $data = array(
        "phone" => $phone,
        "msg" => $msg,
        "device" => $device,
        "token" => $token
    );

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    $output = curl_exec($curl);
    curl_close($curl);

    // echo $msg;
    if ($output) {
        $addmsg = $conn->query("INSERT INTO tbl_smslogs SET contactNumber = '$phone', name = '$borrower_name', message = '$msg', date = now()");
    }

    $_SESSION['status'] = "<script>
    Swal.fire({
        icon: 'success',
        title: 'Done',
        text: 'Loan was checked and verified'
    })
    </script>";
    header('location: ../pages/admin/index.php?page=view-loans&uid=' . $_GET['uid']);
}

if (isset($_GET['disapprove_manager'])) {

    $ref_no = $_GET['disapprove_manager'];
    $aid = $_SESSION['adminuser_id'];

    $user = $conn->query("SELECT b.contactNumber, concat(b.firstName,' ',b.lastName) as borrower_name FROM tbl_transaction t INNER JOIN tbl_borrowers b ON t.borrower_id = b.user_id WHERE t.ref_no = '$ref_no'");
    $fetch = $user->fetch_array();
    $borrower_name = $fetch['borrower_name'];

    $user = $conn->query("SELECT concat(firstName,' ',lastName) as manager_name FROM tbl_users WHERE user_id = '$aid'");
    $row = $user->fetch_array();
    $manager_name = $row['manager_name'];

    $sql = $conn->query("UPDATE tbl_status SET manager_id = '$aid', status_manager = '3', manager_dateprocess = now() WHERE ref_no = '$ref_no'");

    $url = "https://semysms.net/api/3/sms.php"; //Url address for sending SMS
    $phone = $fetch['contactNumber']; // Phone number
    $msg = 'FROM NMSCST LMS:' . PHP_EOL . $manager_name .'(Manager) disapproved your loan. Please check your account now.' . PHP_EOL . 'Loan ref no.: ' . $ref_no . PHP_EOL . '(computer msg)';
    $device = '319799';  //  Device code
    $token = '16f034060c14278c0615d329f4d02643';  //  Your token (secret)

    $data = array(
        "phone" => $phone,
        "msg" => $msg,
        "device" => $device,
        "token" => $token
    );

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    $output = curl_exec($curl);
    curl_close($curl);

    // echo $msg;
    if ($output) {
        $addmsg = $conn->query("INSERT INTO tbl_smslogs SET contactNumber = '$phone', name = '$borrower_name', message = '$msg', date = now()");
    }

    $_SESSION['status'] = "<script>
    Swal.fire({
        icon: 'success',
        title: 'Done',
        text: 'Loan disapproved'
    })
    </script>";
    header('location: ../pages/admin/index.php?page=view-loans&uid=' . $_GET['uid']);
}

if (isset($_GET['approve_manager'])) {

    $ref_no = $_GET['approve_manager'];
    $aid = $_SESSION['adminuser_id'];

    $user = $conn->query("SELECT b.contactNumber, concat(b.firstName,' ',b.lastName) as borrower_name FROM tbl_transaction t INNER JOIN tbl_borrowers b ON t.borrower_id = b.user_id WHERE t.ref_no = '$ref_no'");
    $fetch = $user->fetch_array();
    $borrower_name = $fetch['borrower_name'];

    $user = $conn->query("SELECT concat(firstName,' ',lastName) as manager_name FROM tbl_users WHERE user_id = '$aid'");
    $row = $user->fetch_array();
    $manager_name = $row['manager_name'];

    $sql = $conn->query("UPDATE tbl_status SET manager_id = '$aid', status_manager = '1', manager_dateprocess = now() WHERE ref_no = '$ref_no'");

    $url = "https://semysms.net/api/3/sms.php"; //Url address for sending SMS
    $phone = $fetch['contactNumber']; // Phone number
    $msg = 'FROM NMSCST LMS:' . PHP_EOL . $manager_name . '(Manager) approved your loan. Please check your account now.' . PHP_EOL . 'Loan ref no.: ' . $ref_no . PHP_EOL . '(computer msg)';
    $device = '319799';  //  Device code
    $token = '16f034060c14278c0615d329f4d02643';  //  Your token (secret)

    $data = array(
        "phone" => $phone,
        "msg" => $msg,
        "device" => $device,
        "token" => $token
    );

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    $output = curl_exec($curl);
    curl_close($curl);

    // echo $msg;
    if ($output) {
        $addmsg = $conn->query("INSERT INTO tbl_smslogs SET contactNumber = '$phone', name = '$borrower_name', message = '$msg', date = now()");
    }

    $_SESSION['status'] = "<script>
    Swal.fire({
        icon: 'success',
        title: 'Done',
        text: 'Loan approved'
    })
    </script>";

    header('location: ../pages/admin/index.php?page=view-loans&uid=' . $_GET['uid']);
}

if (isset($_GET['disapprove_cashier'])) {

    $ref_no = $_GET['disapprove_cashier'];
    $aid = $_SESSION['adminuser_id'];

    $user = $conn->query("SELECT b.contactNumber, concat(b.firstName,' ',b.lastName) as borrower_name FROM tbl_transaction t INNER JOIN tbl_borrowers b ON t.borrower_id = b.user_id WHERE t.ref_no = '$ref_no'");
    $fetch = $user->fetch_array();
    $borrower_name = $fetch['borrower_name'];

    $user = $conn->query("SELECT concat(firstName,' ',lastName) as cashier_name FROM tbl_users WHERE user_id = '$aid'");
    $row = $user->fetch_array();
    $cashier_name = $row['cashier_name'];

    $sql = $conn->query("UPDATE tbl_status SET cashier_id = '$aid', status_cashier = '3', cashier_dateprocess = now() WHERE ref_no = '$ref_no'");

    $url = "https://semysms.net/api/3/sms.php"; //Url address for sending SMS
    $phone = $fetch['contactNumber']; // Phone number
    $msg = 'FROM NMSCST LMS:' . PHP_EOL . $cashier_name . '(Cashier) disapproved your loan. Please check your account now.' . PHP_EOL . 'Loan ref no.: ' . $ref_no . PHP_EOL . '(computer msg)';
    $device = '319799';  //  Device code
    $token = '16f034060c14278c0615d329f4d02643';  //  Your token (secret)

    $data = array(
        "phone" => $phone,
        "msg" => $msg,
        "device" => $device,
        "token" => $token
    );

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    $output = curl_exec($curl);
    curl_close($curl);

    // echo $msg;
    if ($output) {
        $addmsg = $conn->query("INSERT INTO tbl_smslogs SET contactNumber = '$phone', name = '$borrower_name', message = '$msg', date = now()");
    }

    $_SESSION['status'] = "<script>
    Swal.fire({
        icon: 'success',
        title: 'Done',
        text: 'Loan disapproved'
    })
    </script>";
    header('location: ../pages/admin/index.php?page=view-loans&uid=' . $_GET['uid']);
}


if (isset($_GET['approve_cashier'])) {
    $ref_no = $_GET['approve_cashier'];
    $aid = $_GET['aid'];
    $sql = $conn->query("UPDATE tbl_status SET cashier_id = '$aid', status_cashier = '2', cashier_dateprocess = now() WHERE ref_no = '$ref_no'");

    $user = $conn->query("SELECT b.contactNumber, concat(b.firstName,' ',b.lastName) as borrower_name FROM tbl_transaction t INNER JOIN tbl_borrowers b ON t.borrower_id = b.user_id WHERE t.ref_no = '$ref_no'");
    $fetch = $user->fetch_array();
    $borrower_name = $fetch['borrower_name'];

    $user = $conn->query("SELECT concat(firstName,' ',lastName) as cashier_name FROM tbl_users WHERE user_id = '$aid'");
    $row = $user->fetch_array();
    $cashier_name = $row['cashier_name'];

    if($sql) {
        $checkmonth = $conn->query("SELECT loan_term, monthly FROM tbl_transaction WHERE ref_no = '$ref_no'");
        $data = $checkmonth->fetch_assoc();
        $monthly = $data['monthly'];
        $months = $data['loan_term'];

        $start_date = strtotime(date('Y-m-d'));
        $end_date = strtotime(date('Y-m-d', strtotime(' + ' . $months . ' months')));

        $insert = "INSERT INTO tbl_monthlynotif (loan_ref,monthly, month_date) values ";
        for ($i = 2592000 + $start_date; $i <= $end_date; $i = $i + 2592000) { //? 2592000 seconds equiv to 1 month
            $monthly_date = date('Y-m-d', $i);
            $insert .= " ('$ref_no', '$monthly', '$monthly_date'),";
        }
        $bulk_insert_query = rtrim($insert, ","); // to remove last comma
        $resultinsert = $conn->query($bulk_insert_query);

        if($resultinsert) {

            $loan = $conn->query("SELECT t.amount, b.membership, t.borrower_id FROM tbl_transaction t INNER JOIN tbl_borrowers b ON t.borrower_id = b.user_id WHERE t.ref_no = '$ref_no'");
            $loandata = $loan->fetch_assoc();
            $borrower_id = $loandata['borrower_id'];
            $amount = $loandata['amount'];
            $membership = $loandata['membership'];
            
            if ($membership == 1) {
                $share_capital = 0.01 * $amount;     //for members only
            } else {
                $share_capital = 0;
            }

            $check = $conn->query("SELECT share_capital FROM tbl_totalshares WHERE borrower_id = '$borrower_id' ORDER BY id DESC");
            $datashare = $check->fetch_array();
            if($check->num_rows > 0) {
                $share = $datashare['share_capital'];
                $total = $share + $share_capital;
                $updateshare = $conn->query("UPDATE tbl_totalshares SET borrower_id = '$borrower_id', share_capital = '$total', date_modified = now() WHERE borrower_id = '$borrower_id'");
            } else {
                $total = $share_capital;
                $addshare = $conn->query("INSERT INTO tbl_totalshares SET borrower_id = '$borrower_id', share_capital = '$total', date_modified = now()");
            }

            $data = " borrower_id = '$borrower_id'";
            $data .= ", description = 'Loan'";
            $data .= ", deposit = '$share_capital'";
            $data .= ", balance = '$total'";

            $insert = "INSERT INTO tbl_sharecapital SET " . $data;
            $result = $conn->query($insert);
        }
    }

    $url = "https://semysms.net/api/3/sms.php"; //Url address for sending SMS
    $phone = $fetch['contactNumber']; // Phone number
    $msg = 'FROM NMSCST LMS:' . PHP_EOL . $cashier_name . '(Cashier) released your loan. ' . PHP_EOL .' Please check your account now.' . PHP_EOL . 'Loan ref no.: ' . $ref_no . PHP_EOL . '(computer msg)';
    $device = '319799';  //  Device code
    $token = '16f034060c14278c0615d329f4d02643';  //  Your token (secret)

    $data = array(
        "phone" => $phone,
        "msg" => $msg,
        "device" => $device,
        "token" => $token
    );

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    $output = curl_exec($curl);
    curl_close($curl);

    // echo $msg;
    if ($output) {
        $addmsg = $conn->query("INSERT INTO tbl_smslogs SET contactNumber = '$phone', name = '$borrower_name', message = '$msg', date = now()");
    }

    $_SESSION['status'] = "<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Loan released.'
    })
    </script>";
    header('location: ../pages/admin/index.php?page=view-loans&uid=' . $_GET['uid']);
}
