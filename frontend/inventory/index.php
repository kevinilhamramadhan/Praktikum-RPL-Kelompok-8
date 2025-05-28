<?php
session_start();
require_once 'includes/db_connect.php';
require_once 'includes/functions.php';
$items = getAllItems();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$adminId = $_SESSION['admin_id'];

// Prepare statement
$stmt = mysqli_prepare($conn, "SELECT email, photo FROM profil WHERE admin_id = ?");
mysqli_stmt_bind_param($stmt, "i", $adminId); // "i" untuk integer, ganti sesuai tipe data admin_id

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$profil = mysqli_fetch_assoc($result);

// Set nilai default jika data tidak ada
$email = !empty($profil['email']) ? $profil['email'] : 'Email not set';
$fotoProfil = !empty($profil['photo']) ? $profil['photo'] : null;
?>

<?php

$items = getAllItems();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <style>
        :root {
            --primary-color: #4CAF50;
            --secondary-color: #212121;
            --danger-color: #f44336;
            --warning-color: #FFC107;
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
        }

        /* Sidebar styling */
        .logo-container {
            border-bottom: 1px solid #333;
            display: flex;
            justify-content: center;
        }

        .logo {
            margin-right: 50px;
            align-items: center;
            height: 68px;
        }

        .sidebar {
            width: 340px;
            background-color: #1c1c1c;
            border-right: 1px solid #00a651;
            min-height: 100vh;
        }

        .menu-item {
            padding: 15px 20px;
            border-bottom: 1px solid #333;
            display: flex;
            align-items: center;
            color: #ccc;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .menu-item i {
            margin-right: 15px;
            width: 20px;
            text-align: center;
        }
        
        .menu-item:hover, .menu-item.active {
            background-color: #2a2a2a;
            color: #00a651;
            border-left: 4px solid #00a651;
        }
        
        .menu-item.active {
            color: #00a651;
        }
        
        .submenu {
            background-color: #222;
            overflow: hidden;
            max-height: 0;
            transition: max-height 0.3s ease-in-out;
        }
        
        .submenu-item {
            padding: 12px 20px 12px 55px;
            display: block;
            color: #ccc;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .submenu-item:hover {
            background-color: #2a2a2a;
            color: #00a651;
        }
        
        .submenu-item.active {
            color: #00a651;
            background-color: #2a2a2a;
        }
        
        .has-submenu {
            position: relative;
        }
        
        .submenu-icon {
            position: absolute;
            right: 20px;
            transition: transform 0.3s;
        }
        
        .submenu-open {
            max-height: 500px;
        }
        
        .rotate-icon {
            transform: rotate(180deg);
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background-color: #1c1c1c;
            border-bottom: 1px solid #00a651;
            max-height: 12vh;
        }
        
        .header h1 {
            color: white;
            font-size: 28px;
            font-weight: normal;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            color: #f5f5f5;
        }
        
        .user-info .email {
            margin-right: 15px;
        }
        
        .user-icon {
            width: 35px;
            height: 35px;
            background-color: #00a651;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .content {
            background-image: url('../images/backgrounds/background.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 88vh;
        }

        .search-bar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 10px 20px;
        }
        
        .search-container {
            display: flex;
            width: 250px;
            border: 1px solid #00a651;
            border-radius: 5px;
            overflow: hidden;
        }
        
        .search-input {
            flex: 1;
            padding: 8px 15px;
            border: none;
            background-color: #1c1c1c;
            color: white;
        }
        
        .search-btn {
            width: 40px;
            background-color: #1c1c1c;
            border: none;
            color: #00a651;
            cursor: pointer;
        }

        .settings-icon {
            color: #00a651;
            cursor: pointer;
            margin-left: 15px;
        }

        .inventory-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            overflow-y: auto;
            height: 75vh;
            padding: 20px;
        }

        .inventory-card {
            background-color: 'transparant';
            border-radius: 12px;
            padding: 20px;
            position: relative;
            border: 3px solid #444;
            display: flex;
            flex-direction: column;
            height: 400px;
            width : 250px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .inventory-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.3);
        }

        .inventory-card.low-stock {
            border: 3px solid var(--warning-color);
        }

        .inventory-card.out-of-stock {
            border: 3px solid var(--danger-color);
        }

        .inventory-card.normal {
            border: 3px solid var(--primary-color);
        }

        .close-icon {
            position: absolute;
            top: 12px;
            right: 12px;
            color: #555;
            cursor: pointer;
            font-size: 20px;
            z-index: 10;
            padding: 5px;
            border-radius: 50%;
            transition: background-color 0.2s ease;
        }

        .close-icon:hover {
            background-color: rgba(255,255,255,0.1);
        }

        .inventory-card.out-of-stock .close-icon {
            color: var(--danger-color);
        }

        .inventory-card.low-stock .close-icon {
            color: var(--warning-color);
        }

        .inventory-card.normal .close-icon {
            color: var(--primary-color);
        }

        .product-image-container {
            width: 150px;
            height: 200px;
            margin-bottom: 15px;
            margin: 40px auto 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            
        }

        .product-image {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .product-info {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            text-align: center;
            min-height: 22px;
            line-height: 1.2;
        }

        .product-name.out-of-stock {
            color: var(--danger-color);
        }

        .product-name.low-stock {
            color: var(--warning-color);
        }

        .product-name.normal {
            color: var(--primary-color);
        }

        .product-details {
            flex: 1;
            margin-bottom: 15px;
        }

        .product-details p {
            margin-bottom: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
        }

        .product-details span {
            font-weight: bold;
            text-align: right;
            max-width: 60%;
            word-break: break-word;
        }

        .stock-value {
            font-weight: bold;
            font-size: 16px;
        }

        .stock-value.out-of-stock {
            color: var(--danger-color);
        }

        .stock-value.low-stock {
            color: var(--warning-color);
        }

        .stock-value.normal {
            color: var(--primary-color);
        }

        .out-of-stock-label {
            background-color: var(--danger-color);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            text-align: center;
            position: absolute;
            top: 50px;
            left: 50%;
            transform: translateX(-50%);
            font-weight: bold;
            font-size: 12px;
            z-index: 5;
        }

        .edit-button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            display: inline-block;
            transition: background-color 0.2s ease, transform 0.1s ease;
            margin-top: auto;
        }

        .edit-button:hover {
            transform: translateY(-1px);
        }

        .edit-button.normal {
            background-color: var(--primary-color);
        }

        .edit-button.normal:hover {
            background-color: #45a049;
        }

        .edit-button.low-stock {
            background-color: var(--warning-color);
        }

        .edit-button.low-stock:hover {
            background-color: #e6a800;
        }

        .edit-button.out-of-stock {
            background-color: var(--danger-color);
        }

        .edit-button.out-of-stock:hover {
            background-color: #da190b;
        }

        .add-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background-color: var(--primary-color);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 30px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .add-button:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 12px rgba(0,0,0,0.4);
        }

        .no-items {
            grid-column: 1 / -1;
            text-align: center;
            padding: 40px;
            color: #ccc;
            font-size: 18px;
        }

    </style> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo-container">
            <img class="logo" src="../images/logo/Logo-group.png" alt="logo">
        </div>
        
        <a href="../app/homepage.php" class="menu-item">
            <i class="fas fa-home"></i>
            Home
        </a>
        
        <div class="has-submenu">
            <a href="#" class="menu-item">
                <i class="fas fa-clipboard-list"></i>
                Management
                <i class="fas fa-chevron-down submenu-icon rotate-icon"></i>
            </a>
            <div class="submenu">
                <a href="../app/data_customer.php" class="submenu-item">Data Constumer Management</a>
                <a href="../management/data_sparepart/index.php" class="submenu-item">Data Sparepart Management</a>
            </div>
        </div>
        
        <a href="../inventory/index.php" class="menu-item active">
            <i class="fas fa-boxes"></i>
            Inventory
        </a>
        
        <a href="../app/repair.php" class="menu-item">
            <i class="fas fa-wrench"></i>
            History Service
        </a>
        
        <a href="../app/help.php" class="menu-item">
            <i class="fas fa-question-circle"></i>
            Help
        </a>
        
        <a href="../app/myaccount.php" class="menu-item">
            <i class="fas fa-user"></i>
            My Account
        </a>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Inventory</h1>
                <div class="user-info">
                    <span class="email"><?php echo htmlspecialchars($email); ?></span>
                    <div class="user-icon">
                        <?php if ($fotoProfil): ?>
                            <img src="../../backend/profile_photos/<?php echo htmlspecialchars($fotoProfil); ?>" alt="Profile Photo" style="width: 35px; height: 35px; border-radius: 50%;">
                        <?php else: ?>
                            <i class="fas fa-user"></i>
                        <?php endif; ?>
                    </div>
                </div>
        </div>
        <div class="content">
            <div class="search-bar">
                <div class="search-container">
                    <input type="text" placeholder="Search" class="search-input">
                    <button class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                
            </div>

            <div class="inventory-grid">
                <?php if (empty($items)): ?>
                <div class="no-items">
                    <p>Tidak ada item di inventory. Silakan tambahkan item baru.</p>
                </div>
                <?php else: ?>
                    <?php foreach ($items as $item): ?>
                        <?php 
                        $stockClass = 'normal';
                        if ($item['stock'] <= 0) {
                            $stockClass = 'out-of-stock';
                        } elseif ($item['stock'] <= 5) {
                            $stockClass = 'low-stock';
                        }
                        ?>
                        <div class="inventory-card <?php echo $stockClass; ?>">
                            <div class="close-icon" data-id="<?php echo $item['id']; ?>"><i class="fas fa-times"></i></div>
                            
                            <div class="product-image-container">
                                <?php if (!empty($item['image'])): ?>
                                    <img src="inventory/images/products/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="product-image">
                                <?php else: ?>
                                    <img src="https://via.placeholder.com/100" alt="<?php echo htmlspecialchars($item['name']); ?>" class="product-image">
                                <?php endif; ?>
                            </div>
                            
                            <?php if ($stockClass === 'out-of-stock'): ?>
                                <div class="out-of-stock-label">Out of Stock</div>
                            <?php endif; ?>
                            
                            <div class="product-info">
                                <h3 class="product-name <?php echo $stockClass; ?>"><?php echo htmlspecialchars($item['name']); ?></h3>
                                <div class="product-details">
                                    <p>Code: <span><?php echo htmlspecialchars($item['code'] ?? 'N/A'); ?></span></p>
                                    <p>Brand: <span><?php echo htmlspecialchars($item['brand'] ?? 'N/A'); ?></span></p>
                                    <p>Location: <span><?php echo htmlspecialchars($item['location'] ?? 'N/A'); ?></span></p>
                                    <p>Stock: <span class="stock-value <?php echo $stockClass; ?>"><?php echo $item['stock']; ?></span></p>
                                </div>
                                <a href="edit_item.php?id=<?php echo $item['id']; ?>" class="edit-button <?php echo $stockClass; ?>">Edit</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="add-button">
                <a href="add_item.php" style="text-decoration: none; color: inherit;">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hasSubmenu = document.querySelector('.has-submenu');
            const submenuIcon = document.querySelector('.submenu-icon');
            const submenu = document.querySelector('.submenu');
            
            hasSubmenu.addEventListener('click', function(e) {
                if (e.target.closest('.submenu-item')) return;
                e.preventDefault();
                submenu.classList.toggle('submenu-open');
                submenuIcon.classList.toggle('rotate-icon');
            });
            
            const closeIcons = document.querySelectorAll('.close-icon');
            closeIcons.forEach(icon => {
                icon.addEventListener('click', function() {
                    const cardElement = this.closest('.inventory-card');
                    const productName = cardElement.querySelector('.product-name').textContent;
                    const itemId = this.getAttribute('data-id');
                    
                    if (confirm('Apakah Anda yakin ingin menghapus ' + productName + ' dari inventory?')) {
                        window.location.href = 'delete_item.php?id=' + itemId;
                    }
                });
            });

            const searchInput = document.querySelector('.search-input');
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const cards = document.querySelectorAll('.inventory-card');
                
                cards.forEach(card => {
                    const productName = card.querySelector('.product-name').textContent.toLowerCase();
                    const productCode = card.querySelector('.product-details p:nth-child(1) span').textContent.toLowerCase();
                    const productBrand = card.querySelector('.product-details p:nth-child(2) span').textContent.toLowerCase();
                    
                    if (productName.includes(searchTerm) || productCode.includes(searchTerm) || productBrand.includes(searchTerm)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>