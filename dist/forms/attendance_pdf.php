<?php
require('fpdf.php');
require('connection.php');

if (!isset($_GET['id'])) {
    die('Attendance ID not provided.');
}

$id = intval($_GET['id']);

// Fetch attendance row from DB
$sql = "SELECT id, batch_id, student_id, date, status, remarks FROM attendance WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die('Attendance record not found.');
}

$row = $result->fetch_assoc();

// Start PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Title
$pdf->Cell(0, 10, 'Attendance Details (ID: ' . $row['id'] . ')', 0, 1, 'C');
$pdf->Ln(10);

// Set font for content
$pdf->SetFont('Arial', '', 12);

// Output fields
$pdf->Cell(50, 10, 'Batch ID:', 0, 0);
$pdf->Cell(0, 10, $row['batch_id'], 0, 1);

$pdf->Cell(50, 10, 'Student ID:', 0, 0);
$pdf->Cell(0, 10, $row['student_id'], 0, 1);

$pdf->Cell(50, 10, 'Date:', 0, 0);
$pdf->Cell(0, 10, $row['date'], 0, 1);

$pdf->Cell(50, 10, 'Status:', 0, 0);
$pdf->Cell(0, 10, $row['status'], 0, 1);

$pdf->Cell(50, 10, 'Remarks:', 0, 0);
$pdf->MultiCell(0, 10, $row['remarks']);

// Output PDF
$pdf->Output('D', 'attendance_' . $row['id'] . '.pdf');
exit;
?>
