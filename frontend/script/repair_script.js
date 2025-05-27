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
    const serviceTable = document.querySelector('.service-table tbody');
    serviceTable.addEventListener('click', function(e) {
        if (e.target.closest('.edit-button')) {
            const row = e.target.closest('tr');
            const code = row.querySelector('td:first-child').textContent;
            const serviceName = row.querySelector('td:nth-child(2)').textContent;
            alert('Edit service: ' + code + ' - ' + serviceName);
        }
    });



    // Search functionality
    document.getElementById("searchInput").addEventListener("input", function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll("#historyTableBody tr");

        rows.forEach(row => {
            const cells = row.querySelectorAll("td");
            let match = false;

            // Cek setiap kolom untuk kecocokan teks
            cells.forEach(cell => {
                if (cell.textContent.toLowerCase().includes(filter)) {
                    match = true;
                }
            });

            row.style.display = match ? "" : "none";
        });
    });
});
