<?php
require '../config/koneksi.php';

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'])) {
    $stmt = $pdo->prepare("DELETE FROM management WHERE id = ?");
    $result = $stmt->execute([$data['id']]);
    
    echo json_encode(['success' => $result]);
} else {
    echo json_encode(['success' => false, 'message' => 'Customer ID required']);
}
?>
