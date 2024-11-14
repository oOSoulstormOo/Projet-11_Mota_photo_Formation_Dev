<?php
/* ************************************* */
/* **** TEMPLATE POUR LE BLOC PHOTO **** */
/* ************************************* */
?>

<div class="photo-block">
    <div class="photo-image">
        <img class="image-block" src="<?php echo esc_url($image_url); ?>" data-src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>">
    </div>
    <div class="photo-overlay">
        <div class="overlay-content">
            <a href="<?php echo esc_url(get_permalink($post_id)); ?>" class="overlay-link">
                <img src="<?php echo get_template_directory_uri() . '/assets/image/Icon_eye.png' ;?> ">
            </a>    
         <div class="overlay-ref">
            <?php echo esc_html($reference); ?>
         </div>
         <div class="overlay-cat">
            <?php echo esc_html($categorieArticle); ?>
         </div>
         <div class="overlay-fullscreen">
            <button><img src="<?php echo get_template_directory_uri() . '/assets/image/Icon_fullscreen.png' ;?>"></button>
         </div>
            
        </div>
    </div>
</div>