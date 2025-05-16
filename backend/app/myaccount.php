<?php
session_start();
header('Content-Type: application/json');
include '../config/koneksi.php';

$admin_id = isset($_SESSION['admin_id']) ? (int)$_SESSION['admin_id'] : 0;

if ($admin_id === 0) {
    echo json_encode(['error' => 'Not logged in']);
    exit;
}

$sql = "SELECT username, email, jabatan, photo FROM admins WHERE id = $admin_id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $admin = $result->fetch_assoc();
    $admin['photo'] = $admin['photo'] ? 'uploads/' . $admin['photo'] : '../assets/Background.png';
    echo json_encode($admin);
} else {
    echo json_encode(['error' => 'User not found']);
}
?>
