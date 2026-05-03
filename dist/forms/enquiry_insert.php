<!-- File: enquiry_insert.php -->
<?php
include 'connection.php';

$name = $_POST['name'];
$mobile = $_POST['mob'];
$address = $_POST['address'];
$email = $_POST['email'];

// Insert into DB
$sql = "INSERT INTO `enquiry` (name,mobno, address, email)
        VALUES ('$name', '$mobile', '$address', '$email')";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<script>alert('Enquiry Submitted Successfully'); window.location.href='enquiry.php';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
