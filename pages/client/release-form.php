<?php
require_once('../../assets/fpdf/fpdf.php');
include_once('../../config/data/Database.php');

$ref_no = $_GET['ref_no'];

$query = $conn->query("SELECT 
    t.amount, t.monthly, t.loan_term, s.cashier_dateprocess, s.status_cashier, b.membership, 
    b.firstName, b.middleName, b.lastName, concat(u.firstName,' ',u.lastName) as cashier_name 
  FROM (((tbl_transaction t 
    INNER JOIN tbl_status s ON s.ref_no = t.ref_no) 
    LEFT JOIN tbl_users u ON u.user_id = s.cashier_id) 
    INNER JOIN tbl_borrowers b ON b.user_id = t.borrower_id) 
  WHERE t.ref_no = '$ref_no'");
$row = $query->fetch_assoc();

$amount = $row['amount'];
$date_release = $row['cashier_dateprocess'];
$loan_term = $row['loan_term'];
$monthly = $row['monthly'];
$membership = $row['membership'];
$borrower_name = $row['firstName'] . ' ' . $row['middleName'][0] . '. ' . $row['lastName'];
$cashier_name = $row['cashier_name'];
$status_cashier = $row['status_cashier'];

if ($membership == 1) :
  $share_capital = 0.01 * $amount;   //fixed capital for members only
  $service_charge = 0.01 * $amount; //fixed service charge
  $notarial_fee = 100;   //fixed notarial fee

  $total_less = $share_capital + $service_charge + $notarial_fee;
  $net = $amount - $total_less;
elseif ($membership == 0) :
  $service_charge = 0.01 * $amount; //fixed service charge
  $notarial_fee = 100;   //fixed notarial fee

  $total_less = $service_charge + $notarial_fee;
  $net = $amount - $total_less;
endif;

if ($status_cashier == 2) {

  //! Does not support Folio size '8.5x13'
  $pdf = new FPDF('P', 'in', 'Letter');

  $pdf->SetTitle('Loan Release Form');

  //* Add one page
  $pdf->AddPage();

  $pdf->AddFont('Bahnschrift', '', 'BAHNSCHRIFT.php'); //Regular
  $pdf->AddFont('Bahnschrift', 'B', 'BAHNSCHRIFT.php'); //Regular
  //* Add image as background (z-index: -1)
  $pdf->Image('../../assets/images/release-form-customer.jpg', 0.2, 0.2, 8.1);

  //? Loan Information
  //TODO Set values to the body
  $pdf->SetFont('Bahnschrift', '', 10);
  $pdf->Ln(0);
  $pdf->Cell(0, 4.1, '                                                                                                                       ' . $ref_no);
  $pdf->Ln(0);
  $pdf->Cell(0, 4.49, '                                                                                                                       ' . strtoupper($borrower_name));
  $pdf->Ln(0);
  $pdf->Cell(0, 4.83, '                                                                                                                       ' . number_format($amount, 2));
  $pdf->Ln(0);
  $pdf->Cell(0, 5.17, '                                                                                                                       ' . strtoupper(date("F j, Y", strtotime($date_release))));
  $pdf->Ln(0);
  $pdf->Cell(0, 5.52, '                                                                                                                       ' . number_format($monthly, 2));
  $pdf->Ln(0);
  $pdf->Cell(0, 5.9, '                                                                                                                       ' . $loan_term);
  $pdf->Ln(0);
  $pdf->Cell(0, 6.25, '                                                                                                                       1%');
  if ($membership == 1) {
    $pdf->Ln(0);
    $pdf->Cell(0, 7.27, '                                                                                                                                                                                                          ' . number_format($share_capital, 2));
  }
  $pdf->Ln(0);
  $pdf->Cell(0, 7.65, '                                                                                                                                                                                                          ' . number_format($service_charge, 2));
  $pdf->Ln(0);
  $pdf->Cell(0, 8, '                                                                                                                                                                                                          ' . number_format($notarial_fee, 2));

  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Ln(0);
  $pdf->Cell(0, 8.3, '                                                                                                                            ' . number_format($total_less, 2));

  $pdf->SetFont('Bahnschrift', '', 10);
  $pdf->Ln(0);
  $pdf->Cell(0, 9.05, '                                                                                                                                                                                                          ' . number_format($net, 2));

  $pdf->SetFont('Bahnschrift', 'B', 10);
  $pdf->Ln(1);
  $pdf->Cell(0, 8.81, '                                                                                                                                                                                                         ' . strtoupper($borrower_name));
  $pdf->Ln(0);
  $pdf->Cell(0, 8.81, '                                                                                                                   ' . strtoupper($cashier_name));

  $searchadmin = $conn->query("SELECT firstName, middleName, lastName FROM tbl_users WHERE role_name = 'Admin' LIMIT 1");
  $data = $searchadmin->fetch_assoc();
  $admin_name = $data['firstName'] . ' ' . $data['middleName'][0] . '. ' . $data['lastName'];

  // $pdf->Ln(0);
  // $pdf->Cell(0, 8.81, '                               ' . strtoupper($admin_name));


  $pdf->Output();
}
