<?php
require_once 'includes/functions.php';
requireLogin();
$user_id = $_SESSION['user_id'];
require_once 'config/database.php';
try {
    $stmt = $pdo->prepare("SELECT points FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $points = (int)$stmt->fetchColumn();
    echo json_encode(['success' => true, 'points' => $points]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
