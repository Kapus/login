<?php
session_start();
$_SESSION['user_id'] = 1;
$_SESSION['username'] = 'TestUser';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Test Logout Redirect</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div style="max-width: 600px; margin: 40px auto; padding: 20px; text-align: center;">
        <h1>🧪 Test Logout Redirect</h1>
        <p>You are logged in as: <strong>TestUser</strong></p>
        <p>Click the 🚪 logout icon in the sub-header above.</p>
        <p>You should be redirected to index.php automatically.</p>
        
        <hr style="margin: 30px 0;">
        
        <p>Or test manually:</p>
        <a href="logout.php" style="background: #dc3545; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">🚪 Test Logout</a>
    </div>
</body>
</html>
