<?php
session_start();
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
<div class="navbar">
    <button onclick="goBack()">⬅ Back</button>
    </div>
    <div class="admin-msg container">
    <!-- <?php include 'navbar.php'; ?> -->

    <h2>Hey there, Please select one of the below!</h2>
    <?php
include 'header.php';
?>
    </div>
    <script>
    function goBack() {
        window.history.back();
    }
</script>
</body>
</html>
