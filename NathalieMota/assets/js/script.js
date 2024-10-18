/**** MENU BURGER ****/
document.addEventListener("DOMContentLoaded", function() {
    // On cible le burger-menu, les balise span contenant les lignes et la page du menu ouvert
    const menu = document.querySelector('.menu-burger');            
    const line = document.querySelectorAll('.line');                 
    const burgerMenu = document.querySelector('.burger-open-menu');  

    // Création d'une fonction ou les span obtienne la class animated qui permet de jouer leur animation
    // et le burger menu obtient la classe qui le fait apparaître
    function showOrNotBurgerMenu() {
        line.forEach(n => n.classList.toggle('animated'));      
        burgerMenu.classList.toggle('actif');                    
    }

    // Si on clic sur le menu on joue la fonction
    menu.addEventListener('click', showOrNotBurgerMenu)                        
});


/**** MODALE DE CONTACT ****/
// on cible le lien "Contact", l'ensemble de la pop-up et juste la pop-up
document.addEventListener("DOMContentLoaded", ()=> {
    const linkContact = document.getElementById('menu-item-68');
    const popUp = document.querySelector('.modal-overlay');
    const modaleContact = document.querySelector('.the-modal');

    // Fonction pour afficher ou masquer la pop-up
    function showOrNotModaleContact() {
        popUp.classList.toggle('hidden');
    }

    // Afficher la pop-up quand on clique sur le lien "Contact"
    linkContact.addEventListener('click', (event) => {
        event.preventDefault();  // Empêche le comportement par défaut du lien
        showOrNotModaleContact();
    });

    // Fermer la pop-up si on clique en dehors de celle-ci
    document.addEventListener("click", (event) => {
        if (!modaleContact.contains(event.target) && !linkContact.contains(event.target)) {
            if (!popUp.classList.contains('hidden')) {
                showOrNotModaleContact();
            }
        }
    });

    // Fermer la pop-up après un envoi réussi du formulaire avec Contact Form 7, après 3 secondes
    document.addEventListener('wpcf7mailsent', (event) => {
        setTimeout(() => {
            showOrNotModaleContact();
        }, 2500);  // 2500 millisecondes = 2.5 secondes
    });

});