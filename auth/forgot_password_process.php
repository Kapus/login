<?php
session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    
    // Validate email
    if (empty($email)) {
        header('Location: ../forgot_password.php?error=empty_email');
        exit();
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: ../forgot_password.php?error=invalid_email&email=' . urlencode($email));
        exit();
    }
    
    try {
        // Check if email exists
        $stmt = $pdo->prepare("SELECT id, username FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if (!$user) {
            header('Location: ../forgot_password.php?error=email_not_found&email=' . urlencode($email));
            exit();
        }
        
        // Generate reset token
        $reset_token = bin2hex(random_bytes(32));
        $reset_expires = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token expires in 1 hour
        
        // Store token in database
        $stmt = $pdo->prepare("UPDATE users SET reset_token = ?, reset_expires = ? WHERE id = ?");
        $stmt->execute([$reset_token, $reset_expires, $user['id']]);
        
        // Send reset email
        $reset_link = "http://" . $_SERVER['HTTP_HOST'] . "/login/reset_password.php?token=" . $reset_token;
        
        $to = $email;
        $subject = "Password Reset Request - Your Website";
        $message = "
        <html>
        <head>
            <title>Password Reset Request</title>
        </head>
        <body>
            <h2>Password Reset Request</h2>
            <p>Hello {$user['username']},</p>
            <p>You have requested to reset your password. Click the link below to reset your password:</p>
            <p><a href='{$reset_link}'>Reset Password</a></p>
            <p>If the link doesn't work, copy and paste this URL into your browser:</p>
            <p>{$reset_link}</p>
            <p><strong>This link will expire in 1 hour.</strong></p>
            <p>If you didn't request this password reset, please ignore this email.</p>
            <hr>
            <p>Best regards,<br>Your Website Team</p>
        </body>
        </html>
        ";
        
        // Email headers
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: noreply@yourwebsite.com" . "\r\n";
        
        // Send email (Note: This requires a mail server to be configured)
        if (mail($to, $subject, $message, $headers)) {
            header('Location: ../forgot_password.php?success=1');
            exit();
        } else {
            // For development, we'll simulate success since mail() might not work locally
            // In production, handle email sending errors appropriately
            header('Location: ../forgot_password.php?success=1');
            exit();
        }
        
    } catch(PDOException $e) {
        header('Location: ../forgot_password.php?error=database_error');
        exit();
    }
    
} else {
    header('Location: ../forgot_password.php');
    exit();
}
?>
