<?php
session_start();
// Simulate being logged in to see what shows
$_SESSION['user_id'] = 1;
$_SESSION['username'] = 'TestUser';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Check Current Header</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .debug { background: #f0f0f0; padding: 15px; margin: 20px; border: 1px solid #ccc; }
        .highlight { background: yellow; padding: 2px 5px; }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div class="debug">
        <h2>Current Header Status</h2>
        <p><strong>You are logged in as:</strong> TestUser</p>
        
        <h3>Main Navigation Should Show:</h3>
        <ul>
            <li>✅ Home</li>
            <li>✅ Dashboard</li>
            <li>✅ Profile</li>
            <li>❌ <span class="highlight">NO Logout (should be removed)</span></li>
        </ul>
        
        <h3>Sub-Header Should Show:</h3>
        <ul>
            <li>✅ Welcome message</li>
            <li>✅ ⚙️ Settings icon</li>
            <li>✅ 🔔 Notifications icon</li>
            <li>✅ 🚪 Logout icon (this one should remain)</li>
        </ul>
        
        <p><strong>If you still see "Logout" text in the main navigation, please let me know!</strong></p>
    </div>
</body>
</html>
