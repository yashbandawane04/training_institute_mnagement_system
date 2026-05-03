<!-- File: trainer_insert.php -->
<?php
include 'connection.php';

$full_name = $_POST['full_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$qualification = $_POST['qualification'];
$specialization = $_POST['specialization'];
$joining_date = $_POST['joining_date'];
$status = $_POST['status'];

$sql = "INSERT INTO trainers (full_name, email, phone, qualification, specialization, joining_date, status)
        VALUES ('$full_name', '$email', '$phone', '$qualification', '$specialization', '$joining_date', '$status')";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<script>alert('Trainer Registered Successfully'); window.location.href='trainer.php';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
