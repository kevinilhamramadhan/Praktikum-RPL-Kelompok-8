<?php
session_start();
include '../config/koneksi.php'; // koneksi database PDO disiapkan di sini

// Ambil data dari form POST
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$employment = $_POST['employment'] ?? '';

// Ambil user ID dari session (pastikan sudah diset sebelumnya)
$adminId = $_SESSION['admin_id'] ?? null;
if (!$adminId) {
    header("Location: ../../frontend/app/myaccount.php?update=error_noadmin");
    exit;
}

// Default photo path dari session
$photoPath = $_SESSION['photo'] ?? '';

// Upload file foto jika ada
if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
    $uploadDir = '../uploads/profile_photos/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = basename($_FILES['photo']['name']);
    $targetFile = $uploadDir . time() . "_" . $fileName;

    if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {
        $photoPath = $targetFile;
    }
}

try {
    // Cek apakah profil sudah ada
    $stmt = $pdo->prepare("SELECT id FROM profil WHERE admin_id = ?");
    $stmt->execute([$adminId]);
    $profil = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($profil) {
        // Kalau profil sudah ada → update
        $profilId = $profil['id'];
        $sql = "UPDATE profil SET username = :username, email = :email, employment = :employment, photo = :photo WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':employment' => $employment,
            ':photo' => $photoPath,
            ':id' => $profilId
        ]);
    } else {
        // Kalau belum ada → insert
        $sql = "INSERT INTO profil (admin_id, username, email, employment, photo) VALUES (:admin_id, :username, :email, :employment, :photo)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':admin_id' => $adminId,
            ':username' => $username,
            ':email' => $email,
            ':employment' => $employment,
            ':photo' => $photoPath
        ]);
        $profilId = $pdo->lastInsertId();
        $_SESSION['profil_id'] = $profilId;
    }

    if ($stmt->rowCount() > 0) {
        // Update session variable
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['employment'] = $employment;
        $_SESSION['photo'] = $photoPath;
        header("Location: ../../frontend/app/myaccount.php?update=success");
    } else {
        header("Location: ../../frontend/app/myaccount.php?update=failed");
    }
} catch (PDOException $e) {
    // Tangani error PDO
    error_log("PDO Error: " . $e->getMessage());
    header("Location: ../../frontend/app/myaccount.php?update=error");
}
exit;
