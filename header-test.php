<?php
echo "Testing header include...<br>";
echo "Current directory: " . __DIR__ . "<br>";
echo "Header file exists: " . (file_exists('includes/header.php') ? 'YES' : 'NO') . "<br>";

if (file_exists('includes/header.php')) {
    echo "Header file size: " . filesize('includes/header.php') . " bytes<br>";
    echo "Including header now...<br><hr>";
    include 'includes/header.php';
    echo "<hr>Header included!<br>";
} else {
    echo "Header file not found!<br>";
}
?>
<h1>Main Content</h1>
<p>This should appear below the header.</p>
