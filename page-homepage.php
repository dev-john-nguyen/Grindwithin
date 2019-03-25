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

<style>

.homepage-header{
	background-position: left top;
	background-size: cover;
	background-repeat: no-repeat;
	height: 500px;
}

.homepage-single-img{
	background-position: left top;
	background-size: cover;
	background-repeat: no-repeat;
	height: 400px;
}

.homepage-split-img{
	background-position: left top;
	background-size: cover;
	background-repeat: no-repeat;
	height: 400px;
}

.purchase-div{
	padding: 60px;
}


</style>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


	<div id="primary" class="content-area sidebar-left">

		<main id="main" class="site-main" role="main">

			<div class="row homepage-header" style="background-image: url(<?php echo site_url('wp-content/uploads/2018/05/kyle-johnson-389070-unsplash.jpg') ?>);">
		    <div class="col align-self-start"></div>
		    <div class="col align-self-center text-center">
		        <p>Are you a <b>Rare Breed</b>?</p>
		    </div>
		    <div class="col align-self-end"></div>
		  </div>

			<div class = "container">

				<div class = "row align-items-start mt-4">

					<div class = "col purchase-div text-center">
								<h4>$40 Per Session</h4>
								<p>Not Sure, Try A Couple Of Sessions</p>
								<a href = "<?php echo site_url('signup') ?>"><input type = "button" value = "Sign Up"/></a>
					</div>

					<div class = "col purchase-div text-center">
								<h4>10 Session Package</h4>
								<p>Originally $400, Now $380 (Save $20)</p>
								<a href = "<?php echo site_url('signup') ?>"><input type = "button" value = "Sign Up"/></a>
					</div>

					<div class = "col purchase-div text-center">
								<h4>20 Session Package</h4>
								<p>Originally $800, Now $700 (Save $100)</p>
								<a href = "<?php echo site_url('signup') ?>"><input type = "button" value = "Sign Up"/></a>
					</div>

				</div>

				<div class="row homepage-header mt-4" style="background-image: url(<?php echo site_url('wp-content/uploads/2018/05/kyle-johnson-389070-unsplash.jpg') ?>);">
					<div class="col align-self-start"></div>
					<div class="col align-self-center text-center">
							<p>Are you a <b>Rare Breed</b>?</p>
					</div>
					<div class="col align-self-end"></div>
				</div>


				<div class = "row mt-5 mb-5">
					<div class = "col homepage-split-img" style="background-image: url(<?php echo site_url('wp-content/uploads/2018/05/kyle-johnson-389070-unsplash.jpg') ?>);">
					</div>
					<div class = "col-1"></div>
					<div class = "col homepage-split-img" style="background-image: url(<?php echo site_url('wp-content/uploads/2018/05/kyle-johnson-389070-unsplash.jpg') ?>);">
					</div>
				</div>


			</div>






		</main><!-- #main -->


	</div><!-- #primary -->


<?php get_footer('custes'); ?>

<style>

	.container {
	    max-width: 90%;
	}

</style>
