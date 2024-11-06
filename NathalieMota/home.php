<!-- Appel du header sur la page d'accueil -->
<?php get_header(); ?>

<!-- Début du contenu de la page d'accueil -->
<!-- HERO SECTION -->
<section class="hero-header">
    <div class="hero-img">
       
       <?php // On va chercher une image au hasard parmi celle présente dans les articles photos
        function header_random_image() {
            $header_args = array(
                'post_type' => 'photo',
                'posts_per_page' => 1,
                'fields' => 'ids',
                'orderby' => 'rand'
            );

            $header_random_query = new WP_Query($header_args);

            // Verifie qu'il y a un post
            if ($header_random_query -> have_posts()) {
                while ($header_random_query -> have_posts()) {
                    $header_random_query -> the_post();
    
                    //verifie qu'il y a une image sur ce post
                    if (has_post_thumbnail()) {
                       echo the_post_thumbnail('full');
                    }
                    else {
                        echo '<img src="' . get_template_directory_uri() . '/assets/image/Header_desktop.png" alt="Default Header Image">';
                    }
                }
                 // Reset post data après la requête personnalisée
                 wp_reset_postdata();
            }
        }
        // Puis on appel la fonction pour afficher l'image aléatoire
        header_random_image();
        ?>
    
        <div class="hero-content">
        <h1>Photographe event</h1>
        </div>
    </div>
</section>

<!-- Section avec les filtres -->
<?php get_template_part('template-parts/home-filters'); ?>

<!-- section avec la galerie -->
<section class="gallery-section">
    <div class="gallery-contenair">
    <?php 
        // Requête pour récupérer et pour voir 8 articles 
        $gallery_args = [
            'post_type' => 'photo',
            'posts_per_page' => 8,
            'orderby' => 'date',
            'order' => 'ASC',
            'paged' => 1,
            /*'tax_query' => [
                [
                    'taxonomy' => 'categorie', // il faudra surement une tax query avec relation pour reaficher selon les bouton qui seront choisi, plutôt que de refaire plein de requetes
                    'field' => 'term_id',
                    'terms' => $categorie,
                ],
            ],*/
        ];
        $gallery_photos = new WP_Query($gallery_args);

        // Inclure le fichier pour chaque résultat
        if ($gallery_photos->have_posts()) :
            while ($gallery_photos->have_posts()) : $gallery_photos->the_post();
                // Variables dynamiques pour `photo-block.php`
                $image_url = get_the_post_thumbnail_url(get_the_ID());
                $reference = get_field('reference'); 
                $categorieArticle = wp_get_post_terms(get_the_ID(), 'categorie', ['fields' => 'names'])[0]; // Première catégorie si plusieurs
                $post_id = get_the_ID();
                include locate_template('template-parts/photo-block.php');
            endwhile;
            wp_reset_postdata();
        endif;
    ?>
    </div>
    <div class="button-gallery">
            <button class="btn-chargerPlus">Charger plus</button>
    </div>
</section>







<!-- Appel du footer sur la page d'accueil -->
<?php get_footer(); ?>