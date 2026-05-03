<?php
require('fpdf.php');
require('connection.php');

if (!isset($_GET['id'])) {
    die('Payment ID not provided.');
}

$id = intval($_GET['id']);

// Fetch payment record from DB
$sql = "SELECT id, amount_paid, total_fees, due_amount, payment_method, payment_date, transaction_id, student_id, amount FROM payments WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die('Payment record not found.');
}

$row = $result->fetch_assoc();

// Start PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Title
$pdf->Cell(0, 10, 'Payment Details (ID: ' . $row['id'] . ')', 0, 1, 'C');
$pdf->Ln(10);

// Set font for content
$pdf->SetFont('Arial', '', 12);

// Output fields
$pdf->Cell(50, 10, 'Amount Paid:', 0, 0);
$pdf->Cell(0, 10, $row['amount_paid'], 0, 1);

$pdf->Cell(50, 10, 'Total Fees:', 0, 0);
$pdf->Cell(0, 10, $row['total_fees'], 0, 1);

$pdf->Cell(50, 10, 'Due Amount:', 0, 0);
$pdf->Cell(0, 10, $row['due_amount'], 0, 1);

$pdf->Cell(50, 10, 'Payment Method:', 0, 0);
$pdf->Cell(0, 10, $row['payment_method'], 0, 1);

$pdf->Cell(50, 10, 'Payment Date:', 0, 0);
$pdf->Cell(0, 10, $row['payment_date'], 0, 1);

$pdf->Cell(50, 10, 'Transaction ID:', 0, 0);
$pdf->Cell(0, 10, $row['transaction_id'], 0, 1);

$pdf->Cell(50, 10, 'Student ID:', 0, 0);
$pdf->Cell(0, 10, $row['student_id'], 0, 1);

$pdf->Cell(50, 10, 'Amount:', 0, 0);
$pdf->Cell(0, 10, $row['amount'], 0, 1);

// Output PDF
$pdf->Output('D', 'payment_' . $row['id'] . '.pdf');
exit;
?>
