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
    
    if ($action === 'update_all') {
        // Handle combined profile and password update
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        
        // Validate inputs
        if (empty($username) || empty($email) || empty($current_password)) {
            header('Location: ../edit_profile.php?error=empty_fields');
            exit();
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Location: ../edit_profile.php?error=invalid_email');
            exit();
        }
        
        // If new password is provided, validate it
        if (!empty($new_password)) {
            if ($new_password !== $confirm_password) {
                header('Location: ../edit_profile.php?error=password_mismatch');
                exit();
            }
            
            if (strlen($new_password) < 6) {
                header('Location: ../edit_profile.php?error=password_short');
                exit();
            }
        }
        
        try {
            // Get current user data and verify current password
            $stmt = $pdo->prepare("SELECT username, email, password FROM users WHERE id = ?");
            $stmt->execute([$user_id]);
            $current_user = $stmt->fetch();
            
            if (!$current_user || !password_verify($current_password, $current_user['password'])) {
                header('Location: ../edit_profile.php?error=current_password_wrong');
                exit();
            }
            
            // Check if username/email already exists (excluding current user)
            $check_stmt = $pdo->prepare("SELECT id FROM users WHERE (username = ? OR email = ?) AND id != ?");
            $check_stmt->execute([$username, $email, $user_id]);
            
            if ($check_stmt->fetch()) {
                header('Location: ../edit_profile.php?error=username_exists');
                exit();
            }
            
            // Prepare update query
            if (!empty($new_password)) {
                // Update profile with new password
                $update_stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update_stmt->execute([$username, $email, $hashed_password, $user_id]);
                
                $_SESSION['username'] = $username;
                header('Location: ../edit_profile.php?success=password_changed');
            } else {
                // Update profile only
                $update_stmt = $pdo->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
                $update_stmt->execute([$username, $email, $user_id]);
                
                $_SESSION['username'] = $username;
                header('Location: ../edit_profile.php?success=profile_updated');
            }
            exit();
            
        } catch (PDOException $e) {
            header('Location: ../edit_profile.php?error=database_error');
            exit();
        }
    }
    
} else {
    header('Location: ../edit_profile.php');
    exit();
}
?>
