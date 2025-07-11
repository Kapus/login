<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
$current_page = 'dashboard.php';
include 'includes/header-new.php';
?>

<div class="main-content">
    <h1>Dashboard</h1>
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>!</p>
    <p>This is your dashboard.. You can add widgets, stats, or quick links here.</p>
</div>

<?php include 'includes/footer.php'; ?>
