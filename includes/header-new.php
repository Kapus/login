<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$is_logged_in = isset($_SESSION['user_id']);
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<!-- Main Stylesheet -->
<link rel="stylesheet" href="css/styles.css">

<header class="header">
    <div class="header-content">
        <div class="logo">
            <a href="index.php" style="color: white; text-decoration: none;">MyLogin System</a>
        </div>
        <nav class="nav">
            <a href="index.php" class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">Home</a>
            <?php if ($is_logged_in): ?>
                <a href="dashboard.php" class="<?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>">Dashboard</a>
                <!-- Profile link removed from navbar -->
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
            <a href="profile.php" title="Profile" class="profile-icon"><i class="fa-solid fa-user-circle"></i></a>
            <a href="edit_profile.php" title="Settings" class="settings-icon"><i class="fa-solid fa-gear"></i></a>
            <a href="notifications.php" title="Notifications" class="settings-icon"><i class="fa-solid fa-bell"></i></a>
            <a href="logout.php" title="Logout" class="logout-icon"><i class="fa-solid fa-right-from-bracket"></i></a>
        </div>
    </div>
</div>
<?php endif; ?>
