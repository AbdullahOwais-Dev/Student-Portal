<?php
include("db.php"); // Replace with your DB connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];
    $status = $_POST['status'];
    $date = date("Y-m-d"); // Current date

    // Insert attendance into DB
    $sql = "INSERT INTO attendance (student_id, status, date) VALUES ('$student_id', '$status', '$date')";
    if (mysqli_query($conn, $sql)) {
        echo "Attendance marked successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
