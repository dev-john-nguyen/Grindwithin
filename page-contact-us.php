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
					<h1 class = "page-header">Contact Us</h1>

					<a id = "arrowDownBtn"><img src = "<?php echo site_url('wp-content/uploads/2019/01/downpoint.png') ?>" style = "width: 10%;" /></a>
				</div>

		</div>

		<div class = "container margin-top-header margin-bottom">

			<div class = "row align-items-start">

				<div class = "col"></div>

<div class = "col-9 form-layout text-center">
		<h3 style = "margin-bottom: 1.5rem"><u>Any questions or concerns? Contact us!</u></h3>
		<form name = "review-form" id = "review-form" method = "post" style = "margin-bottom: 5%;">
			<input type = "text" class="form-control mb-3" name = "fname" id = "fname" placeholder="First Name" required/>
			<input type = "text" class="form-control mb-3" name = "lname" id = "lname" placeholder="Last Name" required/>
			<input type = "email" class="form-control mb-3" name = "email" id = "email" placeholder="Email" style = "width: 100%" required/>
			<textarea name = "body" class="form-control mb-3" id = "body" placeholder="What's on your mind?" required></textarea>
			<input type = "submit" class="btn btn-primary btn-block mt-4" value = "Submit" style = "width: 100%;"/>
		</form>
		<div class = "techsupport" style = "overflow: overlay;">
			<p><b><u>Contact Tech Support</u></b></p>
			<p><b>Email: </b>techsupport@8rare.com</p>
		</div>
		<div class = "customerservice" style = "overflow: overlay;">
			<p><b><u>Contact Customer Service</u></b></p>
			<p><b>Email: </b>customerservice@8rare.com</p>
		</div>
</div>

<div class = "col"></div>

</div>

</div>

  </div>

  <script src= "<?php echo get_stylesheet_directory_uri(); ?>/js/arrow_down.js"></script>

<?php get_footer('custes'); ?>
