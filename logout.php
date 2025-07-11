<?php
session_start();

// Clear all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to index.php with logout success parameter
header("Location: index.php?logout=success");
exit();
?>
