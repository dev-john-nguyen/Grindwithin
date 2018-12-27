<?php

if (empty($_POST)){
header('Location: ' . site_url('purchase-options'));
}else{
require_once('charge.php');
}


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

				<div class = "customer-success">

		<h1>Thank you for your purchase and welcome!</h1>
		<hr>
		<p><?php echo $product; ?>.
			Your transaction ID is <?php echo $tid; ?>.
		Email receipt has been sent to your account.</p>

		<h2>Please <b><u>DO NOT</u></b> leave the page. To finish your registration</h2>
		<h2>fill and submit the form below to create your account</h2>

				</div>


		<div class = "new-account-form">

			<h3 style = "margin-bottom: 1.5rem"><u>New Client Form</u></h3>

		<form id = "new-account" name = "new-account" method = "post" >
				<input type = "text" id = "customerId" value = "<?php echo $customerId; ?>" hidden readonly/>
				<input type = "number" id = "sessionAmount" value = "<?php echo $amount; ?>" hidden readonly/>
				<input type = "text" id = "fName" value = "<?php echo $first_name; ?>" hidden readonly/>
				<input type = "text" id = "lName" value = "<?php echo $last_name; ?>" hidden readonly/>
				<input type = "email" id = "email" value = "<?php echo $email; ?>" hidden readonly/>
				<input type = "number" id = "last4" value = "<?php echo $last4; ?>" hidden readonly/>
				<input type = "text" id = "username" placeholder="Username" required/>
				<input type = "password" id = "password" placeholder="Password" required/>
				<input type = "password" id = "re-password" placeholder="Re-enter Password" Password required/>
				<textarea type = "text" id = "athleteType" placeholder="What type of athlete are you?" required></textarea>
				<textarea type = "text" id = "description" placeholder="Brief description of yourself and what you want to accomplish." required></textarea>
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
