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

		<div class = "new-account-form">

		<form id = "new-account-trainer" name = "new-account-trainer" method = "post" >
				<input type = "text" id = "fName" placeholder="First Name"/>
				<input type = "text" id = "lName" placeholder="Last Name"/>
				<input type = "email" id = "email" placeholder="Email"/>
				<input type = "text" id = "username" placeholder="Username"/>
				<input type = "password" id = "password" placeholder="Password"/>
				<input type = "password" id = "re-password" placeholder="Re-enter" Password/>
				<input type = "text" id = "goal" placeholder="Goal"/>
				<input type = "submit" name = "submit" id = "submit"/>
		</form>

	</div>

	</div><!-- #primary -->

<style type="text/css">
	.fl-builder .site-content{ max-width:1100px !important; margin:0 auto !important;}
</style>

<?php if ( !is_plugin_active('woocommerce/woocommerce.php') || ( is_plugin_active('woocommerce/woocommerce.php') && ( !isset( $layout_default ) || !$layout_default || ( $layout_default == 'sidebar-left' ) || ( $layout_default == 'sidebar-right' ) ) ) ) get_sidebar(); ?>



<?php //get_footer(); ?>

<?php get_footer('custes'); ?>
