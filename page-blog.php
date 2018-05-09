<?php

/**

 * The template for displaying all pages.

 *

 * This is the template that displays all pages by default.

 * Please note that this is the WordPress construct of pages

 * and that other 'pages' on your WordPress site will use a

 * different template.

 *

 * @package Tesseract

 */



get_header();



?>



	<div id="primary" class="content-area sidebar-left">

		<main id="main" class="site-main" role="main">



			<?php while ( have_posts() ) : the_post(); ?>



				<?php get_template_part( 'content', 'page' ); ?>



				<?php

					// If comments are open or we have at least one comment, load up the comment template

					if ( comments_open() || get_comments_number() ) :

						comments_template();

					endif;

				?>



			<?php endwhile; // end of the loop. ?>



		</main><!-- #main -->
		<?php
		$myposts = get_posts('');
		foreach($myposts as $post) :
		setup_postdata($post);
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "large" );

		?>
		  <div class="post-item" style = "background-image: url(<?php echo $thumbnail[0] ?>);">
		    <div class="post-info">
		      <h2 class="post-title">
		      <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
		      <?php the_title(); ?>
		      </a>
		      </h2>
		    </div>
		    <div class="post-content">
		    <?php the_content(); ?>
		    </div>
		  </div>
		<?php endforeach; wp_reset_postdata(); ?>
	</div><!-- #primary -->

<style type="text/css">
	.fl-builder .site-content{ max-width:1100px !important; margin:0 auto !important;}
</style>

<?php if ( !is_plugin_active('woocommerce/woocommerce.php') || ( is_plugin_active('woocommerce/woocommerce.php') && ( !isset( $layout_default ) || !$layout_default || ( $layout_default == 'sidebar-left' ) || ( $layout_default == 'sidebar-right' ) ) ) ) get_sidebar(); ?>



<?php //get_footer(); ?>

<?php get_footer('custes'); ?>
