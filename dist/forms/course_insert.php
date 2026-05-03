<?php
include 'enquiry_insert.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_name = $_POST['course_name'];
    $duration = $_POST['duration'];
    $fees = $_POST['fees'];

    $sql = "INSERT INTO courses (course_name, duration, fees) 
            VALUES ('$course_name', '$duration', '$fees')";

    if (mysqli_query($conn, $sql)) {
        echo "Course record inserted successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
