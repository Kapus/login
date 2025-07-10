<?php
session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = trim($_POST['token']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validate inputs
    if (empty($token) || empty($password) || empty($confirm_password)) {
        header('Location: ../reset_password.php?token=' . urlencode($token) . '&error=empty_fields');
        exit();
    }
    
    if ($password !== $confirm_password) {
        header('Location: ../reset_password.php?token=' . urlencode($token) . '&error=password_mismatch');
        exit();
    }
    
    if (strlen($password) < 6) {
        header('Location: ../reset_password.php?token=' . urlencode($token) . '&error=password_short');
        exit();
    }
    
    try {
        // Verify token is valid and not expired
        $stmt = $pdo->prepare("SELECT id, username, email FROM users WHERE reset_token = ? AND reset_expires > NOW()");
        $stmt->execute([$token]);
        $user = $stmt->fetch();
        
        if (!$user) {
            header('Location: ../reset_password.php?token=' . urlencode($token) . '&error=invalid_token');
            exit();
        }
        
        // Hash the new password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Update password and clear reset token
        $stmt = $pdo->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_expires = NULL WHERE id = ?");
        $stmt->execute([$hashed_password, $user['id']]);
        
        // Log the user in automatically after successful password reset
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        
        // Redirect to profile with success message
        header('Location: ../profile.php?success=password_reset');
        exit();
        
    } catch(PDOException $e) {
        header('Location: ../reset_password.php?token=' . urlencode($token) . '&error=database_error');
        exit();
    }
    
} else {
    header('Location: ../forgot_password.php');
    exit();
}
?>
