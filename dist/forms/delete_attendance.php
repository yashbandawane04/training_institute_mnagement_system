<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $sql = "DELETE FROM attendance WHERE id = '$id'";

  if (mysqli_query($conn, $sql)) {
    echo "Attendance deleted successfully.";
  } else {
    echo "Error deleting record: " . mysqli_error($conn);
  }
} else {
  echo "Invalid request.";
}
?>
