<!-- File: payment_insert.php -->
<?php
include 'connection.php';

$amount_paid = $_POST['amount_paid'];
$total_fees = $_POST['total_fees'];
$due_amount = $_POST['due_amount'];
$payment_method = $_POST['payment_method'];
$payment_date = $_POST['payment_date'];
$transaction_id = $_POST['transaction_id'];
$student_id = $_POST['student_id'];
$amount = $_POST['amount'];

$sql = "INSERT INTO `payments` (
  amount_paid, total_fees, due_amount,
  payment_method, payment_date, transaction_id,
  student_id, amount
) VALUES (
  '$amount_paid', '$total_fees', '$due_amount',
  '$payment_method', '$payment_date', '$transaction_id',
  '$student_id', '$amount'
)";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<script>alert('Payment Submitted Successfully'); window.location.href='payment.php';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
