<?php

// This function should be in a file that's included at the top of your home.php

function getAccounts($userId) {
    // Database connection (replace with your actual DB credentials)
    $conn = new mysqli("localhost", "root", "", "finance_tracker");

    // Check if connection is successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to fetch accounts for the logged-in user
    $stmt = $conn->prepare("SELECT account_name, account_type, balance FROM accounts WHERE user_id = ?");
    $stmt->bind_param("i", $userId); // "i" stands for integer (user_id)
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch all the results
    $accounts = [];
    while ($row = $result->fetch_assoc()) {
        $accounts[] = $row;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    return $accounts; // Return the accounts array
}
