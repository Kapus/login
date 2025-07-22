<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'includes/functions.php';
require_once 'config/database.php';

$success_message = '';
$error_message = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_profile'])) {
        // Update profile information
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        
        if (empty($username) || empty($email)) {
            $error_message = "Username and email are required.";
        } else {
            try {
                // Get current user data
                $stmt = $pdo->prepare("SELECT username, email, password FROM users WHERE id = ?");
                $stmt->execute([$_SESSION['user_id']]);
                $user = $stmt->fetch();
                
                // Check if username/email already exists (excluding current user)
                $check_stmt = $pdo->prepare("SELECT id FROM users WHERE (username = ? OR email = ?) AND id != ?");
                $check_stmt->execute([$username, $email, $_SESSION['user_id']]);
                
                if ($check_stmt->fetch()) {
                    $error_message = "Username or email already exists.";
                } else {
                    // Update profile
                    $update_query = "UPDATE users SET username = ?, email = ?";
                    $params = [$username, $email];
                    
                    // If password is being changed
                    if (!empty($new_password)) {
                        if (!password_verify($current_password, $user['password'])) {
                            $error_message = "Current password is incorrect.";
                        } elseif ($new_password !== $confirm_password) {
                            $error_message = "New passwords do not match.";
                        } elseif (strlen($new_password) < 6) {
                            $error_message = "New password must be at least 6 characters long.";
                        } else {
                            $update_query .= ", password = ?";
                            $params[] = password_hash($new_password, PASSWORD_DEFAULT);
                        }
                    }
                    
                    if (empty($error_message)) {
                        $update_query .= " WHERE id = ?";
                        $params[] = $_SESSION['user_id'];
                        
                        $update_stmt = $pdo->prepare($update_query);
                        
                        if ($update_stmt->execute($params)) {
                            $_SESSION['username'] = $username;
                            $success_message = "Profile updated successfully!";
                        } else {
                            $error_message = "Error updating profile. Please try again.";
                        }
                    }
                }
            } catch (PDOException $e) {
                $error_message = "Database error. Please try again.";
            }
        }
    }
    
    if (isset($_POST['update_preferences'])) {
        // Update user preferences
        $theme = $_POST['theme'] ?? 'light';
        $notifications = isset($_POST['notifications']) ? 1 : 0;
        $email_updates = isset($_POST['email_updates']) ? 1 : 0;
        
        try {
            // Check if preferences table exists, create if not
            $pdo->exec("CREATE TABLE IF NOT EXISTS user_preferences (
                id INT PRIMARY KEY AUTO_INCREMENT,
                user_id INT NOT NULL,
                theme VARCHAR(20) DEFAULT 'light',
                notifications BOOLEAN DEFAULT 1,
                email_updates BOOLEAN DEFAULT 1,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                UNIQUE KEY unique_user (user_id)
            )");
            
            // Insert or update preferences
            $stmt = $pdo->prepare("INSERT INTO user_preferences (user_id, theme, notifications, email_updates) 
                                   VALUES (?, ?, ?, ?) 
                                   ON DUPLICATE KEY UPDATE 
                                   theme = VALUES(theme), 
                                   notifications = VALUES(notifications), 
                                   email_updates = VALUES(email_updates)");
            
            if ($stmt->execute([$_SESSION['user_id'], $theme, $notifications, $email_updates])) {
                $success_message = "Preferences updated successfully!";
            } else {
                $error_message = "Error updating preferences. Please try again.";
            }
        } catch (PDOException $e) {
            $error_message = "Database error. Please try again.";
        }
    }
}

// Get current user data
try {
    $stmt = $pdo->prepare("SELECT username, email, created_at FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user_data = $stmt->fetch();
    
    // Get user preferences
    $pref_stmt = $pdo->prepare("SELECT theme, notifications, email_updates FROM user_preferences WHERE user_id = ?");
    $pref_stmt->execute([$_SESSION['user_id']]);
    $preferences = $pref_stmt->fetch();
    
    // Set defaults if no preferences found
    if (!$preferences) {
        $preferences = [
            'theme' => 'light',
            'notifications' => 1,
            'email_updates' => 1
        ];
    }
} catch (PDOException $e) {
    $error_message = "Error loading user data.";
    $user_data = ['username' => 'User', 'email' => '', 'created_at' => date('Y-m-d H:i:s')];
    $preferences = ['theme' => 'light', 'notifications' => 1, 'email_updates' => 1];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - MyLogin System</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .settings-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }
        
        .settings-section {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            overflow: hidden;
        }
        
        .section-header {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            padding: 15px 20px;
            font-size: 18px;
            font-weight: 600;
        }
        
        .section-content {
            padding: 25px;
        }
        
        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .form-group {
            flex: 1;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #333;
        }
        
        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 15px;
        }
        
        .checkbox-group input[type="checkbox"] {
            width: auto;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: transform 0.2s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-1px);
        }
        
        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 4px;
            font-size: 14px;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        
        .info-item:last-child {
            border-bottom: none;
        }
        
        .info-label {
            font-weight: 500;
            color: #555;
        }
        
        .info-value {
            color: #333;
        }
    </style>
</head>
<body>
    <?php include 'includes/header-new.php'; ?>
    
    <div class="settings-container">
        <h1>Account Settings</h1>
        
        <?php if ($success_message): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>
        
        <?php if ($error_message): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        
        <!-- Account Information -->
        <div class="settings-section">
            <div class="section-header">
                Account Information
            </div>
            <div class="section-content">
                <div class="info-item">
                    <span class="info-label">User ID:</span>
                    <span class="info-value">#<?php echo $_SESSION['user_id']; ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Member Since:</span>
                    <span class="info-value"><?php echo date('F j, Y', strtotime($user_data['created_at'])); ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Account Status:</span>
                    <span class="info-value" style="color: #28a745;">Active</span>
                </div>
            </div>
        </div>
        
        <!-- Profile Settings -->
        <div class="settings-section">
            <div class="section-header">
                Profile Settings
            </div>
            <div class="section-content">
                <form method="POST">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" id="username" name="username" 
                                   value="<?php echo htmlspecialchars($user_data['username']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" 
                                   value="<?php echo htmlspecialchars($user_data['email']); ?>" required>
                        </div>
                    </div>
                    
                    <h4 style="margin: 25px 0 15px 0; color: #555;">Change Password (Optional)</h4>
                    
                    <div class="form-group">
                        <label for="current_password">Current Password:</label>
                        <input type="password" id="current_password" name="current_password" 
                               placeholder="Enter current password to change">
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="new_password">New Password:</label>
                            <input type="password" id="new_password" name="new_password" 
                                   placeholder="At least 6 characters">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm New Password:</label>
                            <input type="password" id="confirm_password" name="confirm_password" 
                                   placeholder="Confirm new password">
                        </div>
                    </div>
                    
                    <button type="submit" name="update_profile" class="btn-primary">Update Profile</button>
                </form>
            </div>
        </div>
        
        <!-- Preferences -->
        <div class="settings-section">
            <div class="section-header">
                Preferences
            </div>
            <div class="section-content">
                <form method="POST">
                    <div class="form-group">
                        <label for="theme">Theme:</label>
                        <select id="theme" name="theme">
                            <option value="light" <?php echo $preferences['theme'] == 'light' ? 'selected' : ''; ?>>Light</option>
                            <option value="dark" <?php echo $preferences['theme'] == 'dark' ? 'selected' : ''; ?>>Dark</option>
                            <option value="auto" <?php echo $preferences['theme'] == 'auto' ? 'selected' : ''; ?>>Auto</option>
                        </select>
                    </div>
                    
                    <div class="checkbox-group">
                        <input type="checkbox" id="notifications" name="notifications" 
                               <?php echo $preferences['notifications'] ? 'checked' : ''; ?>>
                        <label for="notifications">Enable notifications</label>
                    </div>
                    
                    <div class="checkbox-group">
                        <input type="checkbox" id="email_updates" name="email_updates" 
                               <?php echo $preferences['email_updates'] ? 'checked' : ''; ?>>
                        <label for="email_updates">Receive email updates</label>
                    </div>
                    
                    <button type="submit" name="update_preferences" class="btn-primary">Save Preferences</button>
                </form>
            </div>
        </div>
        
        <!-- Security -->
        <div class="settings-section">
            <div class="section-header">
                Security & Privacy
            </div>
            <div class="section-content">
                <div class="info-item">
                    <span class="info-label">Two-Factor Authentication:</span>
                    <span class="info-value" style="color: #ffc107;">Not Enabled</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Login Sessions:</span>
                    <span class="info-value">1 Active Session</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Last Password Change:</span>
                    <span class="info-value">Account Creation</span>
                </div>
                <p style="margin-top: 20px; color: #666; font-size: 14px;">
                    <strong>Security Tip:</strong> Use a strong, unique password and consider enabling two-factor authentication when available.
                </p>
            </div>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>
