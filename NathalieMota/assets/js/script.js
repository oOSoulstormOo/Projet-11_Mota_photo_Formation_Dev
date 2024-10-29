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
        // Ajoute ou retire la classe `no-scroll` sur le body
        if (burgerMenu.classList.contains('actif')) {
            document.body.classList.add('no-scroll');
        } else {
            document.body.classList.remove('no-scroll');
        }                   
    }

    // Si on clic sur le menu on joue la fonction
    menu.addEventListener('click', showOrNotBurgerMenu)                        
});


/**** MODALE DE CONTACT ****/
// on cible le lien "Contact", l'ensemble de la pop-up et juste la pop-up, on cible aussi le bouton contact de la page des photos et l'input 'reference' du formulaire
document.addEventListener("DOMContentLoaded", ()=> {
    const linkContact = document.querySelectorAll('.menu-item-68');
    const popUp = document.querySelector('.modal-overlay');
    const modaleContact = document.querySelector('.the-modal');
    const btnContactPhoto = document.querySelector('.btn-single-photo-contact');
    const refInput = document.querySelector('input[name="reference"]');
    
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
        // Ajoute ou retire la classe `no-scroll` sur le body
    if (burgerMenu.classList.contains('active')) {
        document.body.classList.add('no-scroll');
    } else {
        document.body.classList.remove('no-scroll');
    }                    
    }

    // Afficher la pop-up quand on clique sur les liens "Contact" / et remettre le menu mobile par défaut
    linkContact.forEach(n => n.addEventListener('click', (event) => {
                event.preventDefault();  // Empêche le comportement par défaut du lien
        showOrNotModaleContact();
        showOrNotBurgerMenu();
    }));

    // Afficher la pop-up quand on clique sur le bouton contact de la page des photos
    btnContactPhoto.addEventListener('click', () => {
        showOrNotModaleContact();
        // Récupère la valeur de la référence de la photo
        const photoRef = btnContactPhoto.getAttribute('data-ref');
        
        // Remplit automatiquement le champ de référence dans la pop-up
        refInput.value = photoRef;
    });

    // Fermer la pop-up si on clique en dehors de celle-ci
    document.addEventListener("click", (event) => {

        // Vérifier si on a cliqué à l'intérieur de la modale ou sur l'un des liens "Contact"
        const clickedInsideLinkContact = Array.from(linkContact).some(n => n.contains(event.target));

        if (!modaleContact.contains(event.target) && !clickedInsideLinkContact && !btnContactPhoto.contains(event.target)) {
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

/**** NAVIGATION SUR LA PAGE SINGLE-PHOTO ****/

document.addEventListener('DOMContentLoaded', function () {
    // Sélectionner les éléments des flèches et des miniatures
    const prevArrow = document.querySelector('.arrow-prev');
    const nextArrow = document.querySelector('.arrow-next');
    const prevThumbnail = document.querySelector('.prev-thumbnail');
    const nextThumbnail = document.querySelector('.next-thumbnail');

    // Fonction pour afficher la miniature
    function showThumbnail(thumbnail) {
        thumbnail.style.opacity = '1';
    }

    // Fonction pour masquer la miniature
    function hideThumbnail(thumbnail) {
        thumbnail.style.opacity = '0';
    }

    // Si la flèche précédente et sa miniature existent
    if (prevArrow && prevThumbnail) {
        prevArrow.addEventListener('mouseover', function () {
            showThumbnail(prevThumbnail);
        });
        prevArrow.addEventListener('mouseout', function () {
            hideThumbnail(prevThumbnail);
        });
    }

    // Si la flèche suivante et sa miniature existent
    if (nextArrow && nextThumbnail) {
        nextArrow.addEventListener('mouseover', function () {
            showThumbnail(nextThumbnail);
        });
        nextArrow.addEventListener('mouseout', function () {
            hideThumbnail(nextThumbnail);
        });
    }
});