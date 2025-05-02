<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

        /* Main content styling */
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

        /* Search bar */
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

        /* Inventory grid */
        .inventory-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            overflow-y: auto;
            height: 75vh;
            padding: 20px;
        }

        .inventory-card {
            background-color: #212121;
            border-radius: 8px;
            padding: 20px;
            position: relative;
            border: 1px solid #444;
        }

        .inventory-card.low-stock {
            border: 1px solid var(--warning-color);
        }

        .inventory-card.out-of-stock {
            border: 1px solid var(--danger-color);
        }

        .close-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #555;
            cursor: pointer;
            font-size: 18px;
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

        .product-image {
            width: 100px;
            height: 100px;
            margin: 0 auto 15px;
            display: block;
            object-fit: contain;
            background-color: #fff;
            border-radius: 8px;
        }

        .product-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
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

        .product-details p {
            margin-bottom: 5px;
            display: flex;
            justify-content: space-between;
        }

        .product-details span {
            font-weight: bold;
        }

        .stock-value {
            font-weight: bold;
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
            top: 60px;
            left: 50%;
            transform: translateX(-50%);
            font-weight: bold;
            font-size: 14px;
        }

        .edit-button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            margin-top: 15px;
        }

        .edit-button.normal {
            background-color: var(--primary-color);
        }

        .edit-button.low-stock {
            background-color: var(--warning-color);
        }

        .edit-button.out-of-stock {
            background-color: var(--danger-color);
        }

        /* Add button */
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
        }

    </style>    
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-container">
            <img class="logo" src="../images/logo/Logo-group.png" alt="logo">
        </div>
        
        <a href="../home_page/index.php" class="menu-item">
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
                <a href="../management/data_customer/index.php" class="submenu-item">Data Constumer Management</a>
                <a href="../management/data_sparepart/index.php" class="submenu-item">Data Sparepart Management</a>
            </div>
        </div>
        
        <a href="../inventory/index.php" class="menu-item active">
            <i class="fas fa-boxes"></i>
            Inventory
        </a>
        
        <a href="../repair_service/index.php" class="menu-item">
            <i class="fas fa-wrench"></i>
            Repair Service
        </a>
        
        <a href="../help/index.php" class="menu-item">
            <i class="fas fa-question-circle"></i>
            Help
        </a>
        
        <a href="../my_account/index.php" class="menu-item">
            <i class="fas fa-user"></i>
            My Account
        </a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Inventory</h1>
            <div class="user-info">
                <span class="email">Leopoldobenavent@reangel.com</span>
                <div class="user-icon">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </div>
        <div class="content">
            <!-- Search Bar -->
            <div class="search-bar">
                <div class="search-container">
                    <input type="text" placeholder="Search" class="search-input">
                    <button class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <div class="settings-icon">
                    <i class="fas fa-sliders-h"></i>
                </div>
            </div>

            <!-- Inventory Grid -->
            <div class="inventory-grid">
                <!-- Item 1 -->
                <div class="inventory-card normal">
                    <div class="close-icon"><i class="fas fa-times"></i></div>
                    <img src="https://via.placeholder.com/100" alt="Engine Oil" class="product-image">
                    <h3 class="product-name normal">Engine Oil 10W-40</h3>
                    <div class="product-details">
                        <p>Code: <span>SP001</span></p>
                        <p>Brand: <span>Castrol</span></p>
                        <p>Location: <span>Rack A-1</span></p>
                        <p>Stock: <span class="stock-value normal">25</span></p>
                    </div>
                    <button class="edit-button normal">Edit</button>
                </div>

                <!-- Item 2 -->
                <div class="inventory-card normal">
                    <div class="close-icon"><i class="fas fa-times"></i></div>
                    <img src="https://via.placeholder.com/100" alt="Air Filter" class="product-image">
                    <h3 class="product-name normal">Air Filter Element</h3>
                    <div class="product-details">
                        <p>Code: <span>SP002</span></p>
                        <p>Brand: <span>Honda Genuine</span></p>
                        <p>Location: <span>Shelf A-5</span></p>
                        <p>Stock: <span class="stock-value normal">18</span></p>
                    </div>
                    <button class="edit-button normal">Edit</button>
                </div>

                <!-- Item 3 -->
                <div class="inventory-card low-stock">
                    <div class="close-icon"><i class="fas fa-times"></i></div>
                    <img src="https://via.placeholder.com/100" alt="Fuel Pump" class="product-image">
                    <h3 class="product-name low-stock">Fuel Pump Assembly</h3>
                    <div class="product-details">
                        <p>Code: <span>SP003</span></p>
                        <p>Brand: <span>Denso</span></p>
                        <p>Location: <span>Storage Room 1</span></p>
                        <p>Stock: <span class="stock-value low-stock">5</span></p>
                    </div>
                    <button class="edit-button low-stock">Edit</button>
                </div>

                <!-- Item 4 -->
                <div class="inventory-card out-of-stock">
                    <div class="close-icon"><i class="fas fa-times"></i></div>
                    <img src="https://via.placeholder.com/100" alt="Transmission Fluid" class="product-image">
                    <div class="out-of-stock-label">Out of Stock</div>
                    <h3 class="product-name out-of-stock">Transmission Fluid</h3>
                    <div class="product-details">
                        <p>Code: <span>SP004</span></p>
                        <p>Brand: <span>Shell Helix</span></p>
                        <p>Location: <span>Rack B-1</span></p>
                        <p>Stock: <span class="stock-value out-of-stock">0</span></p>
                    </div>
                    <button class="edit-button out-of-stock">Edit</button>
                </div>
            </div>

            <!-- Add Button -->
            <div class="add-button">
                <i class="fas fa-plus"></i>
            </div>
        </div>
    </div>

    <script>
        // Simple JavaScript for interactive features
        document.addEventListener('DOMContentLoaded', function() {
            // Submenu toggle
            const hasSubmenu = document.querySelector('.has-submenu');
            const submenuIcon = document.querySelector('.submenu-icon');
            const submenu = document.querySelector('.submenu');
            
            hasSubmenu.addEventListener('click', function(e) {
                if (e.target.closest('.submenu-item')) return;
                e.preventDefault();
                submenu.classList.toggle('submenu-open');
                submenuIcon.classList.toggle('rotate-icon');
            });
            
            // Add click event to edit buttons
            const editButtons = document.querySelectorAll('.edit-button');
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const cardElement = this.closest('.inventory-card');
                    const productName = cardElement.querySelector('.product-name').textContent;
                    alert('Edit functionality for: ' + productName);
                });
            });

            // Add click event to add button
            const addButton = document.querySelector('.add-button');
            addButton.addEventListener('click', function() {
                alert('Add new inventory item functionality');
            });

            // Add click event to close icons
            const closeIcons = document.querySelectorAll('.close-icon');
            closeIcons.forEach(icon => {
                icon.addEventListener('click', function() {
                    const cardElement = this.closest('.inventory-card');
                    const productName = cardElement.querySelector('.product-name').textContent;
                    if (confirm('Are you sure you want to remove ' + productName + ' from inventory?')) {
                        cardElement.remove();
                    }
                });
            });

            // Search functionality
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