<?php
include 'connection.php';

if (isset($_POST['id'])) {
  $id = $_POST['id'];

  $sql = "DELETE FROM trainers WHERE id=$id";

  if (mysqli_query($conn, $sql)) {
    echo "Trainer deleted successfully.";
  } else {
    echo "Error deleting trainer: " . mysqli_error($conn);
  }
} else {
  echo "Trainer ID not received.";
}
?>
