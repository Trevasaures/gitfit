<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start(); // Start session at the beginning of the script
include 'dbconfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password']; // This is the hashed password, hashed in register.php

    $stmt = $pdo->prepare("SELECT * FROM users_table WHERE username = ?");
    $stmt->execute([$username]);

    if ($user = $stmt->fetch()) {
        // verify password
        if (password_verify($_POST['password'], $user['password'])) {
            echo "Password is valid!";

            // store user data in session
            $_SESSION['id'] = $user['id']; // store user_id in session
            $_SESSION['username'] = $user['username']; // store username in session

            // redirect to index.php
            header('Location: index.php');
            exit;
        } else {
            $loginError = "Invalid password!";
        }
    } else {
        $loginError = "Invalid username!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ctrl+Alt+Elite</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="login-container">
        <h1>iFitness Login</h1>
        
        <!-- Display login error message if any -->
        <?php if (!empty($loginError)): ?>
            <p style="color:red;"><?php echo $loginError; ?></p>
        <?php endif; ?>

        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Login</button> 
        </form>
        <div class="register-link">
            <p>Don't have an account? <a href="register.php">Register</a></p>
        </div>
    </div>

     <!-- Footer -->
     <footer>
        <p>&copy; 2023 by Ctrl+Alt+Elite</p>
    </footer>
    
</body>
</html>

