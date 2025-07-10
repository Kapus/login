<?php
// Check if user is logged in
$is_logged_in = isset($_SESSION['user_id']);
$current_page = basename($_SERVER['PHP_SELF']);
?>
<header class="header">
    <div class="header-content">
        <div class="logo">Your Website</div>
        <nav class="nav">
            <a href="index.php" <?php echo ($current_page == 'index.php') ? 'class="active"' : ''; ?>>Home</a>
            <a href="#about">About</a>
            <a href="#services">Services</a>
            <a href="#contact">Contact</a>
            <?php if ($is_logged_in): ?>
                <a href="profile.php" <?php echo ($current_page == 'profile.php') ? 'class="active"' : ''; ?>>Profile</a>
                <a href="auth/logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php" <?php echo ($current_page == 'login.php') ? 'class="active"' : ''; ?>>Login</a>
                <a href="register.php" <?php echo ($current_page == 'register.php') ? 'class="active"' : ''; ?>>Register</a>
            <?php endif; ?>
        </nav>
    </div>
</header>

<?php if ($is_logged_in): ?>
<div class="sub-header">
    <div class="sub-header-content">
        <div class="page-info">
            <?php
            // Dynamic page information for logged in users
            switch($current_page) {
                case 'index.php':
                    echo 'Welcome back to your dashboard';
                    break;
                case 'profile.php':
                    echo 'Manage your account settings';
                    break;
                case 'edit_profile.php':
                    echo 'Update your profile information';
                    break;
                default:
                    echo 'Secure member area';
            }
            ?>
        </div>
        <div class="sub-header-actions">
            <a href="edit_profile.php" class="settings-icon" title="Edit Profile">⚙️</a>
        </div>
    </div>
</div>
<?php endif; ?>
