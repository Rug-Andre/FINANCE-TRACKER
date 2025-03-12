<?php
// dashboard.php

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Finance Tracker</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .container { width: 60%; margin: auto; background: white; padding: 20px; box-shadow: 0px 0px 10px gray; margin-top: 50px; }
        .nav a { margin-right: 15px; text-decoration: none; font-weight: bold; color: #007bff; }
        .nav { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome to Your Dashboard</h2>
        <div class="nav">
            <a href="income.php">Income</a>
            <a href="expenses.php">Expenses</a>
            <a href="budget.php">Budget</a>
            <a href="profile.php">profile</a>
            <a href="faq.php">faq</a>
            <a href="add_notification.php">add notifications</a>
            <a href="notifications.php">notifications</a>
            <a href="terms.php">terms</a>
            <a href="budget_history.php">History</a>
            <a href="reports.php">Reports</a>
            <a href="settings.php">Settings</a>
            <a href="logout.php">Logout</a>
        </div>
        <p>Track your financial activities efficiently.</p>
    </div>
</body>
</html>
