<?php
/**
 * The template for displaying all single posts
 *
 * 
 * @package WordPress
 * @subpackage Nathalie Mota
 * 
 */

get_header();

/* Start the Loop */
	while ( have_posts() ) : the_post();

	// Récupérer l'ID de post actuelle
    $post_id = get_the_ID();
	// Récupérer les termes de la taxonomie 'categorie'
	$categories = wp_get_post_terms($post_id, 'categorie');
	// Récupérer les termes de la taxonomie 'format'
	$formats = wp_get_post_terms($post_id, 'format');
?> 		

<section class="photo-detail">
    <div class="main-contenair">
        <div class="first-part">
			<div class="content">
				<h1><?php the_title(); ?></h1>

				<h2>Référence : <?php the_field('reference');?></h2>

				<h2>Catégorie : <?php
            	if ( !empty($categories) && !is_wp_error($categories) ) {
                	// Afficher tous les termes de la taxonomie 'categorie'
                	foreach ( $categories as $category ) {
                    	echo esc_html( $category->name ); // Afficher le nom de chaque catégorie
                	}
            	}
        		;?></h2>

				<h2>Format : <?php
            	if ( !empty($formats) && !is_wp_error($formats) ) {
                	// Afficher tous les termes de la taxonomie 'format'
                	foreach ( $formats as $format ) {
                    	echo esc_html( $format->name ); // Afficher le nom de chaque format
                	}
            	}
        		;?></h2>

				<h2>Type : <?php the_field('type');?></h2>

				<h2>Année : <?php echo get_the_date('Y');?></h2>
			</div>
		</div> 
		<div class="segond-part">

		<?php the_post_thumbnail('full'); ?>
		
		</div>
	</div>

	<div class="third-part">
		<div class="interest-contact">
				<p>Cette photo vous intérresse ?</p>
				<!-- on récupere la reference -->
				<?php $photo_ref = get_field('reference');?>
				<button class="btn-single-photo-contact" data-ref="<?php echo esc_attr($photo_ref); ?>">Contact</button>
		</div>
		<?php 
		// Obtenir la date de prise de vue de l'article actuel
		$current_post_date =  get_the_date('Y-m-d', $post_id);
			
		// Requête pour obtenir les articles suivant et précédent basés sur la date de prise de vue
		$args_prev = array(
    		'post_type' => 'photo',
            'posts_per_page' => 1,
            'orderby' => 'date',
            'order' => 'DESC',
            'date_query' => array(
                array(
                    'before' => $current_post_date,
                    'inclusive' => false
                    ),
                ),
            'post__not_in' => array($post_id),
		);

		$args_next = array(
    		'post_type' => 'photo',
            'posts_per_page' => 1,
            'orderby' => 'date',
            'order' => 'ASC',
            'date_query' => array(
                array(
                    'after' => $current_post_date,
                    'inclusive' => false
                    ),
                ),
            'post__not_in' => array($post_id),
		);

		// Obtenir les articles précédent et suivant
			$prev_post = get_posts($args_prev);
			$next_post = get_posts($args_next);

		;?>
		<div class="switch-post">
			<div class="contenair-nav-arrow">

				<!-- on affiche la miniature de la photo actuelle -->
				<div class="miniature-thumbnail">
					<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="Miniature Actuelle">
				</div>

				<!-- Si il y a un post précédent, afficher la miniature -->
				<?php if ( !empty( $prev_post ) ): ?>
				<div class="prev-thumbnail">
                    <img src="<?php echo get_the_post_thumbnail_url( $prev_post[0]->ID ); ?>" alt="Miniature Précédente">
                </div>
				<?php endif; ?>

				<?php 
				// Vérifie s'il n'y a pas d'image précédente
				$no_prev = empty($prev_post); 
				?>

				<!-- Si il y a un post suivant, afficher la miniature -->
				<?php if ( !empty( $next_post ) ): ?>
				<div class="next-thumbnail <?php echo $no_prev ? 'relative-position' : ''; ?>">
                    <img src="<?php echo get_the_post_thumbnail_url( $next_post[0]->ID ); ?>" alt="Miniature Suivante">
                </div>
				<?php endif; ?>

				<div class="nav-arrow">
				
					  <!-- Si il y a un post précédent, afficher la flèche -->
					<?php if ( !empty( $prev_post ) ): ?>
					<div class="arrow-prev">
						<a href="<?php echo get_permalink( $prev_post[0]->ID ); ?>">
                            <img src="<?php echo get_template_directory_uri() . '/assets/image/arrow-left-mini.png'; ?>" alt="Précédent">
                        </a>
                        
					</div>
					<?php endif; ?>

					  <!-- Si il y a un post suivant, afficher la flèche -->
					<?php if ( !empty( $next_post ) ): ?>
					<div class="arrow-next">
						<a href="<?php echo get_permalink( $next_post[0]->ID ); ?>">
                            <img src="<?php echo get_template_directory_uri() . '/assets/image/arrow-right-mini.png'; ?>" alt="Suivant">
                        </a>
					</div>
					<?php endif; ?>

				</div>
			</div>
		</div>
	</div>
<span class="separator"></span>
</section>
<section class="similar-img">
	<div class="segond-contenair">
		<h3>Vous aimerez aussi</h3>

		<div class="contenair-similar-img">
			<?php
        		// Obtenir la catégorie de l'article courant 
        
        		$categorie = wp_get_post_terms($post_id, 'categorie', ['fields' => 'ids']);
		
				// Requête pour récupérer 2 articles partageant la même catégorie
        		$args = [
            		'post_type' => 'photo',
            		'posts_per_page' => 2,
            		'post__not_in' => [$post_id],
            		'tax_query' => [
                		[
                    		'taxonomy' => 'categorie',
                    		'field' => 'term_id',
                    		'terms' => $categorie,
                		],
            		],
        		];
        		$related_photos = new WP_Query($args); // variable photo similaire = la requete Jquery prenant ce tableau

				// Inclure le fichier pour chaque résultat
				if ($related_photos->have_posts()) :
					while ($related_photos->have_posts()) : $related_photos->the_post();
						// Variables dynamiques pour `photo-block.php`
						$image_url = get_the_post_thumbnail_url(get_the_ID());
						$reference = get_field('reference'); 
						$categorieArticle = wp_get_post_terms(get_the_ID(), 'categorie', ['fields' => 'names'])[0]; // Première catégorie si plusieurs
						$post_id = get_the_ID();
						include locate_template('template-parts/photo-block.php');
					endwhile;
					wp_reset_postdata();
				endif;
			?>
		</div>
	</div>
</section>

<?php endwhile; // End of the loop.

get_footer();
?>