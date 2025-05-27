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