<?php
session_start();
$_SESSION['user_id'] = 1;
$_SESSION['username'] = 'TestUser';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Test Meta Redirect Logout</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div style="max-width: 600px; margin: 40px auto; padding: 20px; text-align: center;">
        <h1>🧪 Test Meta Redirect Logout</h1>
        <p>You are logged in as: <strong>TestUser</strong></p>
        
        <div style="background: #e3f2fd; padding: 20px; border-radius: 5px; margin: 20px 0;">
            <h3>New Logout Method:</h3>
            <p>Click the 🚪 logout icon in the sub-header above</p>
            <p>You should see a "Logout Successful" page that redirects automatically</p>
        </div>
        
        <p>Or test directly:</p>
        <a href="logout.php" style="background: #dc3545; color: white; padding: 12px 24px; text-decoration: none; border-radius: 4px; font-weight: bold;">🚪 Test New Logout</a>
    </div>
</body>
</html>
