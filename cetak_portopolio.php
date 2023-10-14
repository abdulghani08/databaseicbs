<?php
session_start();
include "connection.php";
require_once('tcpdf/tcpdf.php'); 

$nis = $_GET['nis'];
$nama = $_GET['nama'];

class MyPDF extends TCPDF {
    public function Header() {
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(0, 10, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln(20);
    }

    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
    }
}

$pdf = new MyPDF();
$pdf->SetAutoPageBreak(TRUE, 10);
$pdf->AddPage();

ob_start(); // Start buffering HTML content

// Include your existing HTML content here
include "update_portopolio.php";

$html = ob_get_clean(); // Get the buffered HTML content

// Modify the entire page background color and text color to white using CSS
$html = '<style>
    body {
        background-color: white;
        color: white;
    }
</style>' . $html;

$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Output('cetak_portopolio.pdf', 'D');
?>
