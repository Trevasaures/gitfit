<!-- notes.php -->

<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

include 'dbconfig.php';

$id = $_SESSION['id'];

// Fetch existing notes for the user
$noteStmt = $pdo->prepare("SELECT * FROM user_notes WHERE id = ?");
$noteStmt->bindParam(1, $id);
$noteStmt->execute();

// Check if the form is submitted to add a new note
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['new_note_content'])) {
        $newNoteContent = htmlspecialchars($_POST['new_note_content']);

        // Insert new note into the database with the current date and time
        $insertQuery = "INSERT INTO user_notes (id, note_content, note_date) VALUES (?, ?, CURRENT_TIMESTAMP)";
        $insertStmt = $pdo->prepare($insertQuery);
        $insertStmt->execute([$id, $newNoteContent]);
    }
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes Tracking</title>
    <!-- Link to CSS file -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    
    <!-- Add a section to display existing notes -->
    <h1>Note Records</h1>
    <h3>Use this section to keep track of your personal notes!</h3>
    <table>
    <thead>
        <tr>
            <th>Date </th>
            <th>Note </th>
        </tr>
    </thead>
<tbody>

    <?php
    while ($note = $noteStmt->fetch(PDO::FETCH_ASSOC)) {
        $noteDate = new DateTime($note['note_date']);
        echo "<tr>";
        echo "<td>" . $noteDate->format('F j, Y H:i:s') . "</p>";
        echo "<td>" . htmlspecialchars($note['note_content']) . "</p>";
        echo "</tr>";
    }
    ?>
</tbody>
</table>

    <!-- Form for creating new notes -->
    <form action="notes.php" method="post">
        <textarea name="new_note_content" placeholder="Enter your new note"></textarea>

        <button type="submit">Add</button>  

    </form>

    <!-- Back button -->
    <a href="index.php" class="back-button">&#8678; Back to Main</a>

    <!-- Footer -->
    <footer>
        <p>&copy; 2023 by Ctrl+Alt+Elite</p>
    </footer>

</body>
</html>


