<?php 
    require_once 'data/Database.php';

    if (isset($_POST['submit'])) {
        extract($_POST);
        $ref_no = strtotime(date("h:i:sa"));

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

        $query1 = "INSERT INTO tbl_transaction SET " . $data;
        $result1 = $conn->query($query1);

        if ($conn->affected_rows > 0) :

            if($borrower_id == $comaker_id) {
                $query = $conn->query("INSERT INTO tbl_status SET ref_no = '$ref_no' , status_comaker = '1', comaker_dateprocess = now() ");
            } else {
                $query = $conn->query("INSERT INTO tbl_status SET ref_no = '$ref_no'");
            }
            session_start();
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
            $_SESSION['status']= "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed! Please try again.'
                })
            </script>";
            header('location: ../pages/client/index.php?page=view-loans');
        endif;

    }
?>