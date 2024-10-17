<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Nathalie Mota</title>
      <!-- Appel des polices depuis le CDN de Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Space Mono + Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,500;1,300;1,500&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
  </head>
  <body>
      <header>
          <!-- Logo -->
          <div class="header-container">
              <div class="logo">
                <a href="<?php echo home_url( '/' ); ?>" >
                  <img src="<?php echo esc_url( wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0] ); ?>" alt="Logo Nathalie Mota">
                </a>
              </div>
          
          <!-- Menu de navigation -->
            <nav class='navigation'>
              <?php
              wp_nav_menu( array(
                'theme_location' => 'main',
                ));
              ?>
            </nav>
            <!-- Menu burger -->
             <!-- Bouton -->
            <button class="menu-burger" aria-controls="primary-menu" aria-expanded="false">
                <span class="line line__1"></span>
                <span class="line line__2"></span>
                <span class="line line__3"></span>
            </button>
          </div>
          <!-- Conteneur menu sur mobile -->
          <div class="burger-open-menu">
          <!-- Menu de navigation mobile -->
            <nav class='navigation-mobile'>
                <?php
                wp_nav_menu( array(
                  'theme_location' => 'main',
                  ));
                ?>
            </nav>
          </div>
        
      </header>

