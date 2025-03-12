<?php
// settings.php
session_start();
require 'db.php'; // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

// Get the current user's information
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Update user settings (email, password)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_email = $_POST['email'];
    $new_password = $_POST['password'];

    // Validate password
    if (strlen($new_password) >= 6) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update email and password in the database
        if (!empty($new_email)) {
            $update_sql = "UPDATE users SET email = ?, password = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("ssi", $new_email, $hashed_password, $user_id);
        } else {
            $update_sql = "UPDATE users SET password = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("si", $hashed_password, $user_id);
        }

        $update_stmt->execute();
        $message = "Settings updated successfully!";
    } else {
        $error = "Password must be at least 6 characters long.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Finance Tracker</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .container { width: 50%; margin: auto; background: white; padding: 20px; box-shadow: 0px 0px 10px gray; margin-top: 50px; }
        input, button { width: 100%; padding: 10px; margin-top: 10px; }
        button { background-color: #007bff; color: white; border: none; cursor: pointer; }
        .message { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Account Settings</h2>
        
        <?php
        if (isset($message)) {
            echo "<p class='message'>$message</p>";
        }
        if (isset($error)) {
            echo "<p class='error'>$error</p>";
        }
        ?>

        <form action="settings.php" method="post">
            <label for="email">Email</label>
            <input type="email" name="email" value="<?php echo $user['email']; ?>" placeholder="Enter new email (optional)">
            
            <label for="password">New Password</label>
            <input type="password" name="password" placeholder="Enter new password (optional)">

            <button type="submit">Update Settings</button>
        </form>
    </div>
</body>
</html>
