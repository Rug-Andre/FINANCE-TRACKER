<?php
// income.php
session_start();
require 'db.php'; // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Add new income if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the fields are set before using them
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $amount = isset($_POST['amount']) ? $_POST['amount'] : '';
    $date = isset($_POST['date']) ? $_POST['date'] : '';

    if ($description && $amount && $date) {
        $sql = "INSERT INTO income (user_id, amount, description, date) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiss", $user_id, $amount, $description, $date);
        $stmt->execute();
        $message = "Income added successfully!";
    } else {
        $message = "Please fill in all fields.";
    }
}

// Fetch income records for the user
$sql = "SELECT * FROM income WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income - Finance Tracker</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .container { width: 60%; margin: auto; background: white; padding: 20px; box-shadow: 0px 0px 10px gray; margin-top: 50px; }
        input, button { width: 100%; padding: 10px; margin-top: 10px; }
        button { background-color: #28a745; color: white; border: none; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background-color: #007bff; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Manage Your Income</h2>

        <?php
        if (isset($message)) {
            echo "<p class='message'>$message</p>";
        }
        ?>

        <form action="income.php" method="post">
            <label for="description">Description</label>
            <input type="text" name="description" required placeholder="Enter income source">
            <label for="amount">Amount</label>
            <input type="number" name="amount" required placeholder="Enter income amount">
            <label for="date">Date</label>
            <input type="date" name="date" required>
            <button type="submit">Add Income</button>
        </form>

        <h3>Your Income Records</h3>
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['amount']; ?></td>
                        <td><?php echo $row['date']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
