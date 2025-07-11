<?php
echo "PHP is working!";
echo "<br>";
echo "Current directory: " . __DIR__;
echo "<br>";
echo "Session status: " . session_status();
session_start();
echo "<br>";
echo "Session started successfully!";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Test</title>
</head>
<body>
    <h1>Test Page</h1>
    <p>If you can see this, the server is working.</p>
</body>
</html>
