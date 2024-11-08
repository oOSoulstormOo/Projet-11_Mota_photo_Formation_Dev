<?php

// Chargement des éléments nécessaire //

function nathalie_mota_theme_enqueue_styles() {
// Chargement du style ( style.css )

wp_enqueue_style( 'theme-styles', get_template_directory_uri() . '/assets/css/styles.css', array());
wp_enqueue_style( 'contact-theme-styles', get_stylesheet_directory_uri() . '/assets/css/modal-contact.css', array());
wp_enqueue_style( 'single-theme-styles', get_stylesheet_directory_uri() . '/assets/css/single-photo.css', array());
wp_enqueue_style(' photo-block-theme-styles', get_stylesheet_directory_uri('') . '/assets/css/photo-block.css', array());
wp_enqueue_style(' home-content-theme-styles', get_stylesheet_directory_uri('') . '/assets/css/home-content.css', array());
wp_enqueue_style(' lightbox-theme-styles', get_stylesheet_directory_uri('') . '/assets/css/lightbox.css', array());
}

add_action('wp_enqueue_scripts', 'nathalie_mota_theme_enqueue_styles');

// import JS

function nathalie_mota_theme_enqueue_scripts() {
// Chargement du script de la modale, du burger-menu, et de la nav de la page single-photo  ( script.js )
wp_enqueue_script('theme-script', get_template_directory_uri() . '/assets/js/script.js', array());

// Charger jQuery intégré de WordPress
wp_enqueue_script('jquery');

// Chargement de script concernant les filtres de la page d'accueil (filter.js) / seulement sur la page d'accueil
if( is_home() ) {
    wp_enqueue_script('theme-filter-script', get_template_directory_uri() . '/assets/js/filter.js', array());
}

// Charger le script ajax.js
wp_enqueue_script('ajax-script', get_template_directory_uri() . '/assets/js/ajax.js', array('jquery'));
    
// Passer la variable `ajax_url` au script pour l’URL AJAX de WordPress
wp_localize_script('ajax-script', 'ajax_vars', array(
    'ajax_url' => admin_url('admin-ajax.php')
));
};

add_action('wp_enqueue_scripts', 'nathalie_mota_theme_enqueue_scripts');

// Function pour ajouter un logo à la personnalisation

add_theme_support( 'custom-logo' );

// Function pour enregistrer un nouveau menu
// créer un lien pour la gestion des menus dans l'administration
// Visibles ensuite dans Apparence / Menus (after_setup_theme)
function register_my_menu(){
    add_theme_support( 'menus' );
    
    register_nav_menus( array(
        'main' => 'Menu principal',      // Menu de navigation de l'en-tête
        'footer' => 'Menu pied de page',  // Menu de navigation du pied de page
    ) );
    
}

add_action('after_setup_theme', 'register_my_menu');

// Ajout de l'enregistrement des images

add_theme_support('post-thumbnails');


/*****************************/
/* FONCTION POUR LES FILTRES */
/*****************************/

// Ajout de la fonction pour gerer le bouton 'Charger Plus'
// Et la gestion des filtres sur la page d'accueil

function filter_photos() {
    // Récupère les paramètres de l'AJAX
    $cat = isset($_POST['cat']) ? sanitize_text_field($_POST['cat']) : '';              // Sanitize_text_field et intval serve a securiser et assainir les donnée récuperer 
    $format = isset($_POST['format']) ? sanitize_text_field($_POST['format']) : '';     // Merci Chati-G
    $date = isset($_POST['date']) ? sanitize_text_field($_POST['date']) : 'ASC';
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;

    // Requête de la galerie filtrée
    $gallery_args = [
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'orderby' => 'date',
        'order' => $date,
        'paged' => $page,
        'tax_query' => [
            'relation' => 'AND',
            [
                'taxonomy' => 'categorie',
                'field' => 'slug',
                'terms' => $cat,
                'operator' => $cat ? 'IN' : 'NOT IN',   // operator sert à comparer, ici la variable $cat, pour lui donnée un résultat selon les information récuperer plus haut
            ],
            [
                'taxonomy' => 'format',
                'field' => 'slug',
                'terms' => $format,
                'operator' => $format ? 'IN' : 'NOT IN',    // Pareil pareil mais différend ! ( avec $format quoi )
            ],
        ],
    ];

    $gallery_photos = new WP_Query($gallery_args);
    
    // Variables pour la réponse JSON
    $response = [
        'posts_html' => '',
        'has_more_posts' => $gallery_photos->found_posts > ($page * 8), // et bein, sa aura été galère ! 
    ];

    // Boucle pour les posts
    if ($gallery_photos->have_posts()) {
        ob_start(); // Permet de capturer le contenu
        while ($gallery_photos->have_posts()) {
            $gallery_photos->the_post();
            $image_url = get_the_post_thumbnail_url(get_the_ID());
            $reference = get_field('reference'); 
            $categorieArticle = wp_get_post_terms(get_the_ID(), 'categorie', ['fields' => 'names'])[0];
            $post_id = get_the_ID();
            include locate_template('template-parts/photo-block.php');
        }
        $response['posts_html'] = ob_get_clean(); // Et sa, sa permet de le récuperer
    } else {
        $response['posts_html'] = '<p>Aucun article trouvé.</p>';
    }

    wp_reset_postdata();
    wp_send_json($response); // Envoyer la réponse en JSON
    wp_die();
}
add_action('wp_ajax_filter_photos', 'filter_photos');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos');