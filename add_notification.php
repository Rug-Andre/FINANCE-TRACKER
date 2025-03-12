<?php
// add_notification.php
session_start();
require 'db.php'; // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch the user's role from the database
$user_id = $_SESSION['user_id'];
$query = "SELECT role FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// If the user is not an admin, redirect them
// if ($user['role'] !== 'admin') {
//     header("Location: index.php"); // Redirect to home page if not admin
//     exit;
// }

// Handle form submission to add the notification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $message = $_POST['message'];

    // Insert the new notification into the database
    $query = "INSERT INTO notifications (user_id, title, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iss", $user_id, $title, $message);

    if ($stmt->execute()) {
        echo "Notification added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Notification - Finance Tracker</title>
</head>
<body>
    <div>
        <h2>Add a New Notification</h2>
        <form action="add_notification.php" method="POST">
            <label for="title">Notification Title</label><br>
            <input type="text" id="title" name="title" placeholder="Enter the notification title" required><br><br>

            <label for="message">Notification Message</label><br>
            <textarea id="message" name="message" rows="5" placeholder="Enter the notification message" required></textarea><br><br>

            <button type="submit">Add Notification</button>
        </form>
    </div>
</body>
</html>
