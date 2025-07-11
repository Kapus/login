<?php
session_start();
$_SESSION['user_id'] = 1;
$_SESSION['username'] = 'TestUser';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Test JavaScript Logout</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div style="max-width: 600px; margin: 40px auto; padding: 20px; text-align: center;">
        <h1>🧪 Test JavaScript Logout</h1>
        <p>You are logged in as: <strong>TestUser</strong></p>
        
        <div style="background: #fff3cd; padding: 20px; border-radius: 5px; margin: 20px 0;">
            <h3>New Method - JavaScript Form Submit:</h3>
            <p>The 🚪 logout icon now uses JavaScript to:</p>
            <ol style="text-align: left; display: inline-block;">
                <li>Create a hidden form</li>
                <li>Submit POST request to index.php</li>
                <li>Clear session and redirect with JavaScript</li>
            </ol>
            <p>This avoids PHP header redirect issues!</p>
        </div>
        
        <p><strong>Click the 🚪 logout icon in the sub-header above</strong></p>
        
        <div style="margin: 20px;">
            <p>Or test the function directly:</p>
            <button onclick="logoutUser()" style="background: #dc3545; color: white; padding: 12px 24px; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">🚪 Test JavaScript Logout</button>
        </div>
    </div>
</body>
</html>
