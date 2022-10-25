<?php 
    session_start();
    require_once 'data/Database.php';

    if (isset($_POST['submit'])) {
        extract($_POST);
        $ref_no = strtotime(date("F j, Y h:i:sa"));

        $interest_rate = 1;
        $total_interest = ($amount * ($interest_rate / 100)) * $loan_term;
        $interest = $total_interest / $loan_term;
        $monthly = ($amount + $total_interest) / $loan_term;
        $balance = $monthly * $loan_term;
        $principal = $monthly - ($total_interest / $loan_term);

        if($comaker_id == '') {
            $comaker_id = $borrower_id;
        }

        $data = " ref_no = '$ref_no' ";
        $data .= ", borrower_id = '$borrower_id' ";
        $data .= ", status_ref = '$ref_no' ";
        $data .= ", amount = '$amount' ";
        $data .= ", loan_term = '$loan_term' ";
        $data .= ", interest = '$interest' ";
        $data .= ", total_interest = '$total_interest' ";
        $data .= ", monthly = '$monthly' ";
        $data .= ", principal = '$principal' ";
        $data .= ", balance = '$balance' ";
        $data .= ", loan_type = '$loan_type' ";
        $data .= ", purpose = '$purpose' ";
        $data .= ", comaker_id = '$comaker_id' ";

        // echo $data;

        $query1 = "INSERT INTO tbl_transaction SET " . $data;
        $result1 = $conn->query($query1);

        if ($conn->affected_rows > 0) :

            if($borrower_id == $comaker_id) {
                $query = $conn->query("INSERT INTO tbl_status SET ref_no = '$ref_no' , status_comaker = '1', comaker_dateprocess = now() ");
            } else {
                $query = $conn->query("INSERT INTO tbl_status SET ref_no = '$ref_no'");

                $nameofborrower = $conn->query("SELECT * FROM tbl_borrowers WHERE user_id = '$borrower_id'");
                $borrower = $nameofborrower->fetch_assoc();

                $sendtocomaker = $conn->query("SELECT * FROM tbl_borrowers WHERE user_id = '$comaker_id'");
                $row = $sendtocomaker->fetch_assoc();
                $comaker_name = $row['firstName'] . ' ' . $row['lastName'];

                $url = "https://semysms.net/api/3/sms.php"; //Url address for sending SMS
                $phone = $row['contactNumber']; // Phone number
                $msg = 'FROM NMSCST LMS: ' . PHP_EOL . $borrower['firstName'] . ' ' . $borrower['lastName'] . ' has new loan application and added you (' . $comaker_name . ') as a Co-Maker.' . PHP_EOL . 'Please check your account now. (computer msg)';
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
                    $addmsg = $conn->query("INSERT INTO tbl_smslogs SET contactNumber = '$phone', name = '$comaker_name', message = '$msg', date = now()");
                }
            }
            $_SESSION['status']= "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Loan Success!'
                })
            </script>";
            header('location: ../pages/client/index.php?page=view-loans');
        else :
            session_start();
            $_SESSION['status'] = "<script>
            Swal.fire({
                icon: 'error',
                title: 'Failed',
                text: 'Loan Not Added'
            })
            </script>";
            header('location: ../pages/client/index.php?page=view-loans');
        endif;

    }
