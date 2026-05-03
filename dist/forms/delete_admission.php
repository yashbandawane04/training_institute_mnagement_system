<?php
include 'connection.php';

if (isset($_POST['mobile'])) {
  $mobile = $_POST['mobile'];
  $sql = "DELETE FROM admission WHERE mobile='$mobile'";
  if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully.";
  } else {
    echo "Error deleting record: " . mysqli_error($conn);
  }
} else {
  echo "Missing mobile number.";
}
?>
