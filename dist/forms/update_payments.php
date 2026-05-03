<?php
include 'connection.php';

if (
  isset($_POST['id']) &&
  isset($_POST['amount_paid']) &&
  isset($_POST['total_fees']) &&
  isset($_POST['due_amount']) &&
  isset($_POST['payment_method']) &&
  isset($_POST['payment_date']) &&
  isset($_POST['transaction_id']) &&
  isset($_POST['student_id']) &&
  isset($_POST['amount'])
) {
  $id = $_POST['id'];
  $amount_paid = $_POST['amount_paid'];
  $total_fees = $_POST['total_fees'];
  $due_amount = $_POST['due_amount'];
  $payment_method = $_POST['payment_method'];
  $payment_date = $_POST['payment_date'];
  $transaction_id = $_POST['transaction_id'];
  $student_id = $_POST['student_id'];
  $amount = $_POST['amount'];

  $sql = "UPDATE payments SET 
            amount_paid='$amount_paid',
            total_fees='$total_fees',
            due_amount='$due_amount',
            payment_method='$payment_method',
            payment_date='$payment_date',
            transaction_id='$transaction_id',
            student_id='$student_id',
            amount='$amount'
          WHERE id=$id";

  if (mysqli_query($conn, $sql)) {
    echo "Payment record updated successfully.";
  } else {
    echo "Error updating payment: " . mysqli_error($conn);
  }
} else {
  echo "Missing required fields.";
}
?>
