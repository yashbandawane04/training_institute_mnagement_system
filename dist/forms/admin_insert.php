<?php
include 'connection.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

// Hash the password securely
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Current date-time for created_at
$created_at = date("Y-m-d H:i:s");

// Insert into the correct table: 'admins'
$sql = "INSERT INTO admins (email, password_hash, role, created_at, username)
        VALUES ('$email', '$password_hash', '$role', '$created_at', '$username')";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<script>alert('Admin Registered Successfully'); window.location.href='admin.php';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
