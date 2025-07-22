<!DOCTYPE html>
<html>
<head>
    <title>Header Debug</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .debug { background: #f0f0f0; padding: 10px; margin: 10px 0; border: 1px solid #ccc; }
        .error { background: #ffebee; color: #c62828; }
        .success { background: #e8f5e8; color: #2e7d2e; }
    </style>
</head>
<body>
    <div class="debug">
        <h2>Header Debug Test</h2>
        <p>This page will test if the header is working...</p>
    </div>

    <div class="debug">
        <h3>Before including header.php:</h3>
        <p>If you see this text, PHP is working.</p>
    </div>

    <?php
    echo '<div class="debug success"><p>✅ PHP is executing</p></div>';
    
    // Check if header file exists
    if (file_exists('includes/header.php')) {
        echo '<div class="debug success"><p>✅ header.php file exists</p></div>';
    } else {
        echo '<div class="debug error"><p>❌ header.php file NOT found</p></div>';
    }
    
    // Try to include the header
    echo '<div class="debug"><h3>Including header.php now:</h3></div>';
    
    ob_start();
    include 'includes/header.php';
    $header_output = ob_get_clean();
    
    if (!empty($header_output)) {
        echo '<div class="debug success"><p>✅ Header produced output (' . strlen($header_output) . ' characters)</p></div>';
        echo '<div class="debug"><h3>Header Output:</h3><div style="border: 2px solid blue; padding: 10px;">' . $header_output . '</div></div>';
    } else {
        echo '<div class="debug error"><p>❌ Header produced NO output</p></div>';
    }
    ?>

    <div class="debug">
        <h3>After header include:</h3>
        <p>End of test page.</p>
    </div>
</body>
</html>
