<?php
// config/db.php - Database connection

// Database configuration
$db_host = 'localhost';      // Server where MySQL is running (usually localhost)
$db_user = 'root';           // MySQL username (default for XAMPP is 'root')
$db_pass = '';               // MySQL password (default for XAMPP is empty)
$db_name = 'logbook_db';     // Name of the database we created

// Create connection using mysqli
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check if connection was successful
if (!$conn) {
    // If connection fails, stop script and show error
    die("Connection failed: " . mysqli_connect_error());
}

// Optional: Set charset to UTF-8 for proper encoding
mysqli_set_charset($conn, "utf8");
?>