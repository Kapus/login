<?php
// Database update script for password reset functionality
// Run this file to add reset token columns to existing users table

require_once 'config/database.php';

try {
    // Check if reset_token column exists
    $result = $pdo->query("SHOW COLUMNS FROM users LIKE 'reset_token'");
    
    if ($result->rowCount() == 0) {
        // Add reset_token column
        $pdo->exec("ALTER TABLE users ADD COLUMN reset_token VARCHAR(64) NULL AFTER remember_token");
        echo "Added 'reset_token' column to users table.<br>";
    } else {
        echo "Column 'reset_token' already exists.<br>";
    }
    
    // Check if reset_expires column exists
    $result = $pdo->query("SHOW COLUMNS FROM users LIKE 'reset_expires'");
    
    if ($result->rowCount() == 0) {
        // Add reset_expires column
        $pdo->exec("ALTER TABLE users ADD COLUMN reset_expires DATETIME NULL AFTER reset_token");
        echo "Added 'reset_expires' column to users table.<br>";
    } else {
        echo "Column 'reset_expires' already exists.<br>";
    }
    
    echo "<br>Database update completed successfully!<br>";
    echo "Password reset functionality is now available.<br>";
    echo "You can test it by visiting <a href='forgot_password.php'>forgot_password.php</a>";
    
} catch(PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
