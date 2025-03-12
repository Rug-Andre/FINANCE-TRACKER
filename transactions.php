<?php
$transactions = getTransactions($userId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .icon { font-size: 1.5em; margin-right: 10px; }
        .income { color: green; }
        .expense { color: red; }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Your Transactions</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transactions as $transaction) { ?>
                    <tr class="<?php echo $transaction['amount'] > 0 ? 'income' : 'expense'; ?>">
                        <td><?php echo $transaction['date']; ?></td>
                        <td><?php echo $transaction['description']; ?></td>
                        <td><?php echo $transaction['category']; ?></td>
                        <td><i class="fas fa-<?php echo $transaction['amount'] > 0 ? 'plus-circle income' : 'minus-circle expense'; ?> icon"></i>$<?php echo $transaction['amount']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
