<?php
require_once 'config/database.php';
try {
    // Get all users and increment points if below 100
    $stmt = $pdo->query("SELECT id, points FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $updated = 0;
    foreach ($users as $user) {
        if ((int)$user['points'] < 100) {
            $stmt2 = $pdo->prepare("UPDATE users SET points = points + 1 WHERE id = ?");
            $stmt2->execute([$user['id']]);
            $updated++;
        }
    }
    // Get total points (sum) for all users
    $stmt = $pdo->query("SELECT SUM(points) as total_points FROM users");
    $total_points = $stmt->fetchColumn();
    echo json_encode(['success' => true, 'total_points' => (int)$total_points, 'users_updated' => $updated]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
