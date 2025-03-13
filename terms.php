<?php
// terms.php
session_start(); // Optional: Include if you want to track user sessions on this page
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Conditions - Finance Tracker</title>
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

        p {
            color: #34495e;
            margin-bottom: 20px;
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
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        li:hover {
            transform: translateX(5px);
            transition: transform 0.2s;
        }

        .intro-text {
            font-style: italic;
            color: #7f8c8d;
        }

        .footer-text {
            font-weight: bold;
            color: #2c3e50;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div>
        <h2><i class="fas fa-file-contract"></i> Terms and Conditions</h2>
        <p class="intro-text"><i class="fas fa-info-circle"></i> Welcome to the Finance Tracker platform. By using our service, you agree to the following terms:</p>
        <ul>
            <li><i class="fas fa-user-check"></i> Users must be over 18 years old to register and use the platform.</li>
            <li><i class="fas fa-lock"></i> All financial data entered into the platform is private and secured with industry-standard encryption.</li>
            <li><i class="fas fa-exclamation-triangle"></i> We are not responsible for any financial loss incurred while using this platform; all investment decisions are your own.</li>
            <li><i class="fas fa-headset"></i> For any technical issues or account inquiries, please contact our support team at support@financetracker.com.</li>
            <li><i class="fas fa-wallet"></i> Budgeting tools and financial projections are provided for informational purposes only and do not constitute financial advice.</li>
            <li><i class="fas fa-exchange-alt"></i> Transactions tracked on the platform must comply with local financial regulations and tax laws.</li>
            <li><i class="fas fa-user-shield"></i> You are responsible for maintaining the confidentiality of your account credentials.</li>
            <li><i class="fas fa-ban"></i> We reserve the right to suspend or terminate accounts for misuse or violation of these terms.</li>
            <li><i class="fas fa-file-invoice-dollar"></i> Subscription fees, if applicable, are non-refundable after the trial period ends.</li>
            <li><i class="fas fa-sync-alt"></i> Data accuracy depends on user input; we are not liable for errors in user-provided financial information.</li>
        </ul>
        <p class="footer-text"><i class="fas fa-check-circle"></i> By using this platform, you accept these terms and conditions.</p>
    </div>
</body>
</html>