<?php

/**

 * The template for displaying 404 pages (not found).

 *

 * @package Tesseract

 */



get_header(); ?>



	<div id="primary" class="full-width-page">

<div id = "display-sessions" class="row align-items-center" style = "text-align: center; padding-bottom: 50px;">

<div class="col align-items-center" id = "header-content-items">

			<section class="error-404 not-found">

				<header class="page-header">

					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'tesseract' ); ?></h1>

				</header><!-- .page-header -->



				<div class="page-content">

					<p><?php _e( 'It looks like nothing was found at this location.', 'tesseract' ); ?></p>







				</div><!-- .page-content -->

			</section><!-- .error-404 -->



		</div>
  </div>

	</div><!-- #primary -->



<?php get_footer(); ?>

<?php //get_footer('custes'); ?>
