<?php
require_once 'includes/db_connect.php';
require_once 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header("Location: process_item.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Item</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        :root {
            --primary-color: #4CAF50;
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
            max-width: 600px;
            background-color: #212121;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
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

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 12px;
            border-radius: 5px;
            border: 1px solid #444;
            background-color: #333;
            color: white;
            font-size: 16px;
        }

        input[type="file"] {
            width: 100%;
            padding: 10px;
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
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            flex: 1;
            margin-right: 10px;
        }

        .btn-secondary {
            background-color: #555;
            color: white;
            flex: 1;
            margin-left: 10px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Item Baru</h1>
        <form action="process_item.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Nama Item *</label>
                <input type="text" name="name" id="name" required>
            </div>
            
            <div class="form-group">
                <label for="code">Kode Item</label>
                <input type="text" name="code" id="code">
            </div>
            
            <div class="form-group">
                <label for="brand">Merek</label>
                <input type="text" name="brand" id="brand">
            </div>
            
            <div class="form-group">
                <label for="location">Lokasi</label>
                <input type="text" name="location" id="location">
            </div>
            
            <div class="form-group">
                <label for="stock">Stok</label>
                <input type="number" name="stock" id="stock" value="0" min="0">
            </div>
            
            <div class="form-group">
                <label for="image">Gambar Produk</label>
                <input type="file" name="image" id="image" accept="image/*">
            </div>
            
            <div class="buttons">
                <button type="submit" name="add" class="btn btn-primary">Simpan</button>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>
