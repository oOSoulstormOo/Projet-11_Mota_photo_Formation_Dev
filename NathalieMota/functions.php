<?php

// Chargement des éléments nécessaire

function nathalie_mota_theme_enqueue_styles() {
// Chargement du style ( style.css )

wp_enqueue_style( 'theme-styles', get_template_directory_uri() . '/assets/css/styles.css', array());
wp_enqueue_style( 'contact-theme-styles', get_stylesheet_directory_uri() . '/assets/css/modal-contact.css', array());
wp_enqueue_style( 'single-theme-styles', get_stylesheet_directory_uri() . '/assets/css/single-photo.css', array());
wp_enqueue_style(' photo-block-theme-styles', get_stylesheet_directory_uri('') . '/assets/css/photo-block.css', array());
}

add_action('wp_enqueue_scripts', 'nathalie_mota_theme_enqueue_styles');

// import JS

function nathalie_mota_theme_enqueue_scripts() {

// Chargement du script de la modale ( script.js )
wp_enqueue_script('theme-script', get_template_directory_uri() . '/assets/js/script.js', array());

}

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