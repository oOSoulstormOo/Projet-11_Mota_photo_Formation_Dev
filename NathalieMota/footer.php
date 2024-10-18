

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

    <?php wp_footer(); ?>
  </body>
</html>