<?php
require_once '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM history WHERE id = ?");
        $stmt->execute([$id]);

        header("Location: ../../frontend/app/repair.php");
        exit;
    } catch (PDOException $e) {
        die("Error deleting history: " . $e->getMessage());
    }
} else {
    header("Location: ../../frontend/app/repair.php");
    exit;
}
