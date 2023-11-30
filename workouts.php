<?php
session_start();
include 'dbconfig.php';

$userId = $_SESSION['id'];

// Include your database connection file here

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $date = $_POST["date"];
    $exercise = $_POST["exercise"];
    $sets = $_POST["sets"];
    $reps = $_POST["reps"];

    try {
        $sql = "INSERT INTO workout_data (id, date, exercise, sets, reps) 
                VALUES (:id, :date, :exercise, :sets, :reps)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $userId);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':exercise', $exercise);
        $stmt->bindParam(':sets', $sets);
        $stmt->bindParam(':reps', $reps);
        $stmt->execute();
    
        echo "New record created successfully";
        header("Location: index.php");
        exit();
    
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
}
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
    <h1>Workout Tracker</h1>
    <h3>Use this section to keep track of your workouts!</h3>

   
    <form action="workouts.php" method="post">
        <label for="date">Date:</label>
        <input type="date" name="date" required>

        <label for="exercise">Exercise:</label>
        <input type="text" name="exercise" required>
        
        <label for="sets">Sets:</label>
        <input type="number" name="sets" required>
    
        <label for="reps">Reps:</label>
        <input type="number" name="reps" required>

       
    
        <button type="submit">Add</button>  
    </form>



    <h3>Workout History</h3>
<table>
    <thead>
        <tr>
            <th>Date </th>
            <th>Exercise </th>
            <th>Sets </th>
            <th>Reps </th>
        </tr>
    </thead>
        <tbody>

        <?php
        try {
            // Fetch workout data for the logged-in user
            $sql = "SELECT date, exercise, sets, reps FROM workout_data WHERE id = :user_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();
    
            // Loop through the fetched data and display it in the table
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row["date"] . "</td>";
                echo "<td>" . $row["exercise"] . "</td>";
                echo "<td>" . $row["sets"] . "</td>";
                echo "<td>" . $row["reps"] . "</td>";
                echo "</tr>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
        
    </tbody>
</table>

    <!-- Back button -->
    <a href="index.php" class="back-button">&#8678; Back to Main</a>

     <!-- Footer -->
     <footer>
        <p>&copy; 2023 by Ctrl+Alt+Elite</p>
    </footer>
    
</body>
</html>