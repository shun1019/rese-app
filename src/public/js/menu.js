document.addEventListener('DOMContentLoaded', function() {
    const menuButton = document.querySelector('.logo');
    const menuPopup = document.getElementById('menu-popup');
    const closeButton = document.getElementById('close-menu');

    menuButton.addEventListener('click', function(e) {
        e.preventDefault();
        menuPopup.classList.add('active');
    });

    closeButton.addEventListener('click', function() {
        menuPopup.classList.remove('active');
    });
});