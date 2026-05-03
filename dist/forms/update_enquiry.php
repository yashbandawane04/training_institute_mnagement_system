<?php
include 'connection.php';

if (
  isset($_POST['name']) &&
  isset($_POST['mobno']) &&
  isset($_POST['address']) &&
  isset($_POST['email'])
) {
  $name = $_POST['name'];
  $mobno = $_POST['mobno'];
  $address = $_POST['address'];
  $email = $_POST['email'];

  $sql = "UPDATE enquiry SET name='$name', mobno='$mobno', address='$address', email='$email'";

  if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully.";
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
} else {
  echo "Missing data.";
}
?>
