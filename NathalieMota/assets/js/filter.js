/***** SCRIPTS CONCERNANT LES FILTRES SUR LA PAGE D'ACCUEIL *****/
document.addEventListener("DOMContentLoaded", function() {
    // Cible tous les boutons de filtre et leurs listes associées
    const filterButtons = document.querySelectorAll('.filter-button');
    const filterItems = document.querySelectorAll('.filter-item');

    // Fonction pour afficher/masquer la liste spécifique au bouton cliqué
    filterButtons.forEach((button, index) => {
        const filterList = filterItems[index].querySelector('.filter-list');

        // On écoute chaque bouton
        button.addEventListener('click', function(event) {
            event.stopPropagation(); // Empêche la propagation pour ne pas fermer immédiatement le menu

            // Ajoute/retire la classe 'active' sur le bouton cliqué et 'filter-active' sur la liste associée
            const isActive = button.classList.contains('active');
            closeAllFilters(); // Ferme toutes les autres listes ouvertes

            if (!isActive) {
                button.classList.add('active');
                filterList.classList.add('filter-active');
            }
        });

        // Gestion de la sélection d'une option
        const filterOptions = filterList.querySelectorAll('.filter-option');
        filterOptions.forEach(option => {
            option.addEventListener('click', function() {
                button.textContent = option.textContent; // Change le texte du bouton pour montrer l'option choisie
                button.classList.remove('active'); // Retire la classe 'active' pour fermer la liste
                filterList.classList.remove('filter-active'); // Cache la liste
            });
        });
    });

    // Fonction pour fermer toutes les listes de filtres ouvertes
    function closeAllFilters() {
        filterButtons.forEach(button => button.classList.remove('active'));
        document.querySelectorAll('.filter-list').forEach(list => list.classList.remove('filter-active'));
    }

    // Ferme les listes si on clique en dehors de la zone de filtre
    document.addEventListener('click', function() {
        closeAllFilters();
    });
});