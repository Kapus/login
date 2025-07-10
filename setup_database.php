<?php
// Database setup script
// Run this file once to create the database and table

$host = 'localhost';
$username = 'root';
$password = '';

try {
    // Connect to MySQL server
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create database
    $pdo->exec("CREATE DATABASE IF NOT EXISTS login_system");
    echo "Database 'login_system' created successfully.<br>";
    
    // Use the database
    $pdo->exec("USE login_system");
    
    // Create users table
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        remember_token VARCHAR(255) NULL,
        reset_token VARCHAR(64) NULL,
        reset_expires DATETIME NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    $pdo->exec($sql);
    echo "Table 'users' created successfully.<br>";
    
    // Insert a sample user (password is 'password123')
    $hashedPassword = password_hash('password123', PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT IGNORE INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute(['testuser', 'test@example.com', $hashedPassword]);
    
    echo "Sample user created:<br>";
    echo "Username: testuser<br>";
    echo "Email: test@example.com<br>";
    echo "Password: password123<br><br>";
    
    echo "Database setup completed successfully!<br>";
    echo "You can now <a href='login.php'>login</a> with the test credentials.";
    
} catch(PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
