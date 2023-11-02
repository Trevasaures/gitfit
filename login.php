<?php
include 'dbconfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password']; // For simplicity; consider hashing in a real-world scenario

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->execute([$username, $password]);

    if ($stmt->fetch()) {
        echo "Logged in successfully!";
        // Set session, redirect to dashboard, etc.
    } else {
        echo "Incorrect credentials!";
    }
}
?>

<form action="login.php" method="post">
    <label>Username: <input type="text" name="username"></label><br>
    <label>Password: <input type="password" name="password"></label><br>
    <input type="submit" value="Login">
</form>
