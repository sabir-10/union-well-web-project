document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.querySelector('.menu-toggle');
    const nav = document.querySelector('.site-nav');

    if (menuToggle && nav) {
        menuToggle.addEventListener('click', function () {
            const isOpen = nav.classList.toggle('open');
            menuToggle.setAttribute('aria-expanded', String(isOpen));
        });
    }

    const filter = document.getElementById('classFilter');
    if (filter) {
        filter.addEventListener('change', function () {
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(function (row) {
                const category = row.getAttribute('data-category');
                row.style.display = filter.value === 'all' || category === filter.value ? '' : 'none';
            });
        });
    }
});
