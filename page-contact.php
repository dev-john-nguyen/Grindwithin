<?php

session_start();


if(!isset($_SESSION['member']) ){
  header("location: http://localhost/main/");
  session_destroy();
  exit();
}else{

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





get_header("member");

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


	<div id="primary" class="content-area sidebar-left">

		<main id="main" class="site-main" role="main">

      <div class = "form-layout margin-top-format">
        <h3 style = "margin-bottom: 1.5rem"><u>Contact Us</u></h3>
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


		</main><!-- #main -->


	</div><!-- #primary -->

  <script src= "<?php echo get_stylesheet_directory_uri(); ?>/js/contact.js"></script>

<?php get_footer('custes'); ?>
