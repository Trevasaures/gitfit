<?php
include 'dbconfig.php';

$registrationSuccess = false;
$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $height_inches = $_POST['height'];
    $current_weight = $_POST['current_weight'];
    $target_weight = $_POST['target_weight'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // prepare sql and bind parameters
    $stmt = $pdo->prepare("INSERT INTO users_table (username, password, email, name, height_inches, current_weight, target_weight, age, gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $username);
    $stmt->bindParam(2, $hashed_password);
    $stmt->bindParam(3, $email);
    $stmt->bindParam(4, $name);
    $stmt->bindParam(5, $height_inches);
    $stmt->bindParam(6, $current_weight);
    $stmt->bindParam(7, $target_weight);
    $stmt->bindParam(8, $age);
    $stmt->bindParam(9, $gender);

    // execute sql statement and check if successful
    try {
        $stmt->execute();
        $registrationSuccess = true;
        header('Location: login.php');
    } catch (PDOException $e) {
        $errorMessage = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ctrl+Alt+Elite</title>
        <!-- Link to CSS file -->
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <!-- Main header for applicaiton -->
        <h1>Hello, Register for GitFit App!</h1>

        
        <?php if ($registrationSuccess): ?>
            <p>Registration successful!</p>
            <!-- Add a link to the login page or automatically redirect to login page -->
            <p><a href="login.php">Click here to login</a></p>
        <?php else: ?>
            <?php if ($errorMessage): ?>
                <p style="color: red;"><?php echo $errorMessage; ?></p>
            <?php endif; ?>

            <!-- register form -->
            <form action="register.php" method="POST">
                <input type="text" name="username" placeholder="Username" required><br>
                <input type="password" name="password" placeholder="Password" required><br>
                <input type="email" name="email" placeholder="Email" required><br>
                <input type="text" name="name" placeholder="Full Name" required><br>
                <input type="number" name="height" placeholder="Height (inches)" required><br>
                <input type="number" name="current_weight" placeholder="Current Weight (lbs)" required><br>
                <input type="number" name="target_weight" placeholder="Target Weight (lbs)" required><br>
                <input type="number" name="age" placeholder="Age" required><br>
                <select name="gender" required><br>
                    <option value="" disabled selected>Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Prefer not to say</option>
                </select><br>
                <button type="submit">Register</button>
            </form>
        <?php endif; ?>
        <!-- Link to go to login page -->
        <div class="login-link">
            <a href="login.php" class="button">Already have an account? Login</a>
        </div>
    </body>
</html>