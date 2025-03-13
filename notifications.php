<?php
// notifications.php
session_start();
require 'db.php'; // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Safely assign user_id with a check
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
if ($user_id === null) {
    // This should never happen due to the redirect above, but added as a safety net
    die("Error: User ID not found in session.");
}

// Fetch user's notifications
$query = "SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - Finance Tracker</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f9;
            margin: 0;
            padding: 20px;
        }

        div {
            max-width: 800px;
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

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            background-color: #f9fbfc;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 4px;
            border-left: 4px solid #3498db;
            transition: transform 0.2s;
        }

        li:hover {
            transform: translateX(5px);
        }

        strong {
            color: #2c3e50;
            font-size: 16px;
        }

        p {
            margin: 8px 0;
            color: #34495e;
            line-height: 1.5;
        }

        small {
            color: #7f8c8d;
            font-size: 12px;
        }

        .no-notifications {
            color: #7f8c8d;
            padding: 20px;
            background-color: #f9fbfc;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div>
        <h2><i class="fas fa-bell"></i> Your Notifications</h2>
        <?php if ($result->num_rows > 0): ?>
            <ul>
                <?php while ($notification = $result->fetch_assoc()): ?>
                    <li>
                        <strong><i class="fas fa-bullhorn"></i> <?php echo htmlspecialchars($notification['title']); ?></strong><br>
                        <p><i class="fas fa-comment"></i> <?php echo htmlspecialchars($notification['message']); ?></p>
                        <small><i class="fas fa-clock"></i> <?php echo $notification['created_at']; ?></small>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p class="no-notifications"><i class="fas fa-info-circle"></i> No notifications at the moment.</p>
        <?php endif; ?>
    </div>
</body>
</html>