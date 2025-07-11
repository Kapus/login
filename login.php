<?php
require_once 'includes/functions.php';
redirectIfLoggedIn(); // Redirect if already logged in
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Login System</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'includes/header-new.php'; ?>
    
    <main class="main-content">
        <div class="login-container">
            <h2>Login to Your Account</h2>
            
            <?php if (isset($_GET['error'])): ?>
                <div class="error-message">
                    <?php
                    switch($_GET['error']) {
                        case 'empty_fields':
                            echo 'Please fill in all fields.';
                            break;
                        case 'invalid_credentials':
                            echo 'Invalid username/email or password.';
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
            
            <form action="auth/login_process.php" method="POST">
                <div class="form-group">
                    <label for="username">Username or Email:</label>
                    <input type="text" id="username" name="username" required placeholder="Enter your username or email">
                </div>
                
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required placeholder="Enter your password">
                </div>
                
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>
                
                <button type="submit" class="login-btn">Login</button>
            </form>
            
            <div class="form-links">
                <a href="forgot_password.php">Forgot Password?</a>
                <a href="register.php">Create New Account</a>
            </div>
        </div>
    </main>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>
