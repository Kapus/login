<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<?php include 'includes/header-new.php'; ?>
<div class="main-content">
    <h1>Notifications</h1>
    <!-- No notifications to show -->
</div>
<?php include 'includes/footer.php'; ?>
