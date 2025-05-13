-- Buat database (jika belum ada)
CREATE DATABASE IF NOT EXISTS inventory_db;
USE inventory_db;

-- Buat tabel inventory dengan kolom yang lebih lengkap
CREATE TABLE IF NOT EXISTS inventory (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    code VARCHAR(50) DEFAULT NULL,
    brand VARCHAR(100) DEFAULT NULL,
    location VARCHAR(100) DEFAULT NULL,
    stock INT DEFAULT 0,
    image VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Data awal untuk testing
INSERT INTO inventory (name, code, brand, location, stock, image) VALUES
