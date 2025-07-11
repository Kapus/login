<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debug Test</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .debug { 
            background: yellow; 
            padding: 10px; 
            margin: 5px 0; 
            border: 1px solid red; 
        }
    </style>
</head>
<body>
    <div class="debug">BEFORE HEADER INCLUDE</div>
    
    <?php 
    // Enable all error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    echo '<div class="debug">PHP is working. Current directory: ' . __DIR__ . '</div>';
    echo '<div class="debug">Header file exists: ' . (file_exists('includes/header.php') ? 'YES' : 'NO') . '</div>';
    
    if (file_exists('includes/header.php')) {
        echo '<div class="debug">Header file size: ' . filesize('includes/header.php') . ' bytes</div>';
        echo '<div class="debug">Header file readable: ' . (is_readable('includes/header.php') ? 'YES' : 'NO') . '</div>';
    }
    
    echo '<div class="debug">About to include header...</div>';
    
    // Capture any output from the header
    ob_start();
    $header_included = false;
    try {
        include 'includes/header.php';
        $header_included = true;
    } catch (Exception $e) {
        echo '<div class="debug">EXCEPTION: ' . $e->getMessage() . '</div>';
    } catch (Error $e) {
        echo '<div class="debug">ERROR: ' . $e->getMessage() . '</div>';
    }
    $header_output = ob_get_clean();
    
    echo '<div class="debug">Header included: ' . ($header_included ? 'YES' : 'NO') . '</div>';
    echo '<div class="debug">Header output length: ' . strlen($header_output) . ' characters</div>';
    
    if (strlen($header_output) > 0) {
        echo '<div class="debug">Header output preview: ' . htmlspecialchars(substr($header_output, 0, 200)) . '...</div>';
    }
    
    // Output the actual header
    echo $header_output;
    ?>
    
    <div class="debug">AFTER HEADER INCLUDE</div>
    
    <main class="main-content">
        <h1>Debug Page</h1>
        <p>This page will help us see if the header is loading.</p>
        <p>If you see the header above this content, it's working!</p>
    </main>
</body>
</html>
