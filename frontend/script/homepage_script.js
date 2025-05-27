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

    // Pencarian
document.getElementById("searchInput").addEventListener("input", function () {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll("#notesTableBody tr");

    rows.forEach(row => {
        const cells = row.querySelectorAll("td");
        let match = false;

        cells.forEach(cell => {
            if (cell.textContent.toLowerCase().includes(filter)) {
                match = true;
            }
        });

        row.style.display = match ? "" : "none";
    });
});


    
    // Simulasi tombol aksi

    function updateStats() {
        const totalRows = document.querySelectorAll('.notes-table tbody tr').length;
        const inProgressRows = document.querySelectorAll('.status.in-progress').length;
        const completedRows = document.querySelectorAll('.status.completed').length;
        
        document.querySelector('.stat-card.total .number').textContent = totalRows;
        document.querySelector('.stat-card.progress .number').textContent = inProgressRows;
        document.querySelector('.stat-card.completed .number').textContent = completedRows;
    }
    
    updateStats(); // Jangan lupa panggil fungsi ini agar angka stats terupdate
});
