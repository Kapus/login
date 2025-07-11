<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Header Include Test</h1>";
echo "<p>About to include header...</p>";

include 'includes/header.php';

echo "<p>Header included successfully!</p>";
?>
