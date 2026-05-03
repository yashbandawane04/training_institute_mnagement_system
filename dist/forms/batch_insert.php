<?php
include 'enquiry_insert.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $batch_name = $_POST['batch_name'];
    $start_date = $_POST['start_date'];
    $trainer_id = $_POST['trainer_id'];

    $sql = "INSERT INTO batches (batch_name, start_date, trainer_id) 
            VALUES ('$batch_name', '$start_date', '$trainer_id')";

    if (mysqli_query($conn, $sql)) {
        echo "Batch record inserted successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
