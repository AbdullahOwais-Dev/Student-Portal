<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <link rel="stylesheet" href="style.css">
    <div class="navbar">
    <button onclick="goBack()">⬅ Back</button>
    </div>
</head>
<body>

<?php
include("db.php"); 

// Get the raw POST data
$rawData = file_get_contents("php://input");

// Decode the JSON data into an associative array
$data = json_decode($rawData, true);
if (!empty($data)) {
    $date = date("Y-m-d");

    foreach ($data as $student_id => $status) {
       
        $sql = "INSERT INTO attendance (student_id, status, date) 
                VALUES (:student_id, :status, :date)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':student_id' => $student_id,
            ':status' => $status,
            ':date' => $date
        ]);
    }

    echo "Attendance recorded successfully!";
}

echo '<div class="success-box box">Attendance added successfully. You can now go back or check it in the database!</div>';
?>
    <script>
    function goBack() {
        window.history.back();
    }
    </script>

</body>
</html>