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
    const linkContact = document.querySelectorAll('.menu-item-68');
    const popUp = document.querySelector('.modal-overlay');
    const modaleContact = document.querySelector('.the-modal');
    
// Réutilisation des variable precédente pour intéragir avec le menu-mobile
    const line = document.querySelectorAll('.line');                 
    const burgerMenu = document.querySelector('.burger-open-menu');

    // Fonction pour afficher ou masquer la pop-up
    function showOrNotModaleContact() {
        popUp.classList.toggle('hidden');
    }

    // Réutilisation de la Fonction pour afficher ou non le burger menu
    function showOrNotBurgerMenu() {
        line.forEach(n => n.classList.toggle('animated'));      
        burgerMenu.classList.toggle('actif');                    
    }

    // Afficher la pop-up quand on clique sur les liens "Contact" / et remettre le menu mobile par défaut
    linkContact.forEach(n => n.addEventListener('click', (event) => {
                event.preventDefault();  // Empêche le comportement par défaut du lien
        showOrNotModaleContact();
        showOrNotBurgerMenu();
    }));


    // Fermer la pop-up si on clique en dehors de celle-ci
    document.addEventListener("click", (event) => {

        // Vérifier si on a cliqué à l'intérieur de la modale ou sur l'un des liens "Contact"
        const clickedInsideLinkContact = Array.from(linkContact).some(n => n.contains(event.target));

        if (!modaleContact.contains(event.target) && !clickedInsideLinkContact) {
            if (!popUp.classList.contains('hidden')) {
                popUp.classList.add('reverse-animate');
                setTimeout(() => {   
                    showOrNotModaleContact();
                    popUp.classList.remove('reverse-animate');
                }, 600); // 600 millisecondes = 0.6 secondes / attend que l'animation se termine
            }
        }
    });

    // Fermer la pop-up après un envoi réussi du formulaire avec Contact Form 7, après 3 secondes
    document.addEventListener('wpcf7mailsent', (event) => {
        setTimeout(() => {
            popUp.classList.add('reverse-animate');
        }, 2500);// 2500 millisecondes = 2.5 secondes

        setTimeout(() => {
            showOrNotModaleContact();
            popUp.classList.remove('reverse-animate');
        }, 3000);  // 3000 millisecondes = 3 secondes / attend que l'animation se termine
    });

});