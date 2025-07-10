<?php
// Database configuration
$host = 'localhost';
$dbname = 'login_system';
$username = 'root';  // Default XAMPP MySQL username
$password = '';      // Default XAMPP MySQL password (usually empty)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
