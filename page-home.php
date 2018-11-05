<?php

session_start();


if(!isset($_SESSION['member']) ){
  header("location: http://localhost/main/");
  session_destroy();
  exit();
}


global $wpdb;

$username = $_SESSION['member'];

$table = $wpdb->prefix . "bitches2";

$result = $wpdb->get_results("SELECT t.fName, t.lName, t.goal, t.type FROM $table t where t.username = '$username'");

foreach ($result as $item){
  $_SESSION['type'] = $item->type;
  $_SESSION['firstName'] = $item->fName;
  $_SESSION['lastName'] = $item->lName;
  $_SESSION['goal'] = $item->goal;

}

$type = $_SESSION['type'];
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
  <h1 style = "color: black;"> <?php echo $username; ?>  </h1>
</div>

<?php get_footer('custes'); ?>
