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
    <title>Edit Profile - Login System</title>
    <link rel="stylesheet" href="css/styles.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <?php include 'includes/header-new.php'; ?>
    
    <main class="main-content">
        <div class="login-container">
            <h2>Edit Profile</h2>
            
            <?php if (isset($_GET['error'])): ?>
                <div class="error-message">
                    <?php
                    switch($_GET['error']) {
                        case 'empty_fields':
                            echo 'Please fill in all required fields.';
                            break;
                        case 'invalid_email':
                            echo 'Please enter a valid email address.';
                            break;
                        case 'email_exists':
                            echo 'This email address is already in use.';
                            break;
                        case 'username_exists':
                            echo 'This username is already taken.';
                            break;
                        case 'password_mismatch':
                            echo 'Passwords do not match.';
                            break;
                        case 'password_short':
                            echo 'Password must be at least 6 characters long.';
                            break;
                        case 'current_password_wrong':
                            echo 'Current password is incorrect.';
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
            
            <?php if (isset($_GET['success'])): ?>
                <div class="success-message">
                    <?php
                    switch($_GET['success']) {
                        case 'profile_updated':
                            echo 'Your profile has been updated successfully.';
                            break;
                        case 'password_changed':
                            echo 'Your password has been changed successfully.';
                            break;
                        default:
                            echo 'Changes saved successfully.';
                    }
                    ?>
                </div>
            <?php endif; ?>
            
            <!-- Single Form for All Updates -->
            <form action="auth/update_profile_process.php" method="POST">
                <input type="hidden" name="action" value="update_all">
                
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required value="<?php echo e($user['username']); ?>">
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" required value="<?php echo e($user['email']); ?>">
                </div>
                
                <div class="form-group">
                    <label for="current_password">Current Password (required for changes):</label>
                    <input type="password" id="current_password" name="current_password" placeholder="Enter current password to save changes">
                </div>
                
                <div class="form-group">
                    <label for="new_password">New Password (optional):</label>
                    <input type="password" id="new_password" name="new_password" placeholder="Leave blank to keep current password">
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Confirm New Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm new password if changing">
                </div>
                
                <button type="submit" class="login-btn">Update Profile</button>
            </form>
            
            <div class="form-links">
                <a href="profile.php">Back to Profile</a>
            </div>
        </div>
    </main>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>
