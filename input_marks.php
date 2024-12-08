<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $subject = $_POST['subject'];
    $midterm_marks = $_POST['midterm_marks'];
    $finalterm_marks = $_POST['finalterm_marks'];

    $stmt = $pdo->prepare("INSERT INTO marks (student_id, subject, midterm_marks, finalterm_marks) VALUES (?, ?, ?, ?)");
    $stmt->execute([$student_id, $subject, $midterm_marks, $finalterm_marks]);

    echo "<p>Marks recorded successfully!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Input Marks</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>
<body>
<div class="navbar">
    <button onclick="goBack()">⬅ Back</button>
    </div>
    <div class="container">
        <h2>Input Marks</h2>
        <form method="POST">
            <div class="form-group">
                <label for="student_id">Student ID:</label>
                <input type="text" class="form-control" id="student_id" name="student_id" required>
            </div>
            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" class="form-control" id="subject" name="subject" required>
            </div>
            <div class="form-group">
                <label for="midterm_marks">Midterm Marks:</label>
                <input type="number" class="form-control" id="midterm_marks" name="midterm_marks" required>
            </div>
            <div class="form-group">
                <label for="finalterm_marks">Finalterm Marks:</label>
                <input type="number" class="form-control" id="finalterm_marks" name="finalterm_marks" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit Marks</button>
        </form>
    </div>
    <script>
    function goBack() {
        window.history.back();
    }
</script>
</body>
</html>
