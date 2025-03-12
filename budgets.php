<?php
// budget.php
session_start();
require 'db.php'; // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user's budget
$sql = "SELECT * FROM budgets WHERE user_id = $user_id";
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    $budget = $result->fetch_assoc();
} else {
    die("Error fetching budget: " . $conn->error);
}

// Update or insert budget
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $planned_amount = $_POST['planned_amount'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    if ($budget) {
        // Update existing budget
        $sql = "UPDATE budgets SET name = '$name', description = '$description', planned_amount = '$planned_amount', start_date = '$start_date', end_date = '$end_date' WHERE user_id = $user_id";
    } else {
        // Insert new budget
        $sql = "INSERT INTO budgets (user_id, name, description, planned_amount, start_date, end_date) VALUES ($user_id, '$name', '$description', '$planned_amount', '$start_date', '$end_date')";
    }

    if ($conn->query($sql) === TRUE) {
        $message = "Budget saved successfully!";
    } else {
        die("Error saving budget: " . $conn->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget - Finance Tracker</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .container { width: 60%; margin: auto; background: white; padding: 20px; box-shadow: 0px 0px 10px gray; margin-top: 50px; }
        input, button { width: 100%; padding: 10px; margin-top: 10px; }
        button { background-color: #ffc107; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Set Your Budget</h2>

        <?php
        if (isset($message)) {
            echo "<p class='message'>$message</p>";
        }
        ?>

        <form action="budget.php" method="post">
            <label for="name">Budget Name</label>
            <input type="text" name="name" required value="<?php echo $budget['name'] ?? ''; ?>">

            <label for="description">Description</label>
            <input type="text" name="description" value="<?php echo $budget['description'] ?? ''; ?>">

            <label for="planned_amount">Planned Amount</label>
            <input type="number" name="planned_amount" required value="<?php echo $budget['planned_amount'] ?? ''; ?>">

            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" required value="<?php echo $budget['start_date'] ?? ''; ?>">

            <label for="end_date">End Date</label>
            <input type="date" name="end_date" required value="<?php echo $budget['end_date'] ?? ''; ?>">

            <button type="submit">Set Budget</button>
        </form>
    </div>
</body>
</html>
