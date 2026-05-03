<?php 
require('fpdf.php');
require('connection.php');

// Step 1: Check if mobile is set
if (!isset($_GET['mobile'])) {
    die('Mobile number not provided.');
}

$mobile = $_GET['mobile'];

// Step 2: Fetch data from DB
$sql = "SELECT student_name, father_name, mobile, email, address, course, admission_date 
        FROM admission 
        WHERE mobile = ?";
        
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $mobile);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die('Admission record not found.');
}

$row = $result->fetch_assoc();

// Step 3: Create PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Title
$pdf->Cell(0, 10, 'Admission Details', 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', '', 12);

// Fields
$pdf->Cell(50, 10, 'Student Name:', 0, 0);
$pdf->Cell(0, 10, $row['student_name'], 0, 1);

$pdf->Cell(50, 10, 'Father Name:', 0, 0);
$pdf->Cell(0, 10, $row['father_name'], 0, 1);

$pdf->Cell(50, 10, 'Mobile:', 0, 0);
$pdf->Cell(0, 10, $row['mobile'], 0, 1);

$pdf->Cell(50, 10, 'Email:', 0, 0);
$pdf->Cell(0, 10, $row['email'], 0, 1);

$pdf->Cell(50, 10, 'Address:', 0, 0);
$pdf->MultiCell(0, 10, $row['address']);

$pdf->Cell(50, 10, 'Course:', 0, 0);
$pdf->Cell(0, 10, $row['course'], 0, 1);

$pdf->Cell(50, 10, 'Admission Date:', 0, 0);
$pdf->Cell(0, 10, $row['admission_date'], 0, 1);

// Step 4: Download the PDF
$cleanMobile = preg_replace('/\D/', '', $row['mobile']);
$pdf->Output('D', 'admission_' . $cleanMobile . '.pdf');
exit;
?>
