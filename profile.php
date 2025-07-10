<?php
require_once 'includes/functions.php';
requireLogin(); // Check if user is logged in

// Get user information
$user = getCurrentUser();
if (!$user) {
    header('Location: login.php');
    exit();
}
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
    <?php include 'includes/header.php'; ?>
    
    <main class="main-content">
        <div class="profile-container">
            <h1>Welcome, <?php echo e($user['username']); ?>!</h1>
            <div class="profile-info">
                <div class="profile-item">
                    <label>Username:</label>
                    <span><?php echo e($user['username']); ?></span>
                </div>
                <div class="profile-item">
                    <label>Email:</label>
                    <span><?php echo e($user['email']); ?></span>
                </div>
                <div class="profile-item">
                    <label>Member Since:</label>
                    <span><?php echo date('F j, Y', strtotime($user['created_at'])); ?></span>
                </div>
            </div>
            
            <div class="profile-actions">
                <a href="#edit" class="btn btn-primary">Edit Profile</a>
                <a href="#settings" class="btn btn-secondary">Settings</a>
                <a href="auth/logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </main>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>
