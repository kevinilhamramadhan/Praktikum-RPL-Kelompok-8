<?php
require '../config/koneksi.php';

$data = json_decode(file_get_contents('php://input'), true);

if (
    isset($data['id']) && isset($data['name']) && isset($data['contact'])
) {
    $stmt = $pdo->prepare("UPDATE management SET name = ?, contact = ?, address = ?, date_last_visit = ?, repair_service = ?, description = ?, progress = ? WHERE id = ?");
    $result = $stmt->execute([
        $data['name'],
        $data['contact'],
        $data['address'],
        $data['lastVisit'],
        $data['repairService'],
        $data['description'],
        $data['progress'],
        $data['id']
    ]);

    echo json_encode(['success' => $result]);
} else {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
}
?>
