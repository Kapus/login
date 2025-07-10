<?php
/**
 * Database Configuration Template
 * 
 * Copy this file to 'database.php' and update with your actual database credentials.
 * The actual 'database.php' file is ignored by Git for security reasons.
 * 
 * Instructions:
 * 1. Copy this file: cp database.example.php database.php
 * 2. Edit database.php with your real database credentials
 * 3. Never commit database.php to version control
 */

// Database configuration
$host = 'localhost';           // Database host (usually localhost for XAMPP)
$dbname = 'login_system';      // Your database name
$username = 'root';            // Your database username (default: root for XAMPP)
$password = '';                // Your database password (default: empty for XAMPP)

// Optional: Database charset (recommended)
$charset = 'utf8mb4';

// Optional: Database port (uncomment if needed)
// $port = 3306;

try {
    // Create PDO connection
    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
    $pdo = new PDO($dsn, $username, $password);
    
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Set default fetch mode to associative array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // Disable prepared statement emulation for security
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
} catch(PDOException $e) {
    // Handle connection errors
    die("Database connection failed: " . $e->getMessage());
}

/*
 * Environment-specific configurations:
 * 
 * For Development:
 * - Use localhost
 * - Enable error reporting
 * - Use default XAMPP credentials
 * 
 * For Production:
 * - Use actual server credentials
 * - Disable error display
 * - Use strong database passwords
 * - Consider using environment variables
 */
?>
