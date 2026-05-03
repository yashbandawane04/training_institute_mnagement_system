<!-- File: admission_insert.php -->
<?php
include 'connection.php';

$student_id = $_POST['student_id'];
$course_id = $_POST['course_id'];
$admission_date = $_POST['admission_date'];
$status = $_POST['status'];

$sql = "INSERT INTO admission (student_id, course_id, admission_date, status)
        VALUES ('$student_id', '$course_id', '$admission_date', '$status')";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<script>alert('Admission Submitted Successfully'); window.location.href='admission.php';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
