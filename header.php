<?php
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <nav class="nav">
            <a class="nav-link" href="add_student.php">Add Student</a>
            <a class="nav-link" href="record_attendance.php">Record Attendance</a>
            <a class="nav-link" href="input_marks.php">Input Marks</a>
            <a class="nav-link" href="about.php">About</a>
            <a class="nav-link" href="logout.php">Logout</a>
        </nav>
    </div>
</body>
</html>