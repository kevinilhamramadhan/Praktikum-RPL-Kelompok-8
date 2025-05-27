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