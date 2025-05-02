<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Sparepart Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
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
        
        .sidebar {
            width: 340px;
            background-color: #1c1c1c;
            border-right: 1px solid #00a651;
            min-height: 100vh;
        }
        
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
        
        .content {
            background-image: url('../../images/backgrounds/background.png');
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
        
        .data-table-container {
            flex: 1;
            padding: 0 20px 20px 20px;
            overflow-x: auto;
        }
        
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .data-table th {
            text-align: left;
            padding: 12px 15px;
            background-color: #1c1c1c;
            color: white;
            border-bottom: 1px solid #333;
        }
        
        .data-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #333;
        }
        
        .stock-normal {
            color: #00a651;
            font-weight: bold;
        }
        
        .stock-medium {
            color: #ffa500;
            font-weight: bold;
        }
        
        .stock-low {
            color: #ff4500;
            font-weight: bold;
        }
        
        .stock-out {
            color: #ff0000;
            font-weight: bold;
        }
        
        .out-of-stock {
            background-color: rgba(255, 0, 0, 0.2);
            color: #ff0000;
            padding: 5px 10px;
            border: 1px solid #ff0000;
            border-radius: 15px;
            display: inline-block;
            font-size: 14px;
            text-align: center;
        }
        
        .action-btn {
            background-color: transparent;
            border: none;
            color: #00a651;
            cursor: pointer;
            margin-right: 10px;
            font-size: 16px;
        }
        
        .action-btn.delete {
            color: #ff4d4d;
        }
        
        /* Edit Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: end;
            align-items: center;
            z-index: 1000;
            display: none;
        }
        
        .edit-modal {
            background-color: #1c1c1c;
            border: 2px solid #00a651;
            border-radius: 10px;
            width: 500px;
            height: 90vh;
            padding: 20px;
            position: relative;
            overflow-y: auto;
        }
        
        .modal-title {
            font-size: 24px;
            margin-bottom: 20px;
            color: white;
        }
        
        .close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 24px;
            color: #00a651;
            background: none;
            border: none;
            cursor: pointer;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #00a651;
            font-size: 18px;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            background-color: #1c1c1c;
            border: 1px solid #333;
            border-radius: 5px;
            color: white;
            font-size: 16px;
        }
        
        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }
        
        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
        
        .btn {
            padding: 12px 0;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            width: 45%;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
        }
        
        .btn-save {
            background-color: #00a651;
            color: white;
        }
        
        .btn-cancel {
            background-color: transparent;
            border: 1px solid #00a651;
            color: #00a651;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo-container">
            <img class="logo" src="../../images/logo/Logo-group.png" alt="logo">
        </div>
        
        <a href="../../home_page/index.php" class="menu-item">
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
                <a href="../../management/data_customer/index.php" class="submenu-item">Data Constumer Management</a>
                <a href="../../management/data_sparepart/index.php" class="submenu-item active">Data Sparepart Management</a>
            </div>
        </div>
        
        <a href="../../inventory/index.php" class="menu-item">
            <i class="fas fa-boxes"></i>
            Inventory
        </a>
        
        <a href="../../repair_service/index.php" class="menu-item">
            <i class="fas fa-wrench"></i>
            Repair Service
        </a>
        
        <a href="../../help/index.php" class="menu-item">
            <i class="fas fa-question-circle"></i>
            Help
        </a>
        
        <a href="../../my_account/index.php" class="menu-item">
            <i class="fas fa-user"></i>
            My Account
        </a>
    </div>
    
    <div class="main-content">
        <div class="header">
            <h1>Data Sparepart Management</h1>
            <div class="user-info">
                <span class="email">Leopoldobenavent@reangel.com</span>
                <div class="user-icon">
                    <i class="fas fa-user"></i>
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
                <div class="settings-icon">
                    <i class="fas fa-sliders-h"></i>
                </div>
            </div>
        
            <div class="data-table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Stock</th>
                            <th>Brand</th>
                            <th>Location</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>SP001</td>
                            <td>Engine Oil 10W-40</td>
                            <td class="stock-normal">25</td>
                            <td>Castrol</td>
                            <td>Rack A-1</td>
                            <td>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>SP002</td>
                            <td>Air Filter Element</td>
                            <td class="stock-medium">18</td>
                            <td>Honda Genuine</td>
                            <td>Shelf A-5</td>
                            <td>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>SP003</td>
                            <td>Fuel Pump Assembly</td>
                            <td class="stock-low">5</td>
                            <td>Denso</td>
                            <td>Storage Room 1</td>
                            <td>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>SP004</td>
                            <td>Transmission Fluid</td>
                            <td class="stock-out">0</td>
                            <td>Shell Helix</td>
                            <td><span class="out-of-stock">Out of Stock</span></td>
                            <td>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit Sparepart Modal -->
    <div id="editModal" class="modal-overlay">
        <div class="edit-modal">
            <h2 class="modal-title">Edit Sparepart</h2>
            <button class="close-btn">&times;</button>
            
            <form id="editSparepartForm">
                <div class="form-group">
                    <label for="code">Code</label>
                    <input type="text" id="code" class="form-control" value="" readonly>
                </div>
                
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" class="form-control" value="">
                </div>
                
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" id="stock" class="form-control" value="" min="0">
                </div>
                
                <div class="form-group">
                    <label for="brand">Brand</label>
                    <input type="text" id="brand" class="form-control" value="">
                </div>
                
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" id="location" class="form-control" value="">
                </div>
                
                <div class="btn-container">
                    <button type="button" class="btn btn-save">Save</button>
                    <button type="button" class="btn btn-cancel">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script>
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
            
            // Search functionality
            const searchInput = document.querySelector('.search-input');
            const searchBtn = document.querySelector('.search-btn');
            const tableRows = document.querySelectorAll('.data-table tbody tr');
            
            searchBtn.addEventListener('click', function() {
                const searchValue = searchInput.value.toLowerCase();
                performSearch(searchValue);
            });
            
            searchInput.addEventListener('keyup', function(e) {
                if (e.key === 'Enter') {
                    const searchValue = searchInput.value.toLowerCase();
                    performSearch(searchValue);
                }
            });
            
            function performSearch(searchValue) {
                tableRows.forEach(row => {
                    const code = row.cells[0].textContent.toLowerCase();
                    const name = row.cells[1].textContent.toLowerCase();
                    const brand = row.cells[3].textContent.toLowerCase();
                    const location = row.cells[4].textContent.toLowerCase();
                    
                    if (code.includes(searchValue) || 
                        name.includes(searchValue) || 
                        brand.includes(searchValue) || 
                        location.includes(searchValue)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
            
            // Edit Modal functionality
            const editModal = document.getElementById('editModal');
            const editButtons = document.querySelectorAll('.action-btn.edit');
            const closeBtn = document.querySelector('.close-btn');
            const cancelBtn = document.querySelector('.btn-cancel');
            const saveBtn = document.querySelector('.btn-save');
            
            // Form fields
            const codeField = document.getElementById('code');
            const nameField = document.getElementById('name');
            const stockField = document.getElementById('stock');
            const brandField = document.getElementById('brand');
            const locationField = document.getElementById('location');
            
            // Open modal with sparepart data
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const row = this.closest('tr');
                    const code = row.cells[0].textContent;
                    const name = row.cells[1].textContent;
                    
                    // Get stock value (remove any non-numeric characters)
                    let stock = row.cells[2].textContent;
                    stock = stock.replace(/\D/g, '');
                    
                    const brand = row.cells[3].textContent;
                    
                    // For location, check if it's "Out of Stock" or a regular location
                    let location = row.cells[4].textContent;
                    if (location.includes('Out of Stock')) {
                        location = '';
                    }
                    
                    // Populate form fields
                    codeField.value = code;
                    nameField.value = name;
                    stockField.value = stock;
                    brandField.value = brand;
                    locationField.value = location;
                    
                    // Show modal
                    editModal.style.display = 'flex';
                });
            });
            
            // Close modal
            closeBtn.addEventListener('click', function() {
                editModal.style.display = 'none';
            });
            
            cancelBtn.addEventListener('click', function() {
                editModal.style.display = 'none';
            });
            
            // Save changes
            saveBtn.addEventListener('click', function() {
                // Get the updated values
                const code = codeField.value;
                const name = nameField.value;
                const stock = parseInt(stockField.value);
                const brand = brandField.value;
                const location = locationField.value;
                
                // In a real app, we would send this data to the server
                alert('Sparepart data updated for: ' + name + ' (' + code + ')');
                
                // Find the row in the table and update it
                const rows = document.querySelectorAll('.data-table tbody tr');
                rows.forEach(row => {
                    if (row.cells[0].textContent === code) {
                        row.cells[1].textContent = name;
                        
                        // Update stock with proper color coding
                        row.cells[2].textContent = stock;
                        row.cells[2].className = ''; // Clear all classes first
                        
                        if (stock > 20) {
                            row.cells[2].classList.add('stock-normal');
                        } else if (stock > 10) {
                            row.cells[2].classList.add('stock-medium');
                        } else if (stock > 0) {
                            row.cells[2].classList.add('stock-low');
                        } else {
                            row.cells[2].classList.add('stock-out');
                        }
                        
                        row.cells[3].textContent = brand;
                        
                        // Update location based on stock
                        if (stock <= 0) {
                            row.cells[4].innerHTML = '<span class="out-of-stock">Out of Stock</span>';
                        } else {
                            row.cells[4].textContent = location;
                        }
                    }
                });
                
                // Close modal
                editModal.style.display = 'none';
            });
            
            // Close modal when clicking outside
            window.addEventListener('click', function(e) {
                if (e.target === editModal) {
                    editModal.style.display = 'none';
                }
            });
            
            // Delete button functionality
            const deleteButtons = document.querySelectorAll('.action-btn.delete');
            
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const row = this.closest('tr');
                    const code = row.cells[0].textContent;
                    const name = row.cells[1].textContent;
                    if(confirm('Are you sure you want to delete ' + name + ' (' + code + ')?')) {
                        // Delete row (in a full implementation this would call an API)
                        row.remove();
                    }
                });
            });
            
            // Color-code stock levels
            const stockCells = document.querySelectorAll('.data-table tbody td:nth-child(3)');
            
            stockCells.forEach(cell => {
                const stockValue = parseInt(cell.textContent);
                
                if (stockValue > 20) {
                    cell.classList.add('stock-normal');
                } else if (stockValue > 10) {
                    cell.classList.add('stock-medium');
                } else if (stockValue > 0) {
                    cell.classList.add('stock-low');
                } else {
                    cell.classList.add('stock-out');
                }
            });
        });
    </script>
</body>
</html>