<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help</title>
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

        .help {
            overflow-y: auto;
            height: 75vh;
            padding: 20px;
        }

        /* Help content styling */
        .help-section {
            background-color: #212121;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #444;
        }

        .section-title {
            display: flex;
            align-items: center;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
            color: var(--text-light);
        }

        .section-title i {
            margin-right: 15px;
            color: var(--primary-color);
            font-size: 24px;
        }

        .help-list {
            list-style-type: none;
            padding-left: 40px;
        }

        .help-list li {
            padding: 8px 0;
            display: flex;
            align-items: center;
        }

        .help-list li::before {
            content: "•";
            color: var(--primary-color);
            font-weight: bold;
            display: inline-block;
            width: 1em;
            margin-left: -1em;
        }

        .help-link {
            color: var(--text-light);
            text-decoration: none;
            transition: color 0.3s;
        }

        .help-link:hover {
            color: var(--primary-color);
            text-decoration: underline;
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
        
        <a href="../repair_service/index.php" class="menu-item">
            <i class="fas fa-wrench"></i>
            Repair Service
        </a>
        
        <a href="../help/index.php" class="menu-item active">
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
            <h1>Help</h1>
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

            <div class="help">
                <!-- User Guide Section -->
                <div class="help-section">
                    <div class="section-title">
                        <i class="fas fa-tools"></i>
                        User Guide
                    </div>
                    <ul class="help-list">
                        <li><a href="#" class="help-link">Adding Sparepart Data</a></li>
                        <li><a href="#" class="help-link">Modifying Customer Info</a></li>
                        <li><a href="#" class="help-link">Viewing Reports</a></li>
                    </ul>
                </div>

                <!-- FAQ Section -->
                <div class="help-section">
                    <div class="section-title">
                        <i class="fas fa-question-circle"></i>
                        FAQ
                    </div>
                    <ul class="help-list">
                        <li><a href="#" class="help-link">How Do I Reset My Password?</a></li>
                        <li><a href="#" class="help-link">Why Can't I See My Data</a></li>
                        <li><a href="#" class="help-link">How To Fix A Stock Error?</a></li>
                    </ul>
                </div>

                <!-- Contact Us Section -->
                <div class="help-section">
                    <div class="section-title">
                        <i class="fas fa-envelope"></i>
                        Contact Us
                    </div>
                    <ul class="help-list">
                        <li><a href="#" class="help-link">E-mail Us</a></li>
                        <li><a href="#" class="help-link">Report A Bug</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript untuk pencarian di halaman help
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

            const searchInput = document.querySelector('.search-input');
            
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const helpLinks = document.querySelectorAll('.help-link');
                
                helpLinks.forEach(link => {
                    const linkText = link.textContent.toLowerCase();
                    const listItem = link.closest('li');
                    
                    if (linkText.includes(searchTerm)) {
                        listItem.style.display = '';
                    } else {
                        listItem.style.display = 'none';
                    }
                });
                
                // Jika semua link dalam satu bagian disembunyikan, sembunyikan juga bagiannya
                const sections = document.querySelectorAll('.help-section');
                sections.forEach(section => {
                    const visibleLinks = section.querySelectorAll('li[style=""]').length;
                    const visibleLinksAlt = section.querySelectorAll('li:not([style="display: none;"])').length;
                    
                    if (visibleLinks === 0 && visibleLinksAlt === 0) {
                        section.style.display = 'none';
                    } else {
                        section.style.display = '';
                    }
                });
            });
            
            // Tambahkan event listener untuk setiap help link
            const helpLinks = document.querySelectorAll('.help-link');
            helpLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const linkText = this.textContent;
                    alert('Membuka panduan: ' + linkText);
                });
            });
        });
    </script>
</body>
</html>