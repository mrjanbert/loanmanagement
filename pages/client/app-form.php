<?php
require_once('../../assets/fpdf/fpdf.php');
include_once('../../config/data/Database.php');

$ref_no = $_GET['ref_no'];
$query = $conn->query("SELECT 
  t.*, concat(c.firstName,' ',c.lastName) AS comaker_name, 
  b.*, concat(b.firstName,' ',b.lastName) as borrower_name,
  s.*, concat(u.firstName,' ',u.lastName) as user_name
    FROM ((((tbl_transaction t 
  INNER JOIN tbl_status s ON s.ref_no = t.ref_no)
  LEFT JOIN tbl_users u ON s.processor_id = u.user_id)
  INNER JOIN tbl_borrowers b ON b.user_id = t.borrower_id)
  INNER JOIN tbl_comakers c ON  c.user_id = t.comaker_id)
    WHERE t.ref_no = $ref_no");

  $row = $query->fetch_assoc();
  $comaker_name = $row['comaker_name'];
  $user_name = $row['user_name'];
  $borrower_name = $row['borrower_name'];
  $borrower_contactNumber = $row['contactNumber'];
  $borrower_address = $row['address'];
  $borrower_email = $row['email'];
  $loan_type = $row['loan_type'];
  $purpose = $row['purpose'];
  $borrower_birthDate = strtotime($row['birthDate']);
  $membership = $row['membership'];
  $amount = $row['amount'];
  $months = $row['loan_term'];
  $monthly = $row['monthly'];
  $loan_date = strtotime($row['loan_date']);

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

//* Set Page as portrait 'P', inches 'in', legal size 'Legal'
//! Does not support Folio size '8.5x13'
$pdf = new FPDF('P', 'in', 'Legal');

$pdf->SetTitle('Application Form For Loan');

//* Add one page
$pdf->AddPage();

//* Add image as background (z-index: -1)
$pdf->Image('../../assets/images/application-form-for-loan-new.jpg',0.2,0.2,8.1);

//? Loan Information
//TODO Set values to the body
$pdf->SetFont('Courier', 'B', 11);
$pdf->Ln(0);
$pdf->Cell(0, 3.4, '                      '.$borrower_name);
$pdf->Ln(0);
$pdf->Cell(0, 3.4, '                                                                        '. date('M j, Y', $loan_date));
$pdf->Ln(0);
$pdf->Cell(0,3.78,'             '.$borrower_address);
$pdf->Ln(0);
$pdf->Cell(0, 3.78, '                                                                '. date('F j, Y', $borrower_birthDate));
$pdf->Ln(0);
$pdf->Cell(0,4.15,'                    '. $borrower_contactNumber);
$pdf->Ln(0);
$pdf->Cell(0, 4.15, '                                                           '. $borrower_email);
$pdf->Ln(0);
$pdf->Cell(0,4.49,'                  '. $loan_type);
$pdf->Ln(0);
$pdf->Cell(0, 4.49, '                                                    '. number_format($amount, 2));
$pdf->Ln(0);
$pdf->Cell(0,4.87, '             '.$purpose);
$pdf->SetFont('Courier', 'B', 12);
$pdf->SetFont('Courier', 'B', 11);
if($months == '3') {
  $pdf->Ln(0);
  $pdf->Cell(0, 6.60, '            /');
} elseif($months == '6') {
  $pdf->Ln(0);
  $pdf->Cell(0, 6.60, '                           /');
} elseif ( $months == '12') {
  $pdf->Ln(0);
  $pdf->Cell(0, 6.60, '                                                /');
} else {
  $pdf->Ln(0);
  $pdf->Cell(0, 6.65, '                                                                         '. $months .' Month/s');
}
//? Borrower's Information
$pdf->Ln(0);
$pdf->Cell(0,8.1,'                                                         '. number_format($amount, 2));
$pdf->Ln(0);
$pdf->Cell(0, 10.1, '                                              '. strtoupper($borrower_name));

//? Comaker's Information
$pdf->Ln(5);
// $pdf->Cell(0,4.1, '                                                     '. $comaker_name);
// $pdf->Ln(0);
// $pdf->Cell(0, 5.2,'                                                   ????, ???? ???');
// $pdf->Ln(0);
// $pdf->Cell(0, 5.9, '                           ???');


if ($membership == 1) :
  $share_capital = 0.01 * $amount;   //fixed capital for members only
  $service_charge = 0.01 * $amount; //fixed service charge
  $notarial_fee = 100;   //fixed notarial fee

  $total_less = $share_capital + $service_charge + $notarial_fee;
  $net = $amount - ($share_capital + $service_charge + $notarial_fee);
elseif ($membership == 0) :
  $service_charge = 0.01 * $amount; //fixed service charge
  $notarial_fee = 100;   //fixed notarial fee

  $total_less = $service_charge + $notarial_fee;
  $net = $amount - $total_less;
endif;

  //? Computation Information (Member)
$pdf->Ln(3);
$pdf->Cell(0, 1.1,'                               '. number_format($amount, 2));
$pdf->Ln(0);
$pdf->Cell(0, 1.1, '                                                    ' . $months . ' Month/s');
$pdf->Ln(0.28);
if ($membership == 1) :
  $pdf->Cell(0, 1.30,'                      '. number_format($share_capital, 2));
endif;
// $pdf->Ln(0);
// $pdf->Cell(0, 1.30, '                                                      '. number_format($monthly, 2));
$pdf->Ln(0);
$pdf->Cell(0, 1.68, '                      '. number_format($notarial_fee, 2));
$pdf->Ln(0);
$pdf->Cell(0, 2.03, '                        '. number_format($service_charge, 2));
$pdf->Ln(0);
$pdf->Cell(0, 2.03, '                               ' . number_format($total_less, 2));
$pdf->Ln(0);
$pdf->Cell(0,2.84, '                           '. number_format($net, 2));
$pdf->Ln(0);
$pdf->Ln(0);
$pdf->Cell(0,3.57,'                                                      '. strtoupper($user_name));
$pdf->Output();
