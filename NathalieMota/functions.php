<?php
// Function pour ajouter un logo à la personnalisation

add_theme_support( 'custom-logo' );

// Function pour enregistrer un nouveau menu
function register_custom_menu() {
    register_nav_menu( 'main-menu', __( 'Menu Principal', 'theme-text-domain' ) );
}

add_action( 'after_setup_theme', 'register_custom_menu');