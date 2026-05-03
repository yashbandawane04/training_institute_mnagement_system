<!-- File: attendance_insert.php -->
<?php
include 'connection.php';

$batch_id = $_POST['batch_id'];
$student_id = $_POST['student_id'];
$date = $_POST['date'];
$status = $_POST['status'];
$remarks = $_POST['remarks'];

$sql = "INSERT INTO attendance (batch_id, student_id, date, status, remarks)
        VALUES ('$batch_id', '$student_id', '$date', '$status', '$remarks')";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<script>alert('Attendance Recorded Successfully'); window.location.href='attendance.php';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
