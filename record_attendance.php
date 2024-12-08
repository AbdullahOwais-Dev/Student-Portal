<?php
session_start();
include("db.php"); // Replace with your DB connection file

// Fetch students using PDO
$sql = "SELECT * FROM students"; // Replace `students` with your table name
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Record Attendance</title>
    <style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        button {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .present { background-color: #4CAF50; color: white; }
        .absent { background-color: #f44336; color: white; }
        .marked { opacity: 0.6; pointer-events: none; }
        #success-message {
            text-align: center;
            color: green;
            font-size: 1.2em;
            margin-top: 20px;
        }
    </style>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="navbar">
    <button onclick="goBack()">⬅ Back</button>
</div>


    <h1 style="text-align: center; margin-top: 20px">Record Attendance</h1>

    <form id="attendance-form">
        <table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Father's Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row['student_id']); ?></td>
                        <td><?= htmlspecialchars($row['name']); ?></td>
                        <td><?= htmlspecialchars($row['Fname']); ?></td>
                        <td>
                            <button type="button" class="present" onclick="markAttendance('<?= htmlspecialchars($row['student_id']); ?>', 'present', this)">Present</button>
                            <button type="button" class="absent" onclick="markAttendance('<?= htmlspecialchars($row['student_id']); ?>', 'absent', this)">Absent</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <div style="text-align: center; margin-top: 20px;">
            <button type="button" onclick="submitAttendance()" style="padding: 10px 20px; background-color: #007BFF; color: white; border: none; border-radius: 5px; cursor: pointer;">
                Submit Attendance
            </button>
        </div>
    </form>

    <div id="success-message"></div>

    <script>
        // Object to hold attendance data
        let attendanceData = {};

        function markAttendance(studentId, status, button) {
    // Store or update attendance in the object
    attendanceData[studentId] = status;

    // Get all buttons in the row
    let buttons = button.parentNode.querySelectorAll('button');

    // Reset styles for all buttons
    buttons.forEach(btn => {
        btn.style.opacity = "1"; // Reset to full opacity
        btn.disabled = false; // Enable all buttons
        btn.style.border = "none"; // Remove border emphasis
    });

    // Highlight the clicked button
    button.style.opacity = "1"; // Full opacity for the clicked button
    button.style.border = "2px solid #000"; // Optional: Add a border for emphasis
    button.disabled = true; // Disable the clicked button to indicate it's selected
}


        function submitAttendance() {
            // Check if attendance is marked for at least one student
            if (Object.keys(attendanceData).length === 0) {
                alert("Please mark attendance before submitting!");
                return;
            }

            // AJAX call to submit all attendance data
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "submit_attendance.php", true);
            xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Show success message
                    document.getElementById("success-message").innerText = "Attendance submitted successfully!";

                    // Redirect to submit_attendance.php after a short delay (e.g., 2 seconds)
                    setTimeout(function() {
                        window.location.href = "submit_attendance.php";
                    }, 2000); // Adjust the delay time as needed
                }
            };

            // Send the attendance data as JSON
            xhr.send(JSON.stringify(attendanceData));
        }
    </script>
    <script>
    function goBack() {
        window.history.back();
    }
</script>
<script>
    // Object to hold attendance data
    let attendanceData = {};

    function markAttendance(studentId, status, button) {
        // Store or update attendance in the object
        attendanceData[studentId] = status;

        // Get all buttons in the row
        let buttons = button.parentNode.querySelectorAll('button');

        // Reset styles for all buttons
        buttons.forEach(btn => {
            btn.style.opacity = "1"; // Reset to full opacity
            btn.disabled = false; // Enable all buttons
            btn.style.border = "none"; // Remove border emphasis
        });

        // Highlight the clicked button
        button.style.opacity = "1"; // Full opacity for the clicked button
        button.style.border = "2px solid #000"; // Optional: Add a border for emphasis
        button.disabled = true; // Disable the clicked button to indicate it's selected
    }

    function submitAttendance() {
        // Check if attendance is marked for at least one student
        if (Object.keys(attendanceData).length === 0) {
            alert("Please mark attendance before submitting!");
            return;
        }

        // AJAX call to submit all attendance data
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "submit_attendance.php", true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Show success message
                document.getElementById("success-message").innerText = "Attendance submitted successfully!";

                // Redirect to submit_attendance.php after a short delay (e.g., 2 seconds)
                setTimeout(function() {
                    window.location.href = "submit_attendance.php";
                }, 2000); // Adjust the delay time as needed
            } else if (xhr.readyState === 4) {
                // Show an error message if the submission fails
                alert("Failed to submit attendance. Please try again.");
            }
        };

        // Send the attendance data as JSON
        xhr.send(JSON.stringify(attendanceData));
    }

    function goBack() {
        window.history.back();
    }
</script>



</body>
</html>
