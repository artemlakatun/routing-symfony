document.addEventListener('DOMContentLoaded', function() {
    const linkToggle = document.querySelector('.link_toggle'),
        slideMenu = document.querySelector('.slide_menu'),
        closeButton = document.querySelector('.close'),
        reviewBlocks = document.querySelectorAll('.review_block');;

    linkToggle.addEventListener('click', () => {
        slideMenu.classList.toggle('open');
    });

    closeButton.addEventListener('click', () => {
        slideMenu.classList.toggle('open');
    });
});