<?php
session_start();
$_SESSION['user_id'] = 1;
$_SESSION['username'] = 'TestUser';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Test Direct Logout</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div style="max-width: 600px; margin: 40px auto; padding: 20px; text-align: center;">
        <h1>🧪 Test Direct Logout</h1>
        <p>You are logged in as: <strong>TestUser</strong></p>
        
        <div style="background: #e8f5e8; padding: 20px; border-radius: 5px; margin: 20px 0;">
            <h3>New Method - Direct to Index:</h3>
            <p>The 🚪 logout icon now goes directly to:</p>
            <code>index.php?action=logout</code>
            <p>This avoids the separate logout.php file completely!</p>
        </div>
        
        <p>Click the 🚪 logout icon in the sub-header above</p>
        
        <p>Or test manually:</p>
        <a href="index.php?action=logout" style="background: #dc3545; color: white; padding: 12px 24px; text-decoration: none; border-radius: 4px; font-weight: bold;">🚪 Test Direct Logout</a>
    </div>
</body>
</html>
