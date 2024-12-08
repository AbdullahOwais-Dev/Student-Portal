<?php
session_start();
include 'db.php';  // Database connection
include 'navbar.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the student data from the form
    $student_id = $_POST['student_id'];
    $name = $_POST['name'];

    try {
        // Prepare the SQL query to insert student data (removing roll_number)
        $stmt = $pdo->prepare("INSERT INTO students (student_id, name) VALUES (?, ?)");
        $stmt->execute([$student_id, $name]);

        // Success message
        echo "Student added successfully!";
    } catch (PDOException $e) {
        // Handle errors
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Student</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>
<body>
    <div class="container">
        <h2>Add a New Student</h2>
        
        <form method="POST">
            <div class="form-group">
                <label for="student_id">Student ID:</label>
                <input type="text" class="form-control" id="student_id" name="student_id" required>
            </div>
            <div class="form-group">
                <label for="name">Student Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Student</button>
        </form>
    </div>
</body>
</html>
