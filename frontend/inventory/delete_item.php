<?php
require_once 'includes/db_connect.php';
require_once 'includes/functions.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

$item = getItemById($id);
if (!$item) {
    header("Location: index.php");
    exit;
}

if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
    if (!empty($item['image']) && file_exists($item['image'])) {
        unlink($item['image']);
    }
    
    deleteItem($id);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Item</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        :root {
            --primary-color: #4CAF50;
            --danger-color: #f44336;
            --secondary-color: #212121;
            --text-light: #ffffff;
            --text-dark: #212121;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #1c1c1c;
            color: white;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 500px;
            background-color: #212121;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            border: 1px solid #333;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            color: var(--danger-color);
        }

        .warning-icon {
            font-size: 50px;
            color: var(--danger-color);
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 30px;
            font-size: 18px;
            line-height: 1.6;
        }

        .item-name {
            font-weight: bold;
            color: var(--danger-color);
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .btn {
            padding: 12px 30px;
            border-radius: 5px;
            border: none;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-danger {
            background-color: var(--danger-color);
            color: white;
        }

        .btn-secondary {
            background-color: #555;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <i class="fas fa-exclamation-triangle warning-icon"></i>
        <h1>Konfirmasi Hapus</h1>
        <p>Apakah Anda yakin ingin menghapus item <span class="item-name"><?= htmlspecialchars($item['name']) ?></span>?</p>
        <p>Tindakan ini tidak dapat dibatalkan.</p>
        <div class="buttons">
            <a href="delete_item.php?id=<?= $id ?>&confirm=yes" class="btn btn-danger">Hapus</a>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </div>
    </div>
</body>
</html>
