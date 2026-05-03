<?php
include 'connection.php';

if (
  isset($_POST['originalEmail']) &&
  isset($_POST['email']) &&
  isset($_POST['password_hash']) &&
  isset($_POST['role']) &&
  isset($_POST['created_at']) &&
  isset($_POST['username'])
) {
  $originalEmail = $_POST['originalEmail'];
  $email = $_POST['email'];
  $password_hash = $_POST['password_hash'];
  $role = $_POST['role'];
  $created_at = $_POST['created_at'];
  $username = $_POST['username'];

  $sql = "UPDATE admins SET 
            email='$email', 
            password_hash='$password_hash', 
            role='$role', 
            created_at='$created_at', 
            username='$username' 
          WHERE email='$originalEmail'";

  if (mysqli_query($conn, $sql)) {
    echo "Admin updated successfully.";
  } else {
    echo "Error updating admin: " . mysqli_error($conn);
  }
} else {
  echo "Missing required fields.";
}
?>
