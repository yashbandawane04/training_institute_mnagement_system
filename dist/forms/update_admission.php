<?php
include 'connection.php';

if (
  isset($_POST['originalMobile']) &&
  isset($_POST['student_name']) &&
  isset($_POST['father_name']) &&
  isset($_POST['mobile']) &&
  isset($_POST['email']) &&
  isset($_POST['address']) &&
  isset($_POST['course']) &&
  isset($_POST['admission_date'])
) {
  $originalMobile = $_POST['originalMobile'];
  $student_name = $_POST['student_name'];
  $father_name = $_POST['father_name'];
  $mobile = $_POST['mobile'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $course = $_POST['course'];
  $admission_date = $_POST['admission_date'];

  $sql = "UPDATE admission SET 
            student_name='$student_name',
            father_name='$father_name',
            mobile='$mobile',
            email='$email',
            address='$address',
            course='$course',
            admission_date='$admission_date'
          WHERE mobile='$originalMobile'";

  if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully.";
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
} else {
  echo "Missing data.";
}
?>
