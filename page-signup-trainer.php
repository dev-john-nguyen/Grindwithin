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

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


	<div id="primary" class="content-area sidebar-left">

		<div id = "display-sessions" class="row align-items-center" style = "text-align: center; padding-bottom: 50px;">
			<div class="col align-items-center" id = "header-content-items">
				<h1>Thank You And Welcome!</h1>
				<a id = "arrowDownBtn"><img src = "<?php echo site_url('wp-content/uploads/2019/01/downpoint.png') ?>" style = "width: 10%;" /></a>
			</div>
		</div>

			<div class = "container form-layout form-width margin-top-header margin-bottom">

			<h3 style = "margin-bottom: 1.5rem"><u>New Trainer Form</u></h3>

		<form id = "new-account-trainer" name = "new-account-trainer" method = "post" required>
				<input type = "text" class="form-control mb-3" id = "fName" placeholder="First Name" required/>
				<input type = "text" class="form-control mb-3" id = "lName" placeholder="Last Name" required/>
				<input type = "email" class="form-control mb-3" id = "email" placeholder="Email" style = "width: 100%;" required/>
				<input type = "text" class="form-control mb-3" id = "username" placeholder="Username" required/>
				<input type = "password" class="form-control mb-3" id = "password" placeholder="Password" required/>
				<input type = "password" class="form-control mb-3" id = "re-password" placeholder="Re-enter Password" Password required/>
				<textarea type = "text" class="form-control mb-3" id = "description" placeholder="Tell us a little about yourself" required></textarea>
				<input type = "submit" name = "submit" id = "submit"/>
		</form>

	</div>

	</div><!-- #primary -->

<style type="text/css">
	.fl-builder .site-content{ max-width:1100px !important; margin:0 auto !important;}
</style>

<?php if ( !is_plugin_active('woocommerce/woocommerce.php') || ( is_plugin_active('woocommerce/woocommerce.php') && ( !isset( $layout_default ) || !$layout_default || ( $layout_default == 'sidebar-left' ) || ( $layout_default == 'sidebar-right' ) ) ) ) get_sidebar(); ?>

  <script src= "<?php echo get_stylesheet_directory_uri(); ?>/js/arrow_down.js"></script>
	<script src= "<?php echo get_stylesheet_directory_uri(); ?>/js/create/new_account.js"></script>


<?php //get_footer(); ?>

<?php get_footer('custes'); ?>
