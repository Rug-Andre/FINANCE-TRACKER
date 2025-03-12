<?php
// db.php - Database connection file

$servername = "localhost"; // Database server (usually localhost for local development)
$username = "root"; // Database username
$password = ""; // Database password (empty for XAMPP default)
$dbname = "finance_tracker"; // Name of the database you're using

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
