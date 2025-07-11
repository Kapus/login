<!DOCTYPE html>
<html>
<head>
    <title>Basic Header Test</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        /* Basic debugging styles */
        .header { border: 3px solid red !important; background: blue !important; color: white !important; padding: 20px !important; }
        .debug { background: yellow; padding: 10px; margin: 10px; }
    </style>
</head>
<body>
    <div class="debug">BEFORE HEADER</div>
    
    <?php include 'includes/header.php'; ?>
    
    <div class="debug">AFTER HEADER</div>
    
    <div class="debug">
        <h3>If you don't see a blue header with red border above, there's an issue.</h3>
    </div>
</body>
</html>
