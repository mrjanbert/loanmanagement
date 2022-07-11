<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>View Payments</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item">Loans</li>
                    <li class="breadcrumb-item active">Payments</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>


<?php
// $ref_no = $_GET['ref_no'];
// $query = $conn->query("SELECT * FROM tbl_transaction WHERE ref_no = $ref_no");
// $data = $query->fetch_array();
// $amount = $data['amount'];

// // $penalty = $monthly * ($penalty/100);
// $interest = 0.01;
// $total_interest = ($amount * ($interest)) * $months;
// $monthly = ($amount + $total_interest) / $months;

// $share_capital = 0.01 * $amount; 	//fixed capital for members only
// $service_charge = 0.01 * $amount; //fixed service charge
// $notarial_fee = 100; 	//fixed notarial fee

// $total_less = $share_capital + $service_charge + $notarial_fee;
// $net = $amount - ($share_capital + $service_charge + $notarial_fee);
?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Payment History</h3>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="d-flex justify-content-end">
                            <button onclick="history.back()" class="btn btn-warning btn-sm">
                                <i class="fas fa-arrow-alt-circle-left"></i> &nbsp;
                                Back
                            </button>
                        </div>
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="15%" class="text-center">Date</th>
                                    <th width="15%" class="text-center">Principal</th>
                                    <th class="text-center">Interest</th>
                                    <th class="text-center">Penalty</th>
                                    <th class="text-center">OR #</th>
                                    <th class="text-center">Payment</th>
                                    <th class="text-center">Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ref_no = $_GET['ref_no'];
                                
                                $query = $conn->query("SELECT * FROM tbl_transaction WHERE ref_no = $ref_no");
                                $row = $query->fetch_row();
                                    $loan_date = strtotime($row[13]);
                                    $loan_amount = $row[3];
                                    $total_interest = $row[6];
                                    $balance = $row[9];
                                
                                ?>
                                    <tr>
                                        <td style="font-weight: bold;"><?php echo date('F j, Y', $loan_date); ?></td>
                                        <td class="text-right" style="font-weight: bold;"><?php echo number_format($loan_amount, 2); ?></td>
                                        <td class="text-right" style="font-weight: bold;"><?php echo number_format($total_interest, 2); ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-right" style="font-weight: bold;"><?php echo number_format($balance, 2); ?></td>
                                    </tr>
                                <tr>

                                <?php
                                $loan = $conn->query("SELECT * FROM tbl_transaction WHERE ref_no in (SELECT ref_no FROM tbl_payments)");
                                while ($row = $loan->fetch_assoc()) {
                                    $loan_array[$row['ref_no']] = $row;
                                    $loan_amount = $loan_array[$row['ref_no']]['amount'];
                                    $loan_principal = $loan_array[$row['ref_no']]['principal'];
                                    $interest = $loan_array[$row['ref_no']]['interest'];
                                }
                                $query = $conn->query("SELECT * FROM tbl_payments WHERE ref_no = $ref_no ORDER BY id ASC");
                                while ($row = $query->fetch_assoc()) :
                                    $payment_date = strtotime($row['payment_date']);
                                    $payment_penalty = $row['penalty'];
                                    $payment_receipt = $row['receipt_no'];
                                    $payment_amount = $row['payment_amount'];
                                    $payment_balance = $row['balance'];
                                
                                ?>
                                    <td><?php echo date('F j, Y', $payment_date); ?></td>
                                    <td class="text-right"></td>
                                    <td class="text-right"></td>
                                    <td class="text-right"><?php echo number_format($payment_penalty, 2); ?></td>
                                    <td class="text-right"><?php echo $payment_receipt; ?></td>
                                    <td class="text-right"><?php echo number_format($payment_amount, 2); ?></td>
                                    <td class="text-right"><?php echo number_format($payment_balance, 2); ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section><!-- /.content -->