<?php
header('Content-Type: application/json');
require_once '../config/koneksi.php'; // pastikan koneksi kamu disimpan di file ini

try {
    $stmt = $pdo->query("SELECT * FROM management ORDER BY id ASC");
    $customers = $stmt->fetchAll();
    echo json_encode(['success' => true, 'data' => $customers]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
