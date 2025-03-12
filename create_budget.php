<?php
// create_budget.php
session_start();
require 'db.php'; // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $planned_amount = $_POST['planned_amount'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Insert new budget record into the database
    $sql = "INSERT INTO budgets (user_id, name, description, planned_amount, start_date, end_date) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issdss", $user_id, $name, $description, $planned_amount, $start_date, $end_date);
    $stmt->execute();

    // Redirect to budget history page after insertion
    header("Location: budget_history.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Budget - Finance Tracker</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .container { width: 60%; margin: auto; background: white; padding: 20px; box-shadow: 0px 0px 10px gray; margin-top: 50px; }
        input, textarea, button { width: 100%; padding: 10px; margin-top: 10px; }
        button { background-color: #007bff; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Create New Budget</h2>

        <form action="create_budget.php" method="post">
            <label for="name">Budget Name</label>
            <input type="text" name="name" required placeholder="Enter Budget Name">
            
            <label for="description">Description</label>
            <textarea name="description" placeholder="Enter Budget Description"></textarea>
            
            <label for="planned_amount">Planned Amount</label>
            <input type="number" name="planned_amount" required placeholder="Enter Planned Amount">
            
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" required>
            
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" required>
            
            <button type="submit">Create Budget</button>
        </form>
    </div>
</body>
</html>
