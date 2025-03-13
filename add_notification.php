<?php
// add_notification.php
session_start();
require 'db.php'; // Include the database connection

// Check if the user is logged in
// if (!isset($_SESSION['user_id'])) {
//     header("Location: login.php");
//     exit;
// }

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f9;
            margin: 0;
            padding: 20px;
        }

        div {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 25px;
        }

        label {
            color: #34495e;
            font-weight: bold;
            margin-bottom: 8px;
            display: inline-block;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        textarea:focus {
            border-color: #3498db;
            outline: none;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        button {
            background-color: #3498db;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2980b9;
        }

        .success-msg {
            color: #27ae60;
            padding: 10px;
            background-color: #e8f4ea;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .error-msg {
            color: #c0392b;
            padding: 10px;
            background-color: #fceae8;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div>
        <h2><i class="fas fa-bell"></i> Add a New Notification</h2>
        <form action="add_notification.php" method="POST">
            <label for="title"><i class="fas fa-heading"></i> Notification Title</label><br>
            <input type="text" id="title" name="title" placeholder="Enter the notification title" required><br><br>

            <label for="message"><i class="fas fa-comment"></i> Notification Message</label><br>
            <textarea id="message" name="message" rows="5" placeholder="Enter the notification message" required></textarea><br><br>

            <button type="submit"><i class="fas fa-plus"></i> Add Notification</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($stmt->execute()) {
                echo "<p class='success-msg'><i class='fas fa-check-circle'></i> Notification added successfully!</p>";
            } else {
                echo "<p class='error-msg'><i class='fas fa-exclamation-circle'></i> Error: " . $stmt->error . "</p>";
            }
        }
        ?>
    </div>
</body>
</html>