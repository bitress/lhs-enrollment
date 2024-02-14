<?php
require('fpdf/fpdf.php');

class PDF extends FPDF {
    function AddCheckSymbol() {
        // Use the Arial font
        $this->SetFont('Arial', '', 14);

        // Write the check symbol to the PDF
        $this->Write(5, utf8_decode(''));
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(40, 10, 'Check symbol: ', 0, 0);
$pdf->AddCheckSymbol();
$pdf->Output();
?>