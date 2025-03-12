<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Include the database connection
include('db.php');

// Fetch the current budget for the user
$query = "SELECT * FROM budgets WHERE user_id = ? ORDER BY date_created DESC LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$budget = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $planned_amount = $_POST['planned_amount'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Insert new budget record into the database
    $query = "INSERT INTO budgets (user_id, name, description, planned_amount, start_date, end_date) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issdss", $user_id, $name, $description, $planned_amount, $start_date, $end_date);

    if ($stmt->execute()) {
        echo "Budget set successfully!";
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
    <title>Budget - Finance Tracker</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .container { width: 60%; margin: auto; background: white; padding: 20px; box-shadow: 0px 0px 10px gray; margin-top: 50px; }
        input, button { width: 100%; padding: 10px; margin-top: 10px; }
        button { background-color: #ffc107; color: white; border: none; cursor: pointer; }
        .budget-record { margin-top: 30px; }
        .budget-record table { width: 100%; border-collapse: collapse; }
        .budget-record th, .budget-record td { padding: 8px; border: 1px solid #ddd; }
        .budget-record th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Set Your Budget</h2>
        <form action="budget.php" method="post">
            <input type="text" name="name" placeholder="Budget Name" required>
            <input type="number" name="planned_amount" placeholder="Planned Amount" step="0.01" required>
            <input type="text" name="description" placeholder="Description" required>
            <input type="date" name="start_date" required>
            <input type="date" name="end_date" required>
            <button type="submit">Set Budget</button>
        </form>

        <?php if ($budget): ?>
            <h2>Your Current Budget</h2>
            <div class="budget-record">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Date Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo htmlspecialchars($budget['name']); ?></td>
                            <td><?php echo number_format($budget['planned_amount'], 2); ?></td>
                            <td><?php echo htmlspecialchars($budget['description']); ?></td>
                            <td><?php echo $budget['start_date']; ?></td>
                            <td><?php echo $budget['end_date']; ?></td>
                            <td><?php echo date('Y-m-d H:i', strtotime($budget['date_created'])); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
