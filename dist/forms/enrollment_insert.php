<?php
include 'enquiry_insert.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $course_id = $_POST['course_id'];
    $batch_id = $_POST['batch_id'];

    $sql = "INSERT INTO enrollments (student_id, course_id, batch_id) 
            VALUES ('$student_id', '$course_id', '$batch_id')";

    if (mysqli_query($conn, $sql)) {
        echo "Enrollment record inserted successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
