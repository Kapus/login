<?php
// Test page to show working sub-header with logout
session_start();

// Simulate being logged in so we can see the sub-header
$_SESSION['user_id'] = 1;
$_SESSION['username'] = 'TestUser';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sub-Header Logout Test</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .test-info {
            background: #e8f4f8;
            padding: 20px;
            margin: 20px;
            border-left: 4px solid #007bff;
        }
        .logout-test {
            background: #fff3cd;
            padding: 15px;
            margin: 20px;
            border-left: 4px solid #ffc107;
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <main class="main-content">
        <div class="test-info">
            <h1>🧪 Sub-Header Logout Test</h1>
            <p><strong>You should see above:</strong></p>
            <ul>
                <li>🏠 Main header with: Home, Dashboard, Profile, Logout</li>
                <li>👋 Sub-header with: "Welcome back, TestUser!"</li>
                <li>🎛️ Three action icons: ⚙️ 🔔 🚪</li>
            </ul>
        </div>
        
        <div class="logout-test">
            <h2>🚪 Testing Logout Icon</h2>
            <p><strong>Click the 🚪 icon in the sub-header above</strong> - it should:</p>
            <ol>
                <li>Clear your session</li>
                <li>Redirect you to index.php</li>
                <li>Show only the guest header (Home, Login, Register)</li>
                <li>Hide the sub-header</li>
            </ol>
            
            <p><strong>Current session status:</strong></p>
            <ul>
                <li>User ID: <?php echo $_SESSION['user_id'] ?? 'Not set'; ?></li>
                <li>Username: <?php echo $_SESSION['username'] ?? 'Not set'; ?></li>
                <li>Logged in: <?php echo isset($_SESSION['user_id']) ? 'YES' : 'NO'; ?></li>
            </ul>
        </div>
        
        <div style="margin: 20px;">
            <p><strong>Alternative logout methods:</strong></p>
            <p><a href="logout.php" style="color: #dc3545; font-weight: bold; text-decoration: none; padding: 10px 15px; background: #f8f9fa; border: 1px solid #dc3545; border-radius: 4px;">🚪 Manual Logout Link</a></p>
        </div>
    </main>
</body>
</html>
