<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Session Debug</h1>";
session_start();
echo "<p>Session ID: " . session_id() . "</p>";
echo "<p>Session Data:</p>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
echo "<p>Is logged in: " . (isset($_SESSION['user_id']) ? 'YES' : 'NO') . "</p>";

if (isset($_SESSION['user_id'])) {
    echo "<p>User ID: " . $_SESSION['user_id'] . "</p>";
}
if (isset($_SESSION['username'])) {
    echo "<p>Username: " . $_SESSION['username'] . "</p>";
}
?>
