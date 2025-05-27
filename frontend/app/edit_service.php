<?php
require_once '../../backend/config/koneksi.php';

if (!isset($_GET['code'])) {
    die("Kode layanan tidak ditemukan.");
}

$code = $_GET['code'];

// Ambil data layanan dari DB
try {
    $stmt = $pdo->prepare("SELECT code, service_name, description FROM repair WHERE code = ?");
    $stmt->execute([$code]);
    $service = $stmt->fetch();

    if (!$service) {
        die("Layanan dengan kode $code tidak ditemukan.");
    }
} catch (PDOException $e) {
    die("Error fetching service: " . $e->getMessage());
}

// Proses update saat form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newName = $_POST['name'] ?? '';
    $newDesc = $_POST['description'] ?? '';

    if (!$newName || !$newDesc) {
        $error = "Semua field wajib diisi.";
    } else {
        try {
            $updateStmt = $pdo->prepare("UPDATE repair SET service_name = ?, description = ? WHERE code = ?");
            $updateStmt->execute([$newName, $newDesc, $code]);
            header("Location: repair.php"); // redirect ke halaman list setelah update
            exit;
        } catch (PDOException $e) {
            $error = "Gagal update layanan: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Service</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        /* Pakai style serupa form tambah */
        :root {
            --primary-color: #4CAF50;
            --secondary-color: #212121;
            --text-light: #ffffff;
            --text-dark: #212121;
        }
        body {
            background-color: #1c1c1c;
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            width: 100%;
            max-width: 600px;
            background-color: #212121;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            border: 1px solid #333;
        }
        h1 {
            margin-bottom: 30px;
            text-align: center;
            color: var(--primary-color);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        input[type="text"] {
            width: 100%;
            padding: 12px;
            border-radius: 5px;
            border: 1px solid #444;
            background-color: #333;
            color: white;
            font-size: 16px;
        }
        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
        .btn {
            padding: 12px 20px;
            border-radius: 5px;
            border: none;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            color: white;
            flex: 1;
        }
        .btn-primary {
            background-color: var(--primary-color);
            margin-right: 10px;
        }
        .btn-secondary {
            background-color: #555;
            margin-left: 10px;
            display: inline-block;
        }
        .error {
            background-color: #f44336;
            color: white;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Edit Service</h1>

    <?php if (!empty($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="" method="post">
        <div class="form-group">
            <label for="code">Code</label>
            <input type="text" id="code" name="code" value="<?= htmlspecialchars($service['code']) ?>" readonly>
        </div>

        <div class="form-group">
            <label for="name">Service Name *</label>
            <input type="text" id="name" name="name" required value="<?= htmlspecialchars($service['service_name']) ?>">
        </div>

        <div class="form-group">
            <label for="description">Description *</label>
            <input type="text" id="description" name="description" required value="<?= htmlspecialchars($service['description']) ?>">
        </div>

        <div class="buttons">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="repair.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
</body>
</html>
