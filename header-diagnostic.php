<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Header Diagnostic Test</h1>";
echo "<p>Testing header inclusion...</p>";

echo "<h2>File exists check:</h2>";
if (file_exists('includes/header.php')) {
    echo "<p style='color: green;'>✓ includes/header.php exists</p>";
    echo "<p>File size: " . filesize('includes/header.php') . " bytes</p>";
} else {
    echo "<p style='color: red;'>✗ includes/header.php does not exist</p>";
}

echo "<h2>Including header:</h2>";
echo "<div style='border: 2px solid blue; padding: 10px;'>";
include 'includes/header.php';
echo "</div>";

echo "<h2>Header included successfully!</h2>";
?>
