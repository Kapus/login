<?php
require_once 'includes/functions.php';
require_once 'config/database.php';
redirectIfLoggedIn(); // Redirect if already logged in

$token = $_GET['token'] ?? '';
$valid_token = false;
$user = null;

if (!empty($token)) {
    try {
        // Check if token is valid and not expired
        $stmt = $pdo->prepare("SELECT id, username, email FROM users WHERE reset_token = ? AND reset_expires > NOW()");
        $stmt->execute([$token]);
        $user = $stmt->fetch();
        
        if ($user) {
            $valid_token = true;
        }
    } catch(PDOException $e) {
        // Handle database error
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Login System</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'includes/header-new.php'; ?>
    
    <main class="main-content">
        <div class="login-container">
            <h2>Reset Password</h2>
            
            <?php if (!$valid_token): ?>
                <div class="error-message">
                    Invalid or expired password reset link. Please request a new password reset.
                </div>
                <div class="form-links">
                    <a href="forgot_password.php">Request New Reset</a>
                    <a href="login.php">Back to Login</a>
                </div>
            <?php else: ?>
                <?php if (isset($_GET['error'])): ?>
                    <div class="error-message">
                        <?php
                        switch($_GET['error']) {
                            case 'empty_fields':
                                echo 'Please fill in all fields.';
                                break;
                            case 'password_mismatch':
                                echo 'Passwords do not match.';
                                break;
                            case 'password_short':
                                echo 'Password must be at least 6 characters long.';
                                break;
                            case 'invalid_token':
                                echo 'Invalid or expired reset token.';
                                break;
                            case 'database_error':
                                echo 'Database error. Please try again later.';
                                break;
                            default:
                                echo 'An error occurred. Please try again.';
                        }
                        ?>
                    </div>
                <?php endif; ?>
                
                <p>Hello <?php echo e($user['username']); ?>, please enter your new password below:</p>
                
                <form action="auth/reset_password_process.php" method="POST">
                    <input type="hidden" name="token" value="<?php echo e($token); ?>">
                    
                    <div class="form-group">
                        <label for="password">New Password:</label>
                        <input type="password" id="password" name="password" required placeholder="Enter new password (min 6 characters)">
                    </div>
                    
                    <div class="form-group">
                        <label for="confirm_password">Confirm New Password:</label>
                        <input type="password" id="confirm_password" name="confirm_password" required placeholder="Confirm new password">
                    </div>
                    
                    <button type="submit" class="login-btn">Reset Password</button>
                </form>
                
                <div class="form-links">
                    <a href="login.php">Back to Login</a>
                </div>
            <?php endif; ?>
        </div>
    </main>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>
