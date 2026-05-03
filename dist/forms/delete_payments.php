<?php
include 'connection.php';

if (isset($_POST['id'])) {
  $id = $_POST['id'];

  $sql = "DELETE FROM payments WHERE id=$id";

  if (mysqli_query($conn, $sql)) {
    echo "Payment deleted successfully.";
  } else {
    echo "Error deleting payment: " . mysqli_error($conn);
  }
} else {
  echo "Payment ID not received.";
}
?>
