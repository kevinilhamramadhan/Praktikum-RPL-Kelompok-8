// Global variables
let isEditMode = false;
let currentEditingRow = null;

// DOM elements
const modal = document.getElementById('editModal');
const addCustomerBtn = document.getElementById('addCustomerBtn');
const closeBtn = document.querySelector('.close-btn');
const saveBtn = document.querySelector('.btn-save');
const cancelBtn = document.querySelector('.btn-cancel');
const modalTitle = document.querySelector('.modal-title');
const editForm = document.getElementById('editCustomerForm');

// Form fields
const nameField = document.getElementById('name');
const contactField = document.getElementById('contact');
const addressField = document.getElementById('address');
const lastVisitField = document.getElementById('lastVisit');
const repairServiceField = document.getElementById('repairService');
const descriptionField = document.getElementById('description');
const progressField = document.getElementById('progress');

// Event listeners
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
    // Add customer button
    addCustomerBtn.addEventListener('click', openAddCustomerModal);
    
    // Close modal buttons
    closeBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);
    
    // Save button
    saveBtn.addEventListener('click', handleSaveCustomer);
    
    // Close modal when clicking outside
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });
    
    // Edit and delete buttons for existing rows
    attachRowEventListeners();
    
    // Prevent form submission
    editForm.addEventListener('submit', function(e) {
        e.preventDefault();
    });

    //load customer
        attachRowEventListeners();
    editForm.addEventListener('submit', function(e) {
        e.preventDefault();
    });

    // Load data from DB
    loadCustomersFromDatabase();
});



// Fetch and display data from database
async function loadCustomersFromDatabase() {
    try {
        const response = await fetch('../../backend/db/get_customer.php');
        const result = await response.json();

        if (result.success) {
            result.data.forEach((customer) => {
                addNewRowToTable({
                    id: customer.id,
                    name: customer.name,
                    contact: customer.contact,
                    address: customer.address || '',
                    lastVisit: customer.date_last_visit, // Format: YYYY-MM-DD
                    repairService: customer.repair_service || '',
                    description: customer.description || '',
                    progress: customer.progress || 'in-progress'
                });
            });
        } else {
            alert('Failed to fetch customers: ' + result.message);
        }
    } catch (error) {
        console.error('Error loading customers:', error);
        alert('Error loading customer data.');
    }
}



// Open modal for adding new customer
function openAddCustomerModal() {
    isEditMode = false;
    currentEditingRow = null;
    modalTitle.textContent = 'Add Customer';
    clearForm();
    modal.style.display = 'flex';
}

// Open modal for editing existing customer
function openEditCustomerModal(row) {
    isEditMode = true;
    currentEditingRow = row;
    modalTitle.textContent = 'Edit Customer';
    populateFormWithRowData(row);
    modal.style.display = 'flex';
}

// Close modal
function closeModal() {
    modal.style.display = 'none';
    clearForm();
    isEditMode = false;
    currentEditingRow = null;
}

// Clear form fields
function clearForm() {
    nameField.value = '';
    contactField.value = '';
    addressField.value = '';
    lastVisitField.value = '';
    repairServiceField.value = '';
    descriptionField.value = '';
    progressField.value = '';
}

// Populate form with existing row data
function populateFormWithRowData(row) {
    const cells = row.querySelectorAll('td');
    nameField.value = cells[1].textContent;
    contactField.value = cells[2].textContent;
    addressField.value = cells[3].getAttribute('title') || cells[3].textContent;
    
    // Convert date format from DD/MM/YYYY to YYYY-MM-DD for date input
    const dateText = cells[4].textContent;
    if (dateText && dateText !== '') {
        const dateParts = dateText.split('/');
        if (dateParts.length === 3) {
            lastVisitField.value = `${dateParts[2]}-${dateParts[1].padStart(2, '0')}-${dateParts[0].padStart(2, '0')}`;
        }
    }
    
    repairServiceField.value = cells[5].textContent;
    descriptionField.value = cells[6].getAttribute('title') || cells[6].textContent;
    
    // Set progress status
    const statusBadge = cells[7].querySelector('.status-badge');
    if (statusBadge.classList.contains('complete')) {
        progressField.value = 'complete';
    } else if (statusBadge.classList.contains('in-progress')) {
        progressField.value = 'in-progress';
    }
}


// Handle save customer (both add and edit)
async function handleSaveCustomer() {
    // Validate required fields
    if (!nameField.value.trim() || !contactField.value.trim()) {
        alert('Name and Contact are required fields');
        return;
    }
    
    // Prepare data
    const customerData = {
        name: nameField.value.trim(),
        contact: contactField.value.trim(),
        address: addressField.value.trim(),
        lastVisit: lastVisitField.value || null,
        repairService: repairServiceField.value.trim(),
        description: descriptionField.value.trim(),
        progress: progressField.value || 'in-progress'
    };
    
    if (isEditMode) {
        const id = currentEditingRow.getAttribute('data-id');
        customerData.id = id;

        try {
            const response = await fetch('../../backend/db/update_customer.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(customerData)
            });

            const result = await response.json();

            if (result.success) {
                updateTableRow(currentEditingRow, customerData);
                closeModal();
                showSuccessMessage('Customer updated successfully');
            } else {
                alert('Error updating customer: ' + result.message);
            }
        } catch (error) {
            console.error('Error updating customer:', error);
            alert('Error updating customer. Please try again.');
        }
    } else {
        // Handle add mode (send to server)
        try {
            saveBtn.disabled = true;
            saveBtn.textContent = 'Saving...';
            
            const response = await fetch('../../backend/db/add_customer.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(customerData)
            });
            
            const result = await response.json();
            
            if (result.success) {
                // Do not add new row to table, just close the modal
                addNewRowToTable(customerData);
                closeModal();
                showSuccessMessage('Customer added successfully');
            } else {
                alert('Error: ' + result.message);
            }
        } catch (error) {
            console.error('Error saving customer:', error);
            alert('Error saving customer. Please try again.');
        } finally {
            saveBtn.disabled = false;
            saveBtn.textContent = 'Save';
        }
    }
}


// Add new row to table
function addNewRowToTable(customerData) {
    const tableBody = document.querySelector('.data-table tbody');
    const rowCount = tableBody.querySelectorAll('tr').length + 1;
    
    // Format date for display
    let displayDate = '';
    if (customerData.lastVisit) {
        const date = new Date(customerData.lastVisit);
        displayDate = `${date.getDate().toString().padStart(2, '0')}/${(date.getMonth() + 1).toString().padStart(2, '0')}/${date.getFullYear()}`;
    }
    
    // Truncate long text
    const truncatedAddress = customerData.address.length > 12 ? customerData.address.substring(0, 12) + '...' : customerData.address;
    const truncatedDescription = customerData.description.length > 30 ? customerData.description.substring(0, 30) + '...' : customerData.description;
    
    // Create status badge
    const statusClass = customerData.progress === 'complete' ? 'complete' : 'in-progress';
    const statusText = customerData.progress === 'complete' ? 'Complete' : 'In Progress';
    
    const newRow = document.createElement('tr');
    newRow.setAttribute('data-id', customerData.id || '');
    newRow.innerHTML = `
        <td>${rowCount}.</td>
        <td>${customerData.name}</td>
        <td>${customerData.contact}</td>
        <td class="truncate" title="${customerData.address}">${truncatedAddress}</td>
        <td>${displayDate}</td>
        <td>${customerData.repairService}</td>
        <td class="truncate" title="${customerData.description}">${truncatedDescription}</td>
        <td><span class="status-badge ${statusClass}">${statusText}</span></td>
        <td>
            <button class="action-btn edit"><i class="fas fa-edit"></i></button>
            <button class="action-btn delete"><i class="fas fa-trash-alt"></i></button>
        </td>
    `;
    
    tableBody.appendChild(newRow);
    attachRowEventListeners();
}

// Update existing table row
function updateTableRow(row, customerData) {
    const cells = row.querySelectorAll('td');
    
    // Format date for display
    let displayDate = '';
    if (customerData.lastVisit) {
        const date = new Date(customerData.lastVisit);
        displayDate = `${date.getDate().toString().padStart(2, '0')}/${(date.getMonth() + 1).toString().padStart(2, '0')}/${date.getFullYear()}`;
    }
    
    // Truncate long text
    const truncatedAddress = customerData.address.length > 12 ? customerData.address.substring(0, 12) + '...' : customerData.address;
    const truncatedDescription = customerData.description.length > 30 ? customerData.description.substring(0, 30) + '...' : customerData.description;
    
    // Update cells
    cells[1].textContent = customerData.name;
    cells[2].textContent = customerData.contact;
    cells[3].textContent = truncatedAddress;
    cells[3].setAttribute('title', customerData.address);
    cells[4].textContent = displayDate;
    cells[5].textContent = customerData.repairService;
    cells[6].textContent = truncatedDescription;
    cells[6].setAttribute('title', customerData.description);
    
    // Update status badge
    const statusBadge = cells[7].querySelector('.status-badge');
    statusBadge.className = 'status-badge ' + customerData.progress;
    statusBadge.textContent = customerData.progress === 'complete' ? 'Complete' : 'In Progress';
}

// Attach event listeners to edit and delete buttons
function attachRowEventListeners() {
    // Edit buttons
    document.querySelectorAll('.action-btn.edit').forEach(btn => {
        btn.removeEventListener('click', handleEditClick); // Remove existing listeners
        btn.addEventListener('click', handleEditClick);
    });
    
    // Delete buttons
    document.querySelectorAll('.action-btn.delete').forEach(btn => {
        btn.removeEventListener('click', handleDeleteClick); // Remove existing listeners
        btn.addEventListener('click', handleDeleteClick);
    });
}

// Handle edit button click
function handleEditClick(e) {
    const row = e.target.closest('tr');
    openEditCustomerModal(row);
}

// Handle delete button click
async function handleDeleteClick(e) {
    if (confirm('Are you sure you want to delete this customer?')) {
        const row = e.target.closest('tr');
        const id = row.getAttribute('data-id');

        try {
            const response = await fetch('../../backend/db/delete_customer.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id })
            });

            const result = await response.json();

            if (result.success) {
                row.remove();
                updateRowNumbers();
                showSuccessMessage('Customer deleted successfully');
            } else {
                alert('Failed to delete: ' + result.message);
            }
        } catch (error) {
            console.error('Delete error:', error);
            alert('Error deleting customer. Please try again.');
        }
    }
}

// Update row numbers after deletion
function updateRowNumbers() {
    const tableRows = document.querySelectorAll('.data-table tbody tr');
    tableRows.forEach((row, index) => {
        row.querySelector('td:first-child').textContent = `${index + 1}.`;
    });
}

// Show success message
function showSuccessMessage(message) {
    // Create a simple toast notification
    const toast = document.createElement('div');
    toast.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background-color: #4CAF50;
        color: white;
        padding: 15px 20px;
        border-radius: 5px;
        z-index: 10000;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    `;
    toast.textContent = message;
    
    document.body.appendChild(toast);
    
    // Remove after 3 seconds
    setTimeout(() => {
        if (toast.parentNode) {
            toast.parentNode.removeChild(toast);
        }
    }, 3000);
}

// Search functionality
document.querySelector('.search-input').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const tableRows = document.querySelectorAll('.data-table tbody tr');
    
    tableRows.forEach(row => {
        const cells = row.querySelectorAll('td');
        const rowText = Array.from(cells).map(cell => cell.textContent.toLowerCase()).join(' ');
        
        if (rowText.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});