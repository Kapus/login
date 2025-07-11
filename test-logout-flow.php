<?php
// Quick test to show the logout flow working
session_start();
$_SESSION['user_id'] = 1;
$_SESSION['username'] = 'TestUser';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Test Logout Flow</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .test-container { max-width: 800px; margin: 20px auto; padding: 20px; }
        .instructions { background: #e3f2fd; padding: 15px; border-radius: 5px; margin: 20px 0; }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div class="test-container">
        <h1>🧪 Test Logout Flow</h1>
        
        <div class="instructions">
            <h3>Current Status: LOGGED IN as TestUser</h3>
            <p><strong>To test logout:</strong></p>
            <ol>
                <li>Look at the sub-header above - you should see "Welcome back, TestUser!" and 3 icons</li>
                <li><strong>Click the 🚪 logout icon</strong> in the sub-header</li>
                <li>You should be redirected to index.php</li>
                <li>You should see a green "Logout successful!" message</li>
                <li>The header should change to show: Home, Login, Register (no sub-header)</li>
            </ol>
        </div>
        
        <p><strong>Alternative:</strong> <a href="logout.php" style="color: #dc3545;">Click here to logout manually</a></p>
    </div>
</body>
</html>
