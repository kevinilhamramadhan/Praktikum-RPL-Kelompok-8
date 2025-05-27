<?php
session_start();
require_once '../config/koneksi.php';  // koneksi PDO $pdo

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST['code'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $sql = "INSERT INTO repair (code, service_name, description) VALUES (:code, :name, :description)";
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute([
            ':code' => $code,
            ':name' => $name,
            ':description' => $description
        ]);
        header("Location: ../../frontend/app/repair.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
