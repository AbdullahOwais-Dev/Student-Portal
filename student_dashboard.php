<?php
session_start();
include 'db.php';


        $marks = [];
        $student_id = "";
        $student_name = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id']; 

    $student_stmt = $pdo->prepare("SELECT name FROM students WHERE student_id = ?");
    $student_stmt->execute([$student_id]);
    $student = $student_stmt->fetch();

    if ($student) {
        $student_name = $student['name'];

        $marks_stmt = $pdo->prepare("SELECT * FROM marks WHERE student_id = ?");
        $marks_stmt->execute([$student_id]);
        $marks = $marks_stmt->fetchAll();
    } else {
        $error = "No student found with this Student ID!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>
<body>
    <div class="student-dashboard-form container">
        <h2 class= "std-form">Welcome to Your Dashboard!</h2>
        
        <form method="POST" class="my-3">
            <div class="form-group">
                <label for="student_id">Enter Your Student ID:</label>
                <input type="text" class="form-control" id="student_id" name="student_id" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form><br><hr><br>

        <?php if (isset($error)) { ?>
            <p class="text-danger"><?php echo $error; ?></p>
        <?php } ?>

        <?php if ($student_name && !empty($marks)) { ?>

            <h3><?php echo $student_name; ?>'s Marks</h3>

            <table class="table">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Midterm Marks</th>
                        <th>Finalterm Marks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($marks as $row) { ?>
                        <tr>
                            <td><?php echo $row['subject']; ?></td>
                            <td><?php echo $row['midterm_marks']; ?></td>
                            <td><?php echo $row['finalterm_marks']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</body>
</html>
