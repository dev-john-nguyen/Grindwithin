<?php

session_start();


global $wpdb;

$username = $_SESSION['member'];

$table = $wpdb->prefix . "bitches2";

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
  <h1 style = "color: black;"><?php member ?>  </h1>
</div>


<?php get_footer('custes'); ?>
