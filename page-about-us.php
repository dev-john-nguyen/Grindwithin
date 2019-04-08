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
					<h1 class = "page-header">About Us</h1>

					<a id = "arrowDownBtn"><img src = "<?php echo site_url('wp-content/uploads/2019/01/downpoint.png') ?>" style = "width: 10%;" /></a>
				</div>

		</div>

		<div class = "container margin-top-header margin-bottom">

			<div class = "row align-items-start">

				<div class = "col"></div>

<div class = "col-9 form-layout text-left">
	<h3 class = "text-center">We Are A Family</h3>
	<p class = "text-center">Our mission is what drives us to do everything possible to bring out the best in
		every athlete. We do that by putting our athletes first. Not only do we provide high quality and unique
		training programs, but we also value creating a family atmosphere. Once a GrindWithin Athlete, always a
		GrindWithin Athlete.
	</p>

</div>

<div class = "col"></div>

</div>

</div>

  </div>

  <script src= "<?php echo get_stylesheet_directory_uri(); ?>/js/arrow_down.js"></script>

<?php get_footer('custes'); ?>
