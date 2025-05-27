<?php
header('Content-Type: application/json');

// Include file koneksi (pastikan path-nya sesuai)
require_once '../config/koneksi.php';

// Ambil data dari body request JSON
$input = json_decode(file_get_contents("php://input"), true);

// Validasi minimal
if (!isset($input['name']) || !isset($input['contact'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Name and Contact are required.'
    ]);
    exit;
}

// Ambil data dari input
$name = $input['name'];
$contact = $input['contact'];
$address = $input['address'] ?? '';
$lastVisit = $input['lastVisit'] ?? null;
$repairService = $input['repairService'] ?? '';
$description = $input['description'] ?? '';
$progress = $input['progress'] ?? 'in-progress';

try {
    // Query insert ke tabel `management`
    $stmt = $pdo->prepare("INSERT INTO management 
        (name, contact, address, date_last_visit, repair_service, description, progress) 
        VALUES (:name, :contact, :address, :lastVisit, :repairService, :description, :progress)");

    $stmt->execute([
        ':name' => $name,
        ':contact' => $contact,
        ':address' => $address,
        ':lastVisit' => $lastVisit,
        ':repairService' => $repairService,
        ':description' => $description,
        ':progress' => $progress
    ]);

    echo json_encode([
        'success' => true,
        'message' => 'Customer added successfully.'
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>
