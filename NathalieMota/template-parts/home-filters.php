<?php
/* ******************************************************** */
/* **** TEMPLATE POUR LES FILTRES DE LA PAGE D'ACCUEIL **** */
/* ******************************************************** */
?>

<section class="filter-section">
    <div class="filter-menu">
        <div class="filter-left">
            <!-- Catégories Menu -->
            <div class="filter-item" id="category-menu">
                <button class="filter-button">Catégories<span class="chevron"></span></button>
                <ul class="filter-list">
                    <?php
                    // Récupère les termes de la taxonomie 'categorie'
                    $categories = get_terms(array(
                        'taxonomy' => 'categorie',
                        'hide_empty' => false,
                    ));
                    // Affiche chaque terme comme option
                    foreach ($categories as $category) {
                        echo '<li class="filter-option" data-cat="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</li>';
                    }
                    ?>
                </ul>
            </div>
        
            <!-- Formats Menu -->
            <div class="filter-item" id="format-menu">
                <button class="filter-button">Formats<span class="chevron"></span></button>
                <ul class="filter-list">
                    <?php
                    // Récupère les termes de la taxonomie 'format'
                    $formats = get_terms(array(
                        'taxonomy' => 'format',
                        'hide_empty' => false,
                    ));
                    foreach ($formats as $format) {
                        echo '<li class="filter-option" data-format="' . esc_attr($format->slug) . '">' . esc_html($format->name) . '</li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
        <!--  Menu "Trier par" pour la date  (statique ici, mais on peut aussi le rendre dynamique si nécessaire) -->
        <div class="filter-item" id="sort-menu">
            <button class="filter-button">Trier par<span class="chevron"></span></button>
            <ul class="filter-list">
                <li class="filter-option" data-date="DESC">A partir des plus récentes</li>
                <li class="filter-option" data-date="ASC">A partir des plus anciennes</li>
            </ul>
        </div>
    </div>
</section>