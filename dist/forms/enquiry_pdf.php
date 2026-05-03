<?php
require('fpdf.php');          // FPDF is in the same folder
require('connection.php');    // DB connection also in the same folder

if (!isset($_GET['mobno'])) {
    die('Mobile number not provided.');
}

$mobno = $_GET['mobno'];

// Fetch enquiry row securely
$sql = "SELECT name, mobno, address, email FROM enquiry WHERE mobno = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $mobno); // 's' for string
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die('Enquiry not found.');
}

$row = $result->fetch_assoc();

// Start PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Title
$pdf->Cell(0, 10, 'Enquiry Details (Mob: ' . $row['mobno'] . ')', 0, 1, 'C');
$pdf->Ln(10);

// Set font for content
$pdf->SetFont('Arial', '', 12);

// Output fields
$pdf->Cell(50, 10, 'Name:', 0, 0);
$pdf->Cell(0, 10, $row['name'], 0, 1);

$pdf->Cell(50, 10, 'Mobile No:', 0, 0);
$pdf->Cell(0, 10, $row['mobno'], 0, 1);

$pdf->Cell(50, 10, 'Address:', 0, 0);
$pdf->MultiCell(0, 10, $row['address'], 0, 1);

$pdf->Cell(50, 10, 'Email:', 0, 0);
$pdf->Cell(0, 10, $row['email'], 0, 1);

// Output the PDF with download
$pdf->Output('D', 'enquiry_' . $row['mobno'] . '.pdf');
exit;
?>
