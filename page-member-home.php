<?php

session_start();


if(!isset($_SESSION['member']) ){
    header("location: http://localhost/Efitprogram/create/");
    session_destroy();
    exit();
}

global $wpdb;

$username = $_SESSION['member'];

$table = $wpdb->prefix . "bitches";

$result = $wpdb->get_results("SELECT t.fName, t.lName, t.goal FROM $table t where t.username = '$username'");

foreach ($result as $item){

  $_SESSION['firstName'] = $item->fName;
  $_SESSION['lastName'] = $item->lName;
  $_SESSION['goal'] = $item->goal;

}

$firstName = $_SESSION['firstName'];
$lastName = $_SESSION['lastName'];
$goal = $_SESSION['goal'];


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

    <h1 style = "color: black;"><?php echo $username ?></h1>




	</div><!-- #primary -->

<style type="text/css">
	.fl-builder .site-content{ max-width:1100px !important; margin:0 auto !important;}
</style>

<?php if ( !is_plugin_active('woocommerce/woocommerce.php') || ( is_plugin_active('woocommerce/woocommerce.php') && ( !isset( $layout_default ) || !$layout_default || ( $layout_default == 'sidebar-left' ) || ( $layout_default == 'sidebar-right' ) ) ) ) get_sidebar(); ?>



<?php //get_footer(); ?>

<?php get_footer('custes'); ?>
