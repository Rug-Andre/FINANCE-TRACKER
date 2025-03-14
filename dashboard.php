<?php
// dashboard.php (PHP section remains unchanged)
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require 'db.php';
$user_id = $_SESSION['user_id'];

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
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        /* Navigation Bar */
        .navbar {
            background-color: #e74c3c; /* Red */
            /* padding: 20px; */
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            position: sticky;
            top: 0;
            height: 70px;
            z-index: 1000;
        }

        .navbar .brand {
            font-size: 28px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .navbar .nav-links a {
            color: #ffffff;
            text-decoration: none;
            margin: 0 10px;
            font-size: 16px;
            /* padding: 8px 12px; */
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .navbar .nav-links a:hover {
            background-color: #f1c40f; /* Yellow */
            color: #e74c3c; /* Red */
        }

        /* Container */
        .container {
            max-width: 1300px;
            margin: 40px auto;
            padding: 25px;
        }

        h2 {
            color: #27ae60; /* Green */
            margin-bottom: 35px;
            text-align: center;
            font-size: 32px;
            font-weight: 600;
        }

        /* Cards */
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .card {
            background-color: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid #f1c40f; /* Yellow border */
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .card i {
            font-size: 36px;
            color: #27ae60; /* Green */
            margin-bottom: 15px;
        }

        .card h3 {
            color: #e74c3c; /* Red */
            margin: 15px 0;
            font-size: 22px;
        }

        .card p {
            color: #666;
            font-size: 15px;
            margin-bottom: 15px;
        }

        /* Time Display */
        .time-display {
            text-align: right;
            color: #27ae60; /* Green */
            font-size: 16px;
            margin-bottom: 25px;
            font-style: italic;
        }

        /* Additional Content */
        .welcome-text {
            background-color: #fff9e6; /* Light Yellow */
            padding: 25px;
            border-radius: 8px;
            color: #e74c3c; /* Red */
            text-align: center;
            margin-bottom: 25px;
            border-left: 5px solid #27ae60; /* Green */
        }

        .quick-links {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .quick-links a {
            background-color: #f1c40f; /* Yellow */
            color: #ffffff;
            padding: 12px 25px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .quick-links a:hover {
            background-color: #27ae60; /* Green */
            transform: scale(1.05);
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
        setInterval(updateTime, 1000);
    </script>
</body>
</html>