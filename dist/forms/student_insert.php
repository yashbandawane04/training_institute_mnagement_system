<?php
include 'enquiry_insert.php'; // Use your DB connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_name = $_POST['student_name'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];

    $sql = "INSERT INTO students (student_name, dob, email) 
            VALUES ('$student_name', '$dob', '$email')";

    if (mysqli_query($conn, $sql)) {
        echo "Student record inserted successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
