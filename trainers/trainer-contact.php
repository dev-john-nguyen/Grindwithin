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
    <h1 style = "color: black;"> <?php echo $_SESSION['firstName'] ?> </h1>
  </div>

<?php get_footer('custes'); ?>
