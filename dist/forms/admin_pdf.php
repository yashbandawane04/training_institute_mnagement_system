<?php
require('fpdf.php');          // FPDF is in the same folder
require('connection.php');    // DB connection also in the same folder

if (!isset($_GET['id'])) {
    die('Admin ID not provided.');
}

$id = intval($_GET['id']);

// Fetch admin row from DB
$sql = "SELECT id, email, password_hash, role, created_at, username FROM admins WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die('Admin not found.');
}

$row = $result->fetch_assoc();

// Start PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Title
$pdf->Cell(0, 10, 'Admin Details (ID: ' . $row['id'] . ')', 0, 1, 'C');
$pdf->Ln(10);

// Set font for content
$pdf->SetFont('Arial', '', 12);

// Output fields
$pdf->Cell(50, 10, 'ID:', 0, 0);
$pdf->Cell(0, 10, $row['id'], 0, 1);

$pdf->Cell(50, 10, 'Username:', 0, 0);
$pdf->Cell(0, 10, $row['username'], 0, 1);

$pdf->Cell(50, 10, 'Email:', 0, 0);
$pdf->Cell(0, 10, $row['email'], 0, 1);

$pdf->Cell(50, 10, 'Password Hash:', 0, 0);
$pdf->Cell(0, 10, $row['password_hash'], 0, 1);

$pdf->Cell(50, 10, 'Role:', 0, 0);
$pdf->Cell(0, 10, $row['role'], 0, 1);

$pdf->Cell(50, 10, 'Created At:', 0, 0);
$pdf->Cell(0, 10, $row['created_at'], 0, 1);

// Output PDF
$pdf->Output('D', 'admin_' . $row['id'] . '.pdf');
exit;
?>
