/**** MENU BURGER ****/
document.addEventListener("DOMContentLoaded", function() { 
    const menu = document.querySelector('.menu-burger');            // On cible le burger-menu
    const line = document.querySelectorAll('.line')                // les balise span contenant les lignes
    const burgerMenu = document.querySelector('.burger-open-menu'); // la page du menu ouvert.

    function showOrNotBurgerMenu() {
        line.forEach(n => n.classList.toggle('animated'));      // les span obtienne la class animated qui permet de jouer leur animation
        burgerMenu.classList.toggle('actif');                    // et le burger menu obtient la classe qui le fait apparaître
    }

    menu.addEventListener('click', showOrNotBurgerMenu)                        // Si on clic sur le menu on joue la fonction
});