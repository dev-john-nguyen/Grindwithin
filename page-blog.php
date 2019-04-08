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

		<div id = "display-sessions" class="row align-items-center" style = "text-align: center; padding-bottom: 50px;">
			<div class="col align-items-center" id = "header-content-items">
				<h1>Blog</h1>
				<a id = "arrowDownBtn"><img src = "<?php echo site_url('wp-content/uploads/2019/01/downpoint.png') ?>" style = "width: 10%;" /></a>
			</div>
		</div>

		<div class = "blog-items">
		<?php
		global $more;
		$myposts = get_posts('');
		$count = $index1 = $index2 = $index3 = 0;
		$array1 = array();
		$array2 = array();
		$array3 = array();
		foreach($myposts as $post) :
			setup_postdata($post);
		$count ++;
		if ($count % 3 == 0){
			$array1[$index1] = $post;
			$index1 ++;
		}else if ($count % 2 == 0){
			$array2[$index2] = $post;
			$index2 ++;
		}else{
			$array3[$index3] = $post;
			$index3 ++;
		}

	endforeach;

	$currentArray = array();

	for ($i = 1; $i <= 3; $i++){

	?> <div class = "div-blog-items <?php echo $i; ?>" > <?php

	if ($i == 1){
		$currentArray = $array1;
	}else if ($i == 2){
		$currentArray = $array2;
	}else {
		$currentArray = $array3;
	}
	foreach($currentArray as $post) :
		setup_postdata($post);
		$more = 0;
		$size = 'full';

		?>
		  <div class="post-item">
		    <div class="post-info">
					 <a id = "thumbnail_image" href="<?php the_permalink() ?>"><?php the_post_thumbnail($size, 'class=thumbnail_images'); ?></a>
		      <h2 class="post-title">
		      <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
		      <?php the_title(); ?>
		      </a>
		      </h2>
					<p class="post-meta">Posted by <?php the_author(); ?> <br> Date: <?php the_date(); ?></p>
		    </div>
		    <div class="post-content">
		    <?php the_content('read more ...'); ?>
		    </div>
		  </div>
		<?php endforeach; wp_reset_postdata(); ?> </div> <?php } ?>
</div>

	</div><!-- #primary -->

<style type="text/css">
	.fl-builder .site-content{ max-width:1100px !important; margin:0 auto !important;}
</style>

<?php if ( !is_plugin_active('woocommerce/woocommerce.php') || ( is_plugin_active('woocommerce/woocommerce.php') && ( !isset( $layout_default ) || !$layout_default || ( $layout_default == 'sidebar-left' ) || ( $layout_default == 'sidebar-right' ) ) ) ) get_sidebar(); ?>



<?php //get_footer(); ?>

<?php get_footer('custes'); ?>
