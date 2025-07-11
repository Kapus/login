<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'includes/functions.php';

// Sample notifications data
$notifications = [
    [
        'id' => 1,
        'title' => 'Welcome to MyLogin System!',
        'message' => 'Thank you for joining our platform. Explore all the features available to you.',
        'type' => 'info',
        'read' => false,
        'created_at' => date('Y-m-d H:i:s', strtotime('-2 hours'))
    ],
    [
        'id' => 2,
        'title' => 'Profile Update',
        'message' => 'Your profile information has been successfully updated.',
        'type' => 'success',
        'read' => false,
        'created_at' => date('Y-m-d H:i:s', strtotime('-1 day'))
    ],
    [
        'id' => 3,
        'title' => 'Security Alert',
        'message' => 'A new login was detected from your account. If this wasn\'t you, please secure your account.',
        'type' => 'warning',
        'read' => true,
        'created_at' => date('Y-m-d H:i:s', strtotime('-3 days'))
    ],
    [
        'id' => 4,
        'title' => 'System Maintenance',
        'message' => 'Scheduled maintenance will occur on Sunday from 2:00 AM to 4:00 AM EST.',
        'type' => 'info',
        'read' => true,
        'created_at' => date('Y-m-d H:i:s', strtotime('-1 week'))
    ]
];

// Handle mark as read
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mark_read'])) {
    $notification_id = $_POST['notification_id'];
    // In a real application, you would update the database here
    // For now, we'll just show a success message
    $success_message = "Notification marked as read!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - MyLogin System</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .notifications-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }
        
        .notifications-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .notifications-header h1 {
            margin: 0;
            color: #333;
        }
        
        .mark-all-read {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
        }
        
        .notification-item {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 15px;
            overflow: hidden;
            transition: transform 0.2s ease;
        }
        
        .notification-item:hover {
            transform: translateY(-1px);
        }
        
        .notification-item.unread {
            border-left: 4px solid #007bff;
        }
        
        .notification-item.read {
            opacity: 0.8;
        }
        
        .notification-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px 10px 20px;
        }
        
        .notification-title {
            font-weight: 600;
            color: #333;
            margin: 0;
        }
        
        .notification-type {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
        }
        
        .type-info {
            background: #e3f2fd;
            color: #1976d2;
        }
        
        .type-success {
            background: #e8f5e8;
            color: #2e7d2e;
        }
        
        .type-warning {
            background: #fff3cd;
            color: #856404;
        }
        
        .type-error {
            background: #f8d7da;
            color: #721c24;
        }
        
        .notification-content {
            padding: 0 20px 15px 20px;
        }
        
        .notification-message {
            color: #666;
            line-height: 1.5;
            margin-bottom: 10px;
        }
        
        .notification-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: #999;
        }
        
        .notification-time {
            font-style: italic;
        }
        
        .mark-read-btn {
            background: none;
            border: 1px solid #007bff;
            color: #007bff;
            padding: 4px 8px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
        }
        
        .mark-read-btn:hover {
            background: #007bff;
            color: white;
        }
        
        .no-notifications {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }
        
        .no-notifications .icon {
            font-size: 48px;
            margin-bottom: 20px;
            opacity: 0.5;
        }
        
        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 4px;
            font-size: 14px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>
<body>
    <?php include 'includes/header-new.php'; ?>
    
    <div class="notifications-container">
        <div class="notifications-header">
            <h1>Notifications</h1>
            <a href="#" class="mark-all-read">Mark All as Read</a>
        </div>
        
        <?php if (isset($success_message)): ?>
            <div class="alert"><?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>
        
        <?php if (empty($notifications)): ?>
            <div class="no-notifications">
                <div class="icon">🔔</div>
                <h3>No notifications</h3>
                <p>You're all caught up! New notifications will appear here.</p>
            </div>
        <?php else: ?>
            <?php foreach ($notifications as $notification): ?>
                <div class="notification-item <?php echo $notification['read'] ? 'read' : 'unread'; ?>">
                    <div class="notification-header">
                        <h3 class="notification-title"><?php echo htmlspecialchars($notification['title']); ?></h3>
                        <span class="notification-type type-<?php echo $notification['type']; ?>">
                            <?php echo $notification['type']; ?>
                        </span>
                    </div>
                    <div class="notification-content">
                        <div class="notification-message">
                            <?php echo htmlspecialchars($notification['message']); ?>
                        </div>
                        <div class="notification-footer">
                            <span class="notification-time">
                                <?php echo date('M j, Y \a\t g:i A', strtotime($notification['created_at'])); ?>
                            </span>
                            <?php if (!$notification['read']): ?>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="notification_id" value="<?php echo $notification['id']; ?>">
                                    <button type="submit" name="mark_read" class="mark-read-btn">Mark as Read</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>
