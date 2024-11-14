

      <footer id='footer'>
      <nav class='navigation-footer'>
              <?php
              wp_nav_menu( array(
                'theme_location' => 'footer',
                ));
              ?>
              <span>Tous droits réservés</span>
            </nav>
       
      </footer>

      <!-- Lance la popup contact -->
	    <?php 
        get_template_part ( 'template-parts/modal-contact'); 		
      ?>

      <!-- Lance la Lightbox -->
      <?php 
       get_template_part ( 'template-parts/lightbox');
      ?>

    <?php wp_footer(); ?>
  </body>
</html>