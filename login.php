<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Username and Password stored here, so change it if you want. But also change from the Database
    $admin_username = "Salman_Qazi";
    $admin_password = "Qazi-123";

    if ($_POST['username'] == $admin_username && $_POST['password'] == $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_dashboard.php");
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>
<body>
    <div class="login-container">
    <?php include 'navbar.php'; ?>
        <h2 class="heading">Admin Login</h2>
        <form method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <?php if (isset($error)) { echo "<p class='text-danger'>$error</p>"; } ?>
    </div>
</body>
</html>
