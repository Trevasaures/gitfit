<?php
session_start();


if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

// include 'dbconfig.php';
include 'dbconfig.php';

// Get user data from database
$id = $_SESSION['id'];
$stmt = $pdo->prepare("SELECT * FROM users_table WHERE id = ?");
$stmt->bindParam(1, $id); // bindParam() binds a variable to a parameter
$stmt->execute();
$userData = $stmt->fetch(PDO::FETCH_ASSOC); // fetch() returns a single row 

// get weight data from database
$weightStmt = $pdo->prepare("SELECT weight FROM weight_records WHERE id = ? ORDER BY weight_date ASC");
$weightStmt->bindParam(1, $id);
$weightStmt->execute();
$latestWeight = $weightStmt->fetch(PDO::FETCH_ASSOC);

// check if theres a wight record for today
$currentWeight = $latestWeight ? $latestWeight['weight'] : 'No record for today!';
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ctrl+Alt+Elite</title>
    <!-- Link to CSS file -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Main header for applicaiton -->
    <h1>Hello, GitFit App!</h1>
    <!-- Display user stats, progress, and other general information here -->
    <p>User: <?php echo htmlspecialchars($userData['username']); ?></p> <!-- htmlspecialchars() converts special characters to HTML entities -->
    <p>Weight: <?php echo htmlspecialchars($currentWeight); ?></p>
    <p>Target Weight: <?php echo htmlspecialchars($userData['target_weight']); ?></p>
    <p>Height: <?php echo htmlspecialchars($userData['height_inches']); ?></p>


    <!-- Secondary smaller header for application -->
    <h2>Select what you would like to do!</h2>

    <!-- Navigation links to other sections -->
    <a href="weight.php">Weight Tracking</a>
    <a href="food.html">Food Calculator</a>
    <a href="notes.html">Note Records</a>
    <a href="workouts.php">Workout Tracking</a>

    <!-- Back button -->
    <a href="login.php" class="back-button">&#8678; Back to Login</a>
</body>
</html>
