<?php
require_once 'includes/functions.php';
requireLogin(); // Check if user is logged in

// Get user information
$user = getCurrentUser();
// Removed the redundant redirect check since requireLogin() already handles this
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Login System</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'includes/header-new.php'; ?>
    
    <main class="main-content">
        <h1>Welcome, <?php echo e($user['username']); ?>!</h1>
        
        <?php if (isset($_GET['success'])): ?>
            <div class="success-message">
                <?php
                switch($_GET['success']) {
                    case 'password_reset':
                        echo 'Your password has been successfully reset and you have been logged in.';
                        break;
                    default:
                        echo 'Action completed successfully.';
                }
                ?>
            </div>
        <?php endif; ?>
        
        <p><strong>Username:</strong> <?php echo e($user['username']); ?></p>
        <p><strong>Email:</strong> <?php echo e($user['email']); ?></p>
        <p><strong>Member Since:</strong> <?php echo date('F j, Y', strtotime($user['created_at'])); ?></p>
        
        <!-- Logout link removed from profile page - logout is available in the header sub-navigation -->
    </main>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>
