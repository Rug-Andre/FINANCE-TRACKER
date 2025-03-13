<?php
// faq.php
session_start(); // Optional: Include if you want to track user sessions on this page
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Finance Tracker</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f9;
            margin: 0;
            padding: 20px;
            line-height: 1.6;
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
            font-size: 28px;
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
            color: #34495e;
            transition: transform 0.2s;
        }

        li:hover {
            transform: translateX(5px);
        }

        strong {
            color: #2c3e50;
            font-size: 16px;
            display: block;
            margin-bottom: 5px;
        }

        li br {
            display: none; /* Remove the <br> tag effect since we style it with CSS */
        }
    </style>
</head>
<body>
    <div>
        <h2><i class="fas fa-question-circle"></i> Frequently Asked Questions</h2>
        <ul>
            <li>
                <strong><i class="fas fa-wallet"></i> Q: How do I set a budget?</strong>
                A: Go to the Budget page and enter your budget amount and description. You can track it there.
            </li>
            <li>
                <strong><i class="fas fa-money-bill-wave"></i> Q: How do I add income?</strong>
                A: Go to the Income page, enter the amount and description of your income, and save it.
            </li>
            <li>
                <strong><i class="fas fa-shopping-cart"></i> Q: How can I track my expenses?</strong>
                A: You can add your expenses on the Expenses page by entering the amount and description.
            </li>
            <li>
                <strong><i class="fas fa-key"></i> Q: How can I reset my password?</strong>
                A: You can reset your password from the login page by clicking on "Forgot Password."
            </li>
            <li>
                <strong><i class="fas fa-chart-line"></i> Q: How do I view my financial reports?</strong>
                A: Navigate to the Reports page to see detailed charts and summaries of your income and expenses.
            </li>
            <li>
                <strong><i class="fas fa-bell"></i> Q: How do I enable notifications for budget limits?</strong>
                A: Go to Settings and turn on notifications to get alerts when you approach your budget limits.
            </li>
            <li>
                <strong><i class="fas fa-lock"></i> Q: Is my financial data secure?</strong>
                A: Yes, we use industry-standard encryption to protect your data. See our Terms for more details.
            </li>
            <li>
                <strong><i class="fas fa-file-invoice-dollar"></i> Q: Are there any subscription fees?</strong>
                A: Basic features are free, but premium features require a subscription. Check the Pricing page for details.
            </li>
            <li>
                <strong><i class="fas fa-trash-alt"></i> Q: How do I delete a transaction?</strong>
                A: Go to the respective Income or Expenses page, find the transaction, and click the delete option.
            </li>
            <li>
                <strong><i class="fas fa-headset"></i> Q: How can I contact support?</strong>
                A: Email us at support@financetracker.com or use the Contact Us page for assistance.
            </li>
        </ul>
    </div>
</body>
</html>