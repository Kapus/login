<?php
// Diagnostic to check sub-header display
session_start();
echo "<h1>Sub-Header Diagnostic</h1>";

// Simulate being logged in
$_SESSION['user_id'] = 1;
$_SESSION['username'] = 'TestUser';

echo "<p>Session user_id: " . ($_SESSION['user_id'] ?? 'not set') . "</p>";
echo "<p>Session username: " . ($_SESSION['username'] ?? 'not set') . "</p>";

// Check if logged in variable works
$is_logged_in = isset($_SESSION['user_id']);
echo "<p>Is logged in check: " . ($is_logged_in ? 'TRUE' : 'FALSE') . "</p>";

echo "<hr>";
echo "<h2>Header Output:</h2>";
?>
<link rel="stylesheet" href="css/styles.css">
<?php include 'includes/header.php'; ?>

<style>
body { font-family: Arial, sans-serif; margin: 20px; }
.debug { background: #f0f0f0; padding: 10px; margin: 10px 0; }
</style>

<div class="debug">
    <h3>Expected Results:</h3>
    <p>✅ Main header should show: Home, Dashboard, Profile, Logout</p>
    <p>✅ Sub-header should show: Welcome message + 3 icons (⚙️ 🔔 🚪)</p>
</div>
