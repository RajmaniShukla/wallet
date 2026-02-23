<?php
/**
 * Database Connection Configuration - EXAMPLE FILE
 * 
 * SETUP:
 * 1. Copy this file to conn.php
 * 2. Replace placeholder values with your actual database credentials
 * 3. Never commit conn.php to version control
 */

$db_name1 = "wallet_db";           // Database name
$mysql_username = "your_username"; // Database username (never use 'root' in production)
$mysql_password = "your_password"; // Database password
$server_name = "localhost";        // Database host

// Create connection
$conn1 = mysqli_connect($server_name, $mysql_username, $mysql_password, $db_name1);

// Check connection
if (!$conn1) {
    error_log("Database connection failed: " . mysqli_connect_error());
    die("Connection failed. Please try again later.");
}

// Set charset for proper encoding
mysqli_set_charset($conn1, "utf8mb4");

/*
 * SECURITY NOTES:
 * - Use environment variables for credentials in production
 * - Create a dedicated database user with limited privileges
 * - Never expose connection errors to end users
 * 
 * EXAMPLE with environment variables:
 * 
 * $db_name1 = getenv('DB_NAME') ?: 'wallet_db';
 * $mysql_username = getenv('DB_USER') ?: 'root';
 * $mysql_password = getenv('DB_PASS') ?: '';
 * $server_name = getenv('DB_HOST') ?: 'localhost';
 */
?>
