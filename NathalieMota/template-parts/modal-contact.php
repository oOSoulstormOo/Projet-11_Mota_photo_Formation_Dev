<?php
/* ************************** */
/* **** POPUP DE CONTACT **** */
/* ************************** */
?>

<div class="modal-overlay hidden">
    <div class="the-modal">
        <div class="modal-title">
        
        <img src="<?php echo get_stylesheet_directory_uri() . '/assets/image/contact.png'?>" alt="Page contact">
        
        </div>
        
        <div class="modal-info">
        <?php echo do_shortcode('[contact-form-7 id="9a37245" title="Formulaire de contact 1"]'); ?>
        
        </div>
    </div>
</div>