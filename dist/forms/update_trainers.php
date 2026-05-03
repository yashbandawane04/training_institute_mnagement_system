<?php
include 'connection.php';

if (
  isset($_POST['id']) &&
  isset($_POST['full_name']) &&
  isset($_POST['email']) &&
  isset($_POST['phone']) &&
  isset($_POST['qualification']) &&
  isset($_POST['specialization']) &&
  isset($_POST['joining_date']) &&
  isset($_POST['status'])
) {
  $id = $_POST['id'];
  $full_name = $_POST['full_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $qualification = $_POST['qualification'];
  $specialization = $_POST['specialization'];
  $joining_date = $_POST['joining_date'];
  $status = $_POST['status'];

  $sql = "UPDATE trainers SET 
            full_name='$full_name',
            email='$email',
            phone='$phone',
            qualification='$qualification',
            specialization='$specialization',
            joining_date='$joining_date',
            status='$status'
          WHERE id=$id";

  if (mysqli_query($conn, $sql)) {
    echo "Trainer record updated successfully.";
  } else {
    echo "Error updating trainer: " . mysqli_error($conn);
  }
} else {
  echo "Missing required fields.";
}
?>
