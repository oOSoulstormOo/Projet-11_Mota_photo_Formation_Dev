<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Nathalie Mota</title>
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
          </div>
        
      </header>

