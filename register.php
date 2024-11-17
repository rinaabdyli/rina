<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error_message = "Passwords do not match!";
    } else {
        $check_user = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($check_user);

        if ($result->num_rows > 0) {
            $error_message = "Username is already taken!";
        } else {
            $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', 'user')";
            if ($conn->query($sql) === TRUE) {
                $success_message = "Registration successful! You can now log in.";
            } else {
                $error_message = "Error: " . $conn->error;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="login-container">
        <form method="POST" action="">
            <h2>Register</h2>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit">Register</button>
            <?php if (isset($error_message)): ?>
                <p class="error"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <?php if (isset($success_message)): ?>
                <p class="success"><?php echo $success_message; ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
