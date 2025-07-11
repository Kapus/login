<?php
session_start();
require_once 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);
    
    if (empty($username) || empty($password)) {
        header('Location: login.php?error=empty_fields');
        exit();
    }
    
    try {
        // Check if user exists (can login with username or email)
        $stmt = $pdo->prepare("SELECT id, username, email, password FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $username]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            // Login successful
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            
            // Handle "Remember me" functionality
            if ($remember) {
                // Set a cookie that lasts 30 days
                $token = bin2hex(random_bytes(16));
                setcookie('remember_token', $token, time() + (30 * 24 * 60 * 60), '/');
                
                // Store the token in database (you might want to create a separate table for this)
                $stmt = $pdo->prepare("UPDATE users SET remember_token = ? WHERE id = ?");
                $stmt->execute([$token, $user['id']]);
            }
            
            // Redirect to profile page
            header('Location: profile.php');
            exit();
        } else {
            // Login failed
            header('Location: login.php?error=invalid_credentials');
            exit();
        }
    } catch(PDOException $e) {
        header('Location: login.php?error=database_error');
        exit();
    }
} else {
    // If not POST request, redirect to login page
    header('Location: login.php');
    exit();
}
?>
