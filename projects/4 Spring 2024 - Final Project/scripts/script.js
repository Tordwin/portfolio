// Hamburger menu dropdown script //
document.addEventListener('DOMContentLoaded', function () {
    const hamburgerMenu = document.querySelector('.hamburger-menu');
    const menu = document.querySelector('.menu');

    hamburgerMenu.addEventListener('click', function () {
        menu.classList.toggle('active');
    });
});