<?php
// notifications.php
session_start();
require 'db.php'; // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

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
</head>
<body>
    <div>
        <h2>Your Notifications</h2>
        <?php if ($result->num_rows > 0): ?>
            <ul>
                <?php while ($notification = $result->fetch_assoc()): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($notification['title']); ?></strong><br>
                        <p><?php echo htmlspecialchars($notification['message']); ?></p>
                        <small><?php echo $notification['created_at']; ?></small>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>No notifications at the moment.</p>
        <?php endif; ?>
    </div>
</body>
</html>
