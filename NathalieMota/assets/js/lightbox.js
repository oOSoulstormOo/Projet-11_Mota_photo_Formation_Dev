/*********************************/
/**** SCRIPT POUR LA LIGHTBOX ****/
/*********************************/

// Fonction d'initialisation de la lightbox
function initializeLightbox() {
    const lightboxOverlay = document.querySelector('.lightbox-overlay');
    const lightboxImg = document.querySelector('.lightbox-content img');
    const lightboxRef = document.querySelector('.overlay-ref-lightbox');
    const lightboxCat = document.querySelector('.overlay-cat-lightbox');
    const lightboxClose = document.querySelector('.lightbox-close');
    const lightboxNext = document.querySelector('.next');
    const lightboxPrev = document.querySelector('.prev');
    
    let postsData = [];
    let currentIndex = 0;

    // Récupère les données des posts
    function updatePostsData() {
        postsData = []; // Vide le tableau avant de le remplir

        const photoBlocks = document.querySelectorAll('.photo-block');
        /* console.log('Nombre de posts:', photoBlocks.length); // Vérifie le nombre de posts */

        photoBlocks.forEach((post) => {
            const imgSrc = post.querySelector('.photo-image .image-block').dataset.src;
            const ref = post.querySelector('.overlay-ref')?.textContent;
            const category = post.querySelector('.overlay-cat')?.textContent;

            /*// Ajoute un log pour vérifier les données récupérées
            console.log('Données du post:', { imgSrc, ref, category });*/

            if (imgSrc && ref && category) {
                postsData.push({ imgSrc, ref, category });
            } else {
                console.error('Données manquantes pour un post:', { imgSrc, ref, category });
            }
        });

        /* console.log('postsData:', postsData); // Voir le tableau complet */
    }

    // Fonction pour ouvrir la lightbox
    function openLightbox(index) {

        currentIndex = index;
        let { imgSrc, ref, category } = postsData[currentIndex];

        lightboxOverlay.classList.remove('hidden-lightbox');
        lightboxImg.src = imgSrc;
        lightboxRef.textContent = ref;
        lightboxCat.textContent = category;
    }

    // Navigation dans la lightbox
    function navigateLightbox(direction) {
        currentIndex = (currentIndex + direction + postsData.length) % postsData.length;
        openLightbox(currentIndex);
    }

    // Fermer la lightbox
    function closeLightbox() {
        lightboxOverlay.classList.add('hidden-lightbox');
    }

    // Met à jour les données et ajoute les écouteurs d'événements
    updatePostsData();
    
    document.querySelectorAll('.photo-block .overlay-fullscreen').forEach((button, index) => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            openLightbox(index);
        });
    });

    lightboxClose?.addEventListener('click', closeLightbox);
    lightboxNext?.addEventListener('click', (event) => {
        event.preventDefault();
        navigateLightbox(1);
    });
    lightboxPrev?.addEventListener('click', (event) => {
        event.preventDefault();
        navigateLightbox(-1);
    });
}

// Appel initial pour initialiser la lightbox
document.addEventListener('DOMContentLoaded', initializeLightbox);

// Ré-initialise la lightbox après chaque requête AJAX
function onPostsUpdated() {
    initializeLightbox();
}