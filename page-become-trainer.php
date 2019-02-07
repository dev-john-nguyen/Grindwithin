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
				<h1>So You Want To Make A Difference?</h1>
        <p>We accept the best of the best. Apply below if you think you have what it takes.</p>
				<a id = "arrowDownBtn"><img src = "http://localhost/main/wp-content/uploads/2019/01/downpoint.png" style = "width: 10%;" /></a>
			</div>
		</div>

			<div class = "container form-layout form-width margin-top-header margin-bottom">

			<h3 style = "margin-bottom: 1.5rem"><u>Become an 8Rare Trainer</u></h3>

		<form id = "app-trainer" name = "app-trainer" method = "post" required>
				<input type = "text" class="form-control mb-3" id = "fName" placeholder="First Name" required/>
				<input type = "text" class="form-control mb-3" id = "lName" placeholder="Last Name" required/>
				<input type = "email" class="form-control mb-3" id = "email" placeholder="Email" style = "width: 100%;" required/>

				<select id = "certified" class="form-control mb-3">
					<option value = "default" disabled selected>Are you a certified trainer?</option>
					<option value = "1">Yes</option>
					<option value = "0">No</option>
				</select>

				<input type = "text" class="form-control mb-3" id = "certified-type" placeholder="If yes, what certification do you have?" style = "width: 100%;"/>

				<input type = "number" class="form-control mb-3" id = "years-experience" placeholder="How many years of trainer experience do you have?" style = "width: 100%;" required/>

				<input type = "text" class="form-control mb-3" id = "sport-name" placeholder="What sports did you play?" style = "width: 100%;" required/>
				<input type = "text" class="form-control mb-3" id = "sport-level" placeholder="What is your highest level of competition?" style = "width: 100%;" required/>

				<p>Please answer the questions below. Please answer in less than 800 words.</p>

				<textarea type = "text" class="form-control mb-3" id = "q1" placeholder="Describe how you would train an athlete that is looking to improve their linear speed." style = "width: 100%;" required></textarea>
				<textarea type = "text" class="form-control mb-3" id = "q2" placeholder="Explain why you think you would be a good fit for 8rare." style = "width: 100%;" required></textarea>


				<textarea type = "text" class="form-control mb-3" id = "q3" placeholder="Tell us a little about yourself" required></textarea>
				<input type = "submit" name = "submit" id = "submit"/>
		</form>

	</div>

	</div><!-- #primary -->

<style type="text/css">
	.fl-builder .site-content{ max-width:1100px !important; margin:0 auto !important;}
</style>

<?php if ( !is_plugin_active('woocommerce/woocommerce.php') || ( is_plugin_active('woocommerce/woocommerce.php') && ( !isset( $layout_default ) || !$layout_default || ( $layout_default == 'sidebar-left' ) || ( $layout_default == 'sidebar-right' ) ) ) ) get_sidebar(); ?>

  <script src= "<?php echo get_stylesheet_directory_uri(); ?>/js/arrow_down.js"></script>
	<script src= "<?php echo get_stylesheet_directory_uri(); ?>/js/trainer_application/app_trainer.js"></script>


<?php //get_footer(); ?>

<?php get_footer('custes'); ?>
