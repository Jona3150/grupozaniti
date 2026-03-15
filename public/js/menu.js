document.addEventListener('DOMContentLoaded', function () {
    const menuBtn = document.getElementById('mobile-menu-btn');
    const mobileNav = document.getElementById('mobile-nav');
    const body = document.body;

    if (menuBtn && mobileNav) {
        menuBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            menuBtn.classList.toggle('is-active');
            mobileNav.classList.toggle('is-open');

            // Bloquea el scroll del fondo cuando el menú está abierto
            if (mobileNav.classList.contains('is-open')) {
                body.style.overflow = 'hidden';
            } else {
                body.style.overflow = 'auto';
            }
        });

        // Cerrar menú al hacer clic en un enlace
        const navLinks = mobileNav.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                menuBtn.classList.remove('is-active');
                mobileNav.classList.remove('is-open');
                body.style.overflow = 'auto';
            });
        });

        // Cerrar al hacer clic fuera del menú
        document.addEventListener('click', function (e) {
            if (!mobileNav.contains(e.target) && !menuBtn.contains(e.target)) {
                menuBtn.classList.remove('is-active');
                mobileNav.classList.remove('is-open');
                body.style.overflow = 'auto';
            }
        });
    }
});