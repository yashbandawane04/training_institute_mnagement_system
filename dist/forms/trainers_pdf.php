<?php
require('fpdf.php');
require('connection.php');

if (!isset($_GET['id'])) {
    die('Trainer ID not provided.');
}

$id = intval($_GET['id']);

// Fetch trainer row from DB
$sql = "SELECT id, full_name, email, phone, qualification, specialization, joining_date, status FROM trainers WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die('Trainer not found.');
}

$row = $result->fetch_assoc();

// Create PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Title
$pdf->Cell(0, 10, 'Trainer Details (ID: ' . $row['id'] . ')', 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', '', 12);

// Output fields
$pdf->Cell(50, 10, 'Full Name:', 0, 0);
$pdf->Cell(0, 10, $row['full_name'], 0, 1);

$pdf->Cell(50, 10, 'Email:', 0, 0);
$pdf->Cell(0, 10, $row['email'], 0, 1);

$pdf->Cell(50, 10, 'Phone:', 0, 0);
$pdf->Cell(0, 10, $row['phone'], 0, 1);

$pdf->Cell(50, 10, 'Qualification:', 0, 0);
$pdf->Cell(0, 10, $row['qualification'], 0, 1);

$pdf->Cell(50, 10, 'Specialization:', 0, 0);
$pdf->Cell(0, 10, $row['specialization'], 0, 1);

$pdf->Cell(50, 10, 'Joining Date:', 0, 0);
$pdf->Cell(0, 10, $row['joining_date'], 0, 1);

$pdf->Cell(50, 10, 'Status:', 0, 0);
$pdf->Cell(0, 10, $row['status'], 0, 1);

// Output PDF
$pdf->Output('D', 'trainer_' . $id . '.pdf');
exit;
?>
