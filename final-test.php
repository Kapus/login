<?php
session_start();
$_SESSION['user_id'] = 1;
$_SESSION['username'] = 'TestUser';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Test Simple Logout</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div style="max-width: 600px; margin: 40px auto; padding: 20px; text-align: center;">
        <h1>🧪 Test Simple Logout</h1>
        <p>You are logged in as: <strong>TestUser</strong></p>
        
        <div style="background: #d4edda; padding: 20px; border-radius: 5px; margin: 20px 0;">
            <h3>✅ Back to Simple Approach:</h3>
            <p>Both logout methods now use the same simple logout.php:</p>
            <ul style="text-align: left; display: inline-block;">
                <li><strong>Main nav "Logout"</strong> → logout.php (works)</li>
                <li><strong>Sub-header 🚪 icon</strong> → logout.php (should work now)</li>
            </ul>
        </div>
        
        <p><strong>Try both:</strong></p>
        <p>1. Click "Logout" in main navigation</p>
        <p>2. Click 🚪 icon in sub-header</p>
        
        <p>Both should work the same way!</p>
    </div>
</body>
</html>
