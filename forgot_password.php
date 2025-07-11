<?php
require_once 'includes/functions.php';
redirectIfLoggedIn(); // Redirect if already logged in
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Login System</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'includes/header-new.php'; ?>
    
    <main class="main-content">
        <div class="login-container">
            <h2>Forgot Password</h2>
            
            <?php if (isset($_GET['error'])): ?>
                <div class="error-message">
                    <?php
                    switch($_GET['error']) {
                        case 'empty_email':
                            echo 'Please enter your email address.';
                            break;
                        case 'invalid_email':
                            echo 'Please enter a valid email address.';
                            break;
                        case 'email_not_found':
                            echo 'No account found with that email address.';
                            break;
                        case 'database_error':
                            echo 'Database error. Please try again later.';
                            break;
                        case 'email_error':
                            echo 'Failed to send reset email. Please try again.';
                            break;
                        default:
                            echo 'An error occurred. Please try again.';
                    }
                    ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($_GET['success'])): ?>
                <div class="success-message">
                    Password reset instructions have been sent to your email address. Please check your inbox and follow the instructions to reset your password.
                </div>
            <?php endif; ?>
            
            <form action="auth/forgot_password_process.php" method="POST">
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" required placeholder="Enter your email address" value="<?php echo e($_GET['email'] ?? ''); ?>">
                </div>
                
                <button type="submit" class="login-btn">Send Reset Instructions</button>
            </form>
            
            <div class="form-links">
                <a href="login.php">Back to Login</a>
                <a href="register.php">Don't have an account? Register</a>
            </div>
        </div>
    </main>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>
