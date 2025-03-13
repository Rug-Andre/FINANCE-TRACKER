<?php
// dashboard.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Assuming you have a db.php for database connection
require 'db.php';
$user_id = $_SESSION['user_id'];

// Fetch basic user data (optional, adjust based on your needs)
$query = "SELECT username FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$username = $user['username'] ?? 'User';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Finance Tracker</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f9;
            margin: 0;
            padding: 0;
        }

        /* Navigation Bar */
        .navbar {
            background-color: #2c3e50;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar .brand {
            font-size: 24px;
            font-weight: bold;
        }

        .navbar .nav-links a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 16px;
            transition: color 0.3s;
        }

        .navbar .nav-links a:hover {
            color: #3498db;
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 30px;
            text-align: center;
        }

        /* Cards */
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card i {
            font-size: 30px;
            color: #3498db;
            margin-bottom: 10px;
        }

        .card h3 {
            color: #2c3e50;
            margin: 10px 0;
        }

        .card p {
            color: #7f8c8d;
            font-size: 14px;
        }

        /* Time Display */
        .time-display {
            text-align: right;
            color: #7f8c8d;
            font-size: 14px;
            margin-bottom: 20px;
        }

        /* Additional Content */
        .welcome-text {
            background-color: #f9fbfc;
            padding: 20px;
            border-radius: 4px;
            color: #34495e;
            text-align: center;
            margin-bottom: 20px;
        }

        .quick-links {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
        }

        .quick-links a {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .quick-links a:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <div class="navbar">
        <div class="brand"><i class="fas fa-piggy-bank"></i> Finance Tracker</div>
        <div class="nav-links">
            <a href="income.php"><i class="fas fa-money-bill-wave"></i> Income</a>
            <a href="expenses.php"><i class="fas fa-shopping-cart"></i> Expenses</a>
            <a href="budget.php"><i class="fas fa-wallet"></i> Budget</a>
            <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
            <a href="faq.php"><i class="fas fa-question-circle"></i> FAQ</a>
            <a href="add_notification.php"><i class="fas fa-bell"></i> Add Notifications</a>
            <a href="notifications.php"><i class="fas fa-inbox"></i> Notifications</a>
            <a href="terms.php"><i class="fas fa-file-contract"></i> Terms</a>
            <a href="budget_history.php"><i class="fas fa-history"></i> History</a>
            <a href="reports.php"><i class="fas fa-chart-line"></i> Reports</a>
            <a href="settings.php"><i class="fas fa-cog"></i> Settings</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="time-display">
            <i class="fas fa-clock"></i> Current Time: <span id="current-time"></span>
        </div>

        <h2><i class="fas fa-tachometer-alt"></i> Welcome to Your Dashboard, <?php echo htmlspecialchars($username); ?>!</h2>

        <!-- Cards Section -->
        <div class="cards">
            <div class="card">
                <i class="fas fa-money-bill-wave"></i>
                <h3>Total Income</h3>
                <p>Track your earnings here.</p>
                <a href="income.php" class="quick-links">View Details</a>
            </div>
            <div class="card">
                <i class="fas fa-shopping-cart"></i>
                <h3>Total Expenses</h3>
                <p>Monitor your spending.</p>
                <a href="expenses.php" class="quick-links">View Details</a>
            </div>
            <div class="card">
                <i class="fas fa-wallet"></i>
                <h3>Budget Status</h3>
                <p>Check your budget progress.</p>
                <a href="budget.php" class="quick-links">View Details</a>
            </div>
            <div class="card">
                <i class="fas fa-chart-line"></i>
                <h3>Financial Reports</h3>
                <p>Analyze your finances.</p>
                <a href="reports.php" class="quick-links">View Details</a>
            </div>
        </div>

        <!-- Welcome Text -->
        <div class="welcome-text">
            <p><i class="fas fa-info-circle"></i> Track your financial activities efficiently with Finance Tracker. Stay on top of your income, expenses, and budget goals.</p>
        </div>

        <!-- Quick Links -->
        <div class="quick-links">
            <a href="add_notification.php"><i class="fas fa-bell"></i> Add Notification</a>
            <a href="notifications.php"><i class="fas fa-inbox"></i> View Notifications</a>
            <a href="settings.php"><i class="fas fa-cog"></i> Settings</a>
            <a href="faq.php"><i class="fas fa-question-circle"></i> FAQ</a>
        </div>
    </div>

    <!-- JavaScript for Current Time -->
    <script>
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleString();
            document.getElementById('current-time').textContent = timeString;
        }
        updateTime();
        setInterval(updateTime, 1000); // Update every second
    </script>
</body>
</html>