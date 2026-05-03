<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $batch_id = $_POST['batch_id'];
  $student_id = $_POST['student_id'];
  $date = $_POST['date'];
  $status = $_POST['status'];
  $remarks = $_POST['remarks'];

  $sql = "UPDATE attendance SET 
            batch_id = '$batch_id',
            student_id = '$student_id',
            date = '$date',
            status = '$status',
            remarks = '$remarks'
          WHERE id = '$id'";

  if (mysqli_query($conn, $sql)) {
    echo "Attendance updated successfully.";
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
} else {
  echo "Invalid request.";
}
?>
