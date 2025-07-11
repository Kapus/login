<?php
session_start();
$_SESSION['user_id'] = 1;
$_SESSION['username'] = 'TestUser';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Simple Logout Test</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div style="padding: 40px; text-align: center;">
        <h1>Simple Logout Test</h1>
        <p>Logged in as: TestUser</p>
        <p>Click the 🚪 logout icon in the sub-header above</p>
        
        <div style="margin: 30px 0; padding: 20px; background: #f8f9fa; border: 1px solid #ddd;">
            <p><strong>Alternative test:</strong></p>
            <a href="logout.php" style="background: #dc3545; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">Direct Logout Link</a>
        </div>
        
        <p><small>Both should redirect you to index.php</small></p>
    </div>
</body>
</html>
