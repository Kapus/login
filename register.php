<?php
require_once 'includes/functions.php';
redirectIfLoggedIn(); // Redirect if already logged in
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Login System</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'includes/header-clean.php'; ?>
    
    <main class="main-content">
        <div class="login-container">
            <h2>Create New Account</h2>
            
            <?php if (isset($_GET['error'])): ?>
                <div class="error-message">
                    <?php
                    $errors = $_GET['error'];
                    if (!is_array($errors)) {
                        $errors = [$errors];
                    }
                    foreach ($errors as $error) {
                        switch($error) {
                            case 'empty_fields':
                                echo 'Please fill in all required fields.<br>';
                                break;
                            case 'invalid_email':
                                echo 'Please enter a valid email address.<br>';
                                break;
                            case 'password_mismatch':
                                echo 'Passwords do not match.<br>';
                                break;
                            case 'password_short':
                                echo 'Password must be at least 6 characters long.<br>';
                                break;
                            case 'username_exists':
                                echo 'Username already exists. Please choose a different one.<br>';
                                break;
                            case 'email_exists':
                                echo 'Email already registered. Please use a different email.<br>';
                                break;
                            case 'database_error':
                                echo 'Database error. Please try again later.<br>';
                                break;
                        }
                    }
                    ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($_GET['success'])): ?>
                <div class="success-message">
                    Account created successfully! You can now <a href="login.php">login</a>.
                </div>
            <?php endif; ?>
            
            <form action="auth/register_process.php" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required placeholder="Choose a username" value="<?php echo htmlspecialchars($_GET['username'] ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required placeholder="Enter your email address" value="<?php echo htmlspecialchars($_GET['email'] ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required placeholder="Enter a password (min 6 characters)">
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required placeholder="Confirm your password">
                </div>
                
                <button type="submit" class="login-btn">Create Account</button>
            </form>
            
            <div class="form-links">
                <a href="login.php">Already have an account? Login</a>
            </div>
        </div>
    </main>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>
