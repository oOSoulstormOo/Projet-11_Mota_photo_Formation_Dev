/*****************************************************************************/
// SCIPTS POUR LA GESTION DU BOUTON "CHARGER PLUS" ET LA GESTION DES FILTRES //
/*****************************************************************************/

(function ($) {
    $(document).ready(function () {
        let currentPage = 1;
        const $loadMoreButton = $('#load-more'); // Sélectionne le bouton "Charger plus"

        // Charger plus de photos avec le bouton
        $loadMoreButton.on('click', function () {
            currentPage++;
            loadGallery(currentPage);
        });

        // Charger la galerie en fonction des filtres
        $('.filter-option').on('click', function() {
            currentPage = 1; // Réinitialise la pagination
            $(this).addClass('active').siblings().removeClass('active'); // Gère les états actifs pour les filtres
            loadGallery(currentPage); // Charge la première page filtrée
        });

        // Fonction pour charger la galerie via AJAX
        function loadGallery(page) {
            const cat = $('[data-cat].active').data('cat') || '';
            const format = $('[data-format].active').data('format') || '';
            const date = $('[data-date].active').data('date') || 'ASC';

            $.ajax({
                url: ajax_vars.ajax_url, // URL AJAX de WordPress
                method: 'POST',
                dataType: 'json',
                data: {
                    action: 'filter_photos',
                    page: page,
                    cat: cat,
                    format: format,
                    date: date
                },
                success: function (response) {
                    if (page === 1) {
                        // Remplace le contenu de la galerie si on est à la première page
                        $('.gallery-contenair').html(response.posts_html);
                    } else {
                        // Ajoute de nouveaux éléments si c'est une page suivante
                        $('.gallery-contenair').append(response.posts_html);
                    }

                    // Affiche ou cache le bouton "Charger plus" selon la réponse
                    if (response.has_more_posts) {
                        $loadMoreButton.show();
                    } else {
                        $loadMoreButton.hide();
                    }

                     // Réinitialiser les événements de lightbox
                    onPostsUpdated();
                },
                error: function () {
                    console.log("Erreur lors du chargement des photos supplémentaires.");
                }
            });
        }
    });
})(jQuery);
