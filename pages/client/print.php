<?php
    require('../../assets/plugins/fpdf/fpdf.php');

    class PDF extends FPDF {
        // Page header
        function Header()
        {
            // Logo
            $this->Image('../../components/img/Header.png',2,2,206);
            $this->SetFont('Times','B',15);
            $this->Cell(80);
            $this->Cell(30,60,'NMSCST CREDIT COOPERATIVE',0,0,'C');
            $this->Ln(20);
            $this->SetFont('Courier', 'B', '17');
            $this->Cell(0,40,'APPLICATION FOR LOAN',0,0,'C');
        }
        // Page footer
        function Footer()
        {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Page number
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        }
    }

    // Instanciation of inherited class
    $pdf = new PDF();
    $pdf->SetTitle('Application For Loan - (ref_no) ');
    $pdf->AliasNbPages();
    $pdf->AddPage();

    $pdf->SetFont('Arial','B',14);
    $pdf->Ln(25);
    $pdf->Cell(0,0,'Customer\'s Copy',0,0,1);
    
    $pdf->Cell(100);
    $pdf->SetFont('Courier','',16);
    $pdf->Ln(10);
    $pdf->Cell(0,0,'Name',0,0,1);

    $pdf->Output();
