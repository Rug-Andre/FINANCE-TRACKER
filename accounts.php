<?php
$accounts = getAccounts($userId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .card { margin: 20px; }
        .icon { font-size: 2em; color: #007bff; }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Your Accounts</h1>

        <div class="row">
            <?php foreach ($accounts as $account) { ?>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-<?php echo $account['account_type'] == 'checking' ? 'wallet' : 'credit-card'; ?> icon"></i> <?php echo $account['account_name']; ?></h5>
                            <p class="card-text">Balance: $<?php echo $account['balance']; ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
