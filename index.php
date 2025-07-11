<?php
require_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <main class="main-content">
        <?php if (isset($_GET['logout']) && $_GET['logout'] === 'success'): ?>
            <div style="background: #d4edda; color: #155724; padding: 15px; margin: 20px 0; border: 1px solid #c3e6cb; border-radius: 4px;">
                ✅ <strong>Logout successful!</strong> You have been logged out.
            </div>
        <?php endif; ?>
        
        <h1>Welcome to Our Website</h1>
        <p>This is the main content area. Your login system content can go here.</p>
    </main>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>