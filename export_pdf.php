<?php
require('fpdf.php');
include 'db.php';

$id = $_GET['id'] ?? 0;
$result = $conn->query("SELECT * FROM devices WHERE id = $id");
$device = $result->fetch_assoc();

if (!$device) {
    die("الجهاز غير موجود.");
}

$pdf = new FPDF();
$pdf->AddPage('P', 'A4');
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'بطاقة الجهاز الطبية', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);

foreach ($device as $key => $value) {
    $pdf->Cell(50, 10, iconv('UTF-8', 'windows-1256', $key), 0);
    $pdf->Cell(0, 10, iconv('UTF-8', 'windows-1256', $value), 0, 1);
}

$pdf->Output("I", "device_card_{$device['id']}.pdf");
