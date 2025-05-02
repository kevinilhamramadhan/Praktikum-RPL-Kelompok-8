<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair Service</title>
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

        /* Table styling */
        .service-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .service-table th {
            background-color: #1E1E1E;
            color: var(--text-light);
            text-align: left;
            padding: 15px;
            font-size: 16px;
            border-bottom: 1px solid #333;
        }

        .service-table td {
            padding: 15px;
            border-bottom: 1px solid #333;
        }

        /* Action buttons */
        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .action-button {
            background-color: transparent;
            border: none;
            cursor: pointer;
            color: var(--text-light);
            font-size: 18px;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            transition: all 0.3s;
        }

        .edit-button {
            color: var(--primary-color);
        }

        .edit-button:hover {
            background-color: rgba(76, 175, 80, 0.2);
        }

        .delete-button {
            color: var(--danger-color);
        }

        .delete-button:hover {
            background-color: rgba(244, 67, 54, 0.2);
        }

        /* Control buttons */
        .controls-container {
            position: fixed;
            right: 30px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .control-button {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #333;
            border: 1px solid var(--primary-color);
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--primary-color);
            cursor: pointer;
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
        
        <a href="../inventory/index.php" class="menu-item">
            <i class="fas fa-boxes"></i>
            Inventory
        </a>
        
        <a href="../repair_service/index.php" class="menu-item active">
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
            <h1>Repair Service</h1>
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

            <!-- Service Table -->
            <table class="service-table">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Service Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>RS001</td>
                        <td>FairyFix Engine Check</td>
                        <td>Pemeriksaan & penyetelan mesin untuk performa optimal</td>
                        <td>
                            <div class="action-buttons">
                                <button class="action-button edit-button">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-button delete-button">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>RS002</td>
                        <td>SparkFly Brake Restore</td>
                        <td>Perbaikan dan penggantian sistem rem kendaraan</td>
                        <td>
                            <div class="action-buttons">
                                <button class="action-button edit-button">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-button delete-button">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>RS003</td>
                        <td>GreenGrip Suspension Care</td>
                        <td>Menstabilkan suspensi dan sistem kemudi agar nyaman & aman</td>
                        <td>
                            <div class="action-buttons">
                                <button class="action-button edit-button">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-button delete-button">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>RS004</td>
                        <td>LightLeaf Electrical Scan</td>
                        <td>Diagnosis sistem kelistrikan secara menyeluruh</td>
                        <td>
                            <div class="action-buttons">
                                <button class="action-button edit-button">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-button delete-button">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
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
                    const row = this.closest('tr');
                    const code = row.querySelector('td:first-child').textContent;
                    const serviceName = row.querySelector('td:nth-child(2)').textContent;
                    alert('Edit service: ' + code + ' - ' + serviceName);
                });
            });

            // Add click event to delete buttons
            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const row = this.closest('tr');
                    const code = row.querySelector('td:first-child').textContent;
                    const serviceName = row.querySelector('td:nth-child(2)').textContent;
                    if (confirm('Are you sure you want to delete service: ' + code + ' - ' + serviceName + '?')) {
                        row.remove();
                    }
                });
            });

            // Search functionality
            const searchInput = document.querySelector('.search-input');
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('.service-table tbody tr');
                
                rows.forEach(row => {
                    const code = row.querySelector('td:first-child').textContent.toLowerCase();
                    const serviceName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    const description = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                    
                    if (code.includes(searchTerm) || serviceName.includes(searchTerm) || description.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>