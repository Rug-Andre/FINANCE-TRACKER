<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Include the database connection
include('db.php');

// Fetch the user's most recent budget
$query = "SELECT * FROM budgets WHERE user_id = ? ORDER BY date_created DESC LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$budget = $result->fetch_assoc();

// Fetch user's income records
$sql = "SELECT * FROM income WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$income_result = $stmt->get_result();

// Fetch user's expense records
$sql = "SELECT * FROM expenses WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$expense_result = $stmt->get_result();

// Calculate total income
$total_income = 0;
while ($income = $income_result->fetch_assoc()) {
    $total_income += $income['amount'];
}

// Calculate total expenses
$total_expenses = 0;
while ($expense = $expense_result->fetch_assoc()) {
    $total_expenses += $expense['amount'];
}

// Calculate remaining budget
$remaining_budget = $budget ? ($budget['planned_amount'] - $total_expenses) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - Finance Tracker</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .container { width: 80%; margin: auto; background: white; padding: 20px; box-shadow: 0px 0px 10px gray; margin-top: 50px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background-color: #007bff; color: white; }
        .summary { margin-top: 20px; }
        .message { color: green; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Your Financial Reports</h2>

        <!-- Budget Section -->
        <h3>Budget Summary</h3>
        <?php if ($budget): ?>
            <p>Budget Name: <?php echo htmlspecialchars($budget['name']); ?></p>
            <p>Planned Budget Amount: $<?php echo number_format($budget['planned_amount'], 2); ?></p>
            <p>Description: <?php echo htmlspecialchars($budget['description']); ?></p>
            <p>Start Date: <?php echo $budget['start_date']; ?></p>
            <p>End Date: <?php echo $budget['end_date']; ?></p>
            <p>Date Created: <?php echo date('Y-m-d H:i', strtotime($budget['date_created'])); ?></p>
        <?php else: ?>
            <p>No budget set for this period.</p>
        <?php endif; ?>

        <!-- Income Section -->
        <h3>Income Records</h3>
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $income_result->data_seek(0); // Reset result pointer for reuse
                while ($income = $income_result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $income['description']; ?></td>
                        <td><?php echo number_format($income['amount'], 2); ?></td>
                        <td><?php echo $income['date']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <h4>Total Income: $<?php echo number_format($total_income, 2); ?></h4>

        <!-- Expenses Section -->
        <h3>Expense Records</h3>
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $expense_result->data_seek(0); // Reset result pointer for reuse
                while ($expense = $expense_result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $expense['description']; ?></td>
                        <td><?php echo number_format($expense['amount'], 2); ?></td>
                        <td><?php echo $expense['date']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <h4>Total Expenses: $<?php echo number_format($total_expenses, 2); ?></h4>

        <div class="summary">
            <h3>Summary</h3>
            <p>Planned Budget: $<?php echo number_format($budget['planned_amount'] ?? 0, 2); ?></p>
            <p>Total Income: $<?php echo number_format($total_income, 2); ?></p>
            <p>Total Expenses: $<?php echo number_format($total_expenses, 2); ?></p>
            <p>Remaining Budget: $<?php echo number_format($remaining_budget, 2); ?></p>
        </div>
    </div>
</body>
</html>
