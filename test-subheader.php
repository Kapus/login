<?php
// Test sub-header with icons - updated version
session_start();
// Simulate being logged in
$_SESSION['user_id'] = 1;
$_SESSION['username'] = 'TestUser';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sub-Header Test - Updated</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .test-info {
            background: #e8f4f8;
            padding: 20px;
            margin: 20px;
            border-left: 4px solid #007bff;
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <main class="main-content">
        <div class="test-info">
            <h1>✅ Sub-Header Test - Updated</h1>
            <p><strong>You should now see:</strong></p>
            <ul>
                <li>🏠 Main header with: Home, Dashboard, Profile, Logout</li>
                <li>👋 Sub-header with: "Welcome back, TestUser!"</li>
                <li>🎛️ Three action icons: ⚙️ (Settings) 🔔 (Notifications) 🚪 (Logout)</li>
                <li>✨ Hover effects on the icons</li>
            </ul>
            
            <p><strong>Session Info:</strong></p>
            <ul>
                <li>User ID: <?php echo $_SESSION['user_id']; ?></li>
                <li>Username: <?php echo $_SESSION['username']; ?></li>
                <li>Logged in: <?php echo isset($_SESSION['user_id']) ? 'YES' : 'NO'; ?></li>
            </ul>
        </div>
        
        <p style="margin: 20px;"><a href="logout.php" style="color: #dc3545; font-weight: bold;">🚪 Click here to logout and return to guest view</a></p>
    </main>
</body>
</html>
