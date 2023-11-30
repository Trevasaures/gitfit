<?php
session_start();
include 'dbconfig.php';

$userId = $_SESSION['id'];
$weightUpdated = false;
$errorMessage = '';

// handle weight update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['current_weight'])) {
    $newWeight = $_POST['current_weight'];

    // insert new weight record into database
    // if a record for today already exists, update it
    // on duplicate key update means that if the primary key already exists, update the record
    $stmt = $pdo->prepare("INSERT INTO weight_records (id, weight_date, weight) VALUES (?, CURDATE(), ?) ON DUPLICATE KEY UPDATE weight = ?");
    if ($stmt->execute([$userId, $newWeight, $newWeight])) {
        $weightUpdated = true;
    } else {
        $errorMessage = "Error updating weight!";
    }
}


// userId contains the user's id
$weights = [];
$dates = [];

$stmt = $pdo->prepare("SELECT * FROM weight_records WHERE id = ? ORDER BY weight_date ASC");
$stmt->execute([$userId]);

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $weights[] = $row['weight'];
    $dates[] = $row['weight_date'];
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
    <!-- add chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 

</head>

<body>
    <!-- Main header for applicaiton -->
    <h1 id="h1">Weight Tracker</h1>
    <h3>Use this section to keep track of your weight!</h3>

    <!-- Display user stats, progress, and other general information here -->
    <!-- Weight Update Form -->
    <form action="weight.php" method="post">
        <label for="current_weight">Current Weight:</label>
        <input type="number" name="current_weight" id="current_weight" required>

        <button type="submit">Add</button>  

    </form>

    <?php if ($weightUpdated): ?>
        <p>Weight updated successfully!</p>
    <?php elseif (!empty($errorMessage)): ?>
        <p style="color:red;"><?php echo $errorMessage; ?></p>
    <?php endif; ?>
    
    <!-- Weight Chart -->
    <script>
        var weightDates = <?php echo json_encode($dates); ?>;
        var weightValues = <?php echo json_encode($weights); ?>;
    </script>
    <canvas id="weightChart"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('weightChart').getContext('2d');
        var weightChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: weightDates,
                datasets: [{
                    label: 'Weight',
                    data: weightValues,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)'
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            suggestedMax: 200
                        }
                    }]
                }
            }
        });
    </script>

    <!-- Back button -->
    <a href="index.php" class="back-button">&#8678; Back to Main</a>

    <!-- Footer -->
    <footer>
        <p>&copy; 2023 by Ctrl+Alt+Elite</p>
    </footer>
    
</body>
</html>