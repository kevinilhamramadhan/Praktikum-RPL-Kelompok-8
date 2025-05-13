<?php
require_once 'includes/db_connect.php';
require_once 'includes/functions.php';

// Fungsi untuk menangani upload gambar
function handleImageUpload() {
    if (!isset($_FILES['image']) || $_FILES['image']['error'] == UPLOAD_ERR_NO_FILE) {
        if (isset($_POST['current_image'])) {
            return $_POST['current_image'];
        }
        return null;
    }

    $uploadDir = 'inventory/images/products/';
    
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = time() . '_' . basename($_FILES['image']['name']);
    $targetFilePath = $uploadDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    if (in_array(strtolower($fileType), $allowTypes)) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
            return $fileName;
        }
    }

    return null;
}


// Proses tambah item
if (isset($_POST['add'])) {
    $data = [
        'name' => $_POST['name'],
        'code' => $_POST['code'] ?? null,
        'brand' => $_POST['brand'] ?? null,
        'location' => $_POST['location'] ?? null,
        'stock' => $_POST['stock'] ?? 0,
        'image' => handleImageUpload()
    ];
    
    addItem($data);
    header("Location: index.php");
    exit;
}

// Proses edit item
elseif (isset($_POST['edit']) && isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Handle image
    $imageUrl = handleImageUpload();
    if (!$imageUrl && isset($_POST['current_image'])) {
        $imageUrl = $_POST['current_image'];
    }
    
    $data = [
        'name' => $_POST['name'],
        'code' => $_POST['code'] ?? null,
        'brand' => $_POST['brand'] ?? null,
        'location' => $_POST['location'] ?? null,
        'stock' => $_POST['stock'] ?? 0,
        'image' => $imageUrl
    ];
    
    updateItem($id, $data);
    header("Location: index.php");
    exit;
}

// Jika tidak ada action yang cocok
header("Location: index.php");
exit;
?>