document.addEventListener('DOMContentLoaded', function() {
    const toggler = document.querySelector('.navbar-toggler');
    const iconHamburger = toggler.querySelector('.fa-bars');
    const iconClose = toggler.querySelector('.fa-times');
    const navbarCollapse = document.getElementById('navbarContent');

    navbarCollapse.addEventListener('show.bs.collapse', function() {
        iconHamburger.classList.add('d-none');
        iconClose.classList.remove('d-none');
    });

    navbarCollapse.addEventListener('hide.bs.collapse', function() {
        iconHamburger.classList.remove('d-none');
        iconClose.classList.add('d-none');
    });
});