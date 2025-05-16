// JavaScript untuk interaksi dasar
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
    
    // Simulasi pencarian
    const searchInput = document.querySelector('.search-input');
    const searchBtn = document.querySelector('.search-btn');
    
    searchBtn.addEventListener('click', function() {
        const searchValue = searchInput.value.toLowerCase();
        // Di sini biasanya akan memanggil API atau melakukan filter
        alert('Mencari: ' + searchValue);
    });
    
    // Simulasi tombol aksi
    const editButtons = document.querySelectorAll('.action-btn.edit');
    const deleteButtons = document.querySelectorAll('.action-btn.delete');
    
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            const name = row.cells[1].textContent;
            alert('Edit entry: ' + name);
        });
    });
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            const name = row.cells[1].textContent;
            if(confirm('Apakah Anda yakin ingin menghapus data ' + name + '?')) {
                // Di sini biasanya akan memanggil API untuk delete
                row.remove();
                updateStats();
            }
        });
    });
    
    function updateStats() {
        const totalRows = document.querySelectorAll('.notes-table tbody tr').length;
        const inProgressRows = document.querySelectorAll('.status.in-progress').length;
        const completedRows = document.querySelectorAll('.status.completed').length;
        
        document.querySelector('.stat-card.total .number').textContent = totalRows;
        document.querySelector('.stat-card.progress .number').textContent = inProgressRows;
        document.querySelector('.stat-card.completed .number').textContent = completedRows;
    }
});