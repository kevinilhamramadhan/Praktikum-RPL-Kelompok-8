<?php
require_once 'db_connect.php';

/**
 * Mengambil semua item dari database
 * @return array
 */
function getAllItems() {
    global $pdo;
    $stmt = $pdo->query("SELECT id, name, code, brand, location, stock, image FROM inventory");
    return $stmt->fetchAll();
}

/**
 * Mengambil item berdasarkan ID
 * @param int $id
 * @return array|false
 */
function getItemById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM inventory WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

/**
 * Menambahkan item baru ke database
 * @param array $data
 * @return int ID dari item yang ditambahkan
 */
function addItem($data) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO inventory (name, code, brand, location, stock, image) 
                         VALUES (:name, :code, :brand, :location, :stock, :image)");
    $stmt->execute([
        ':name' => $data['name'],
        ':code' => $data['code'] ?? null,
        ':brand' => $data['brand'] ?? null,
        ':location' => $data['location'] ?? null,
        ':stock' => $data['stock'] ?? 0,
        ':image' => $data['image'] ?? null
    ]);
    return $pdo->lastInsertId();
}

/**
 * Mengupdate item yang sudah ada
 * @param int $id
 * @param array $data
 * @return bool
 */
function updateItem($id, $data) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE inventory SET 
                          name = :name, 
                          code = :code, 
                          brand = :brand, 
                          location = :location, 
                          stock = :stock,
                          image = :image
                          WHERE id = :id");
    return $stmt->execute([
        ':id' => $id,
        ':name' => $data['name'],
        ':code' => $data['code'] ?? null,
        ':brand' => $data['brand'] ?? null,
        ':location' => $data['location'] ?? null,
        ':stock' => $data['stock'] ?? 0,
        ':image' => $data['image'] ?? null
    ]);
}

/**
 * Menghapus item dari database
 * @param int $id
 * @return bool
 */
function deleteItem($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM inventory WHERE id = ?");
    return $stmt->execute([$id]);
}
?>