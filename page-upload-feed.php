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
					<h1 class = "page-header">Upload Image or Video</h1>
				</div>

		</div>

		<div class = "container margin-top-header margin-bottom">
      <form id = "content-form-image" enctype="multipart/form-data" method="post">
        <p>Upload Image</p>
      <input type = "file" id = "file1"/>
			<input type = 'text' placeholder="description" id = "descriptionImage"/>
      <input class = "mt-3" type = "submit" value = "Upload"/>
    </form>

    <form class = "mt-3" id = "content-form-video"  method="post">
      <p>Upload Video</p>
    <input type = "text" id = "youtubeUrl" placeholder="Youtube URL (Make Sure It's embedded Youtube Link)"/>
		<input type = 'text' placeholder="description" id = "descriptionVideo"/>
    <input class = "mt-3" type = "submit" value = "Upload"/>
  </form>

</div>

  </div>

  <script src= "<?php echo get_stylesheet_directory_uri(); ?>/js/feed/upload-feed.js"></script>

<?php get_footer('custes'); ?>
