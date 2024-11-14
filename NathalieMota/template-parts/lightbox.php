<?php
/* *********************************** */
/* **** TEMPLATE POUR LA LIGHTBOX **** */
/* *********************************** */
?>

<div class="lightbox-overlay hidden-lightbox">
    <div class="lightbox-container">
        <button class="lightbox-close">
            <img src="<?php echo get_template_directory_uri() . '/assets/image/close.png'; ?>" alt="Fermer">
        </button>

        <div class="lightbox-content">
            <img src="" alt="">   
            
            <div class="overlay-ref-lightbox">
                <?php // echo esc_html($reference); 
                echo ('Reférence'); ?> 
            </div>

            <div class="overlay-cat-lightbox">
                <?php // echo esc_html($categorieArticle);
                echo ('Catégorie'); ?> 
            </div>
        </div>

        <div class="next">
            <a href="">
                <p>Suivante</p>
                <img src="<?php echo get_template_directory_uri() . '/assets/image/arrow-white.png'; ?>" alt="Image suivante">
            </a>
        </div>

        <div class="prev">
            <a href="">
                <img src="<?php echo get_template_directory_uri() . '/assets/image/arrow-white.png'; ?>" alt="Image précédente">
                <p>Précédente</p>
            </a>
        </div>
    </div>
</div>