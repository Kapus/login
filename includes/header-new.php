<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$is_logged_in = isset($_SESSION['user_id']);
$current_page = basename($_SERVER['PHP_SELF']);
?>

<header class="header">
    <div class="header-content">
        <div class="logo">
            <a href="index.php" style="color: white; text-decoration: none;">MyLogin System</a>
        </div>
        <nav class="nav">
            <a href="index.php" class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">Home</a>
            <?php if ($is_logged_in): ?>
                <a href="dashboard.php" class="<?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>">Dashboard</a>
                <a href="profile.php" class="<?php echo ($current_page == 'profile.php') ? 'active' : ''; ?>">Profile</a>
            <?php else: ?>
                <a href="login.php" class="<?php echo ($current_page == 'login.php') ? 'active' : ''; ?>">Login</a>
                <a href="register.php" class="<?php echo ($current_page == 'register.php') ? 'active' : ''; ?>">Register</a>
            <?php endif; ?>
        </nav>
    </div>
</header>

<?php if ($is_logged_in): ?>
<div class="sub-header">
    <div class="sub-header-content">
        <div class="page-info">
            Welcome back, <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>!
        </div>
        <div class="sub-header-actions">
            <a href="settings.php" title="Settings" class="settings-icon">⚙</a>
            <a href="notifications.php" title="Notifications" class="settings-icon">🔔</a>
            <a href="logout.php" title="Logout" class="logout-icon">×</a>
        </div>
    </div>
</div>
<?php endif; ?>
