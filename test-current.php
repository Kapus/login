<?php
// Diagnostic page to identify redirect loop source
require_once 'includes/functions.php';

echo "<h1>Redirect Loop Diagnostic</h1>";
echo "<h2>Session Information:</h2>";
echo "<p>Session Status: " . session_status() . "</p>";
echo "<p>Session ID: " . session_id() . "</p>";
echo "<p>User ID in session: " . (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'Not set') . "</p>";
echo "<p>Username in session: " . (isset($_SESSION['username']) ? $_SESSION['username'] : 'Not set') . "</p>";
echo "<p>Is Logged In: " . (isLoggedIn() ? 'YES' : 'NO') . "</p>";

echo "<h2>Database Connection Test:</h2>";
try {
    require_once 'config/database.php';
    echo "<p>Database connection: SUCCESS</p>";
} catch (Exception $e) {
    echo "<p>Database connection: FAILED - " . $e->getMessage() . "</p>";
}

echo "<h2>Current User Test:</h2>";
try {
    $user = getCurrentUser();
    if ($user) {
        echo "<p>Current user data: " . print_r($user, true) . "</p>";
    } else {
        echo "<p>Current user data: NULL (not logged in or database issue)</p>";
    }
} catch (Exception $e) {
    echo "<p>Current user error: " . $e->getMessage() . "</p>";
}

echo "<h2>Page Links (test these carefully):</h2>";
echo '<p><a href="index.php">index.php</a> (should work)</p>';
echo '<p><a href="login.php">login.php</a> (may redirect if logged in)</p>';
echo '<p><a href="profile.php">profile.php</a> (may redirect if not logged in)</p>';
echo '<p><a href="register.php">register.php</a> (may redirect if logged in)</p>';
?>
<style>
body { font-family: Arial, sans-serif; margin: 20px; }
h1, h2 { color: #333; }
p { margin: 10px 0; }
a { color: #007bff; }
</style>
