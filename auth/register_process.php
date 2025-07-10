<?php
session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validation
    $errors = [];
    
    // Check if fields are empty
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $errors[] = 'empty_fields';
    }
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'invalid_email';
    }
    
    // Check password length
    if (strlen($password) < 6) {
        $errors[] = 'password_short';
    }
    
    // Check if passwords match
    if ($password !== $confirm_password) {
        $errors[] = 'password_mismatch';
    }
    
    // Check if username or email already exists
    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
            $stmt->execute([$username, $email]);
            $existing_user = $stmt->fetch();
            
            if ($existing_user) {
                // Check which one exists
                $stmt = $pdo->prepare("SELECT username, email FROM users WHERE username = ? OR email = ?");
                $stmt->execute([$username, $email]);
                $user_data = $stmt->fetch();
                
                if ($user_data['username'] === $username) {
                    $errors[] = 'username_exists';
                }
                if ($user_data['email'] === $email) {
                    $errors[] = 'email_exists';
                }
            }
        } catch(PDOException $e) {
            $errors[] = 'database_error';
        }
    }
    
    // If there are errors, redirect back with error messages
    if (!empty($errors)) {
        $error_param = 'error=' . implode('&error=', $errors);
        
        // Preserve form data (except passwords)
        $redirect_url = "../register.php?{$error_param}&username=" . urlencode($username) . "&email=" . urlencode($email);
        header("Location: $redirect_url");
        exit();
    }
    
    // If no errors, create the user
    try {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $hashed_password]);
        
        // Registration successful
        header('Location: ../register.php?success=1');
        exit();
        
    } catch(PDOException $e) {
        header('Location: ../register.php?error=database_error');
        exit();
    }
    
} else {
    // If not POST request, redirect to register page
    header('Location: ../register.php');
    exit();
}
?>
