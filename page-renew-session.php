<?php

session_start();

if(!isset($_SESSION['member']) ){
  header("location: " . site_url());
  session_destroy();
  exit();
}else{

  $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  if(strpos($fullUrl, "success") == true){
      $GET = filter_var_array($_GET, FILTER_SANITIZE_STRING);
      $tid = $GET['tid'];
      $sessionTotal = $GET['sessionTotal'];
    }else if (empty($_POST)){
          header('Location: ' . site_url('home?empty'));
    }else{
            if(strpos($fullUrl, "oldform") == true) {
                require_once('charge-old-renew.php');
            }else if(strpos($fullUrl, "newform") == true){
                require_once('charge-renew.php');
            }else{
                header("location: " . site_url('home?failed'));
            }
    }

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

    <div id = "display-sessions" class="row align-items-center" style = "text-align: center; padding-bottom: 50px;">
      <div class="col align-items-center" id = "header-content-items">

          <h1>Thank You For Your Purchase!</h1>
          <h1>Now you have <?php echo $sessionTotal; ?> Sessions Available</h1>
          <hr>
          <p>Your transaction ID is <?php echo $tid; ?></p>
          <p>Email receipt has been sent to your account</p>

  			</div>
  		</div>


  </div>

  <script src= "<?php echo get_stylesheet_directory_uri(); ?>/js/arrow_down.js"></script>

<?php get_footer('custes'); ?>
