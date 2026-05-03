<?php
include 'connection.php';

if (isset($_POST['email'])) {
  $email = $_POST['email'];

  $sql = "DELETE FROM admins WHERE email='$email'";

  if (mysqli_query($conn, $sql)) {
    echo "Admin deleted successfully.";
  } else {
    echo "Error deleting admin: " . mysqli_error($conn);
  }
} else {
  echo "Email not received.";
}
?>
