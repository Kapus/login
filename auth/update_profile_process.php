<?php
session_start();
require_once '../config/database.php';
require_once '../includes/functions.php';

// Check if user is logged in
if (!isLoggedIn()) {
    header('Location: ../login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';
    $user_id = $_SESSION['user_id'];
    
    if ($action === 'update_basic') {
        // Handle basic information update
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        
        // Validate inputs
        if (empty($username) || empty($email)) {
            header('Location: ../edit_profile.php?error=empty_fields');
            exit();
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Location: ../edit_profile.php?error=invalid_email');
            exit();
        }
        
        try {
            // Check if username is taken by another user
            $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? AND id != ?");
            $stmt->execute([$username, $user_id]);
            if ($stmt->fetch()) {
                header('Location: ../edit_profile.php?error=username_exists');
                exit();
            }
            
            // Check if email is taken by another user
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
            $stmt->execute([$email, $user_id]);
            if ($stmt->fetch()) {
                header('Location: ../edit_profile.php?error=email_exists');
                exit();
            }
            
            // Update user information
            $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
            $stmt->execute([$username, $email, $user_id]);
            
            // Update session username if it changed
            $_SESSION['username'] = $username;
            
            header('Location: ../edit_profile.php?success=profile_updated');
            exit();
            
        } catch(PDOException $e) {
            header('Location: ../edit_profile.php?error=database_error');
            exit();
        }
        
    } elseif ($action === 'change_password') {
        // Handle password change
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        
        // Validate inputs
        if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
            header('Location: ../edit_profile.php?error=empty_fields');
            exit();
        }
        
        if ($new_password !== $confirm_password) {
            header('Location: ../edit_profile.php?error=password_mismatch');
            exit();
        }
        
        if (strlen($new_password) < 6) {
            header('Location: ../edit_profile.php?error=password_short');
            exit();
        }
        
        try {
            // Get current password hash from database
            $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
            $stmt->execute([$user_id]);
            $user = $stmt->fetch();
            
            if (!$user || !password_verify($current_password, $user['password'])) {
                header('Location: ../edit_profile.php?error=current_password_wrong');
                exit();
            }
            
            // Hash new password and update
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->execute([$hashed_password, $user_id]);
            
            header('Location: ../edit_profile.php?success=password_changed');
            exit();
            
        } catch(PDOException $e) {
            header('Location: ../edit_profile.php?error=database_error');
            exit();
        }
    }
    
} else {
    header('Location: ../edit_profile.php');
    exit();
}
?>
