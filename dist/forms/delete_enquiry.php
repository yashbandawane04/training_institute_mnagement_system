<?php
include 'connection.php';

if (isset($_POST['mobno'])) {
  $mobno = $_POST['mobno'];

  $sql = "DELETE FROM enquiry WHERE mobno='$mobno'";

  if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully.";
  } else {
    echo "Error deleting record: " . mysqli_error($conn);
  }
} else {
  echo "Mobile number not received.";
}
?>
