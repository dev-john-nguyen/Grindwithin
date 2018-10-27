<?php

session_start();


if(isset($_SESSION['member']) ){
  require_once('members/member-home.php');
}else if (isset($_SESSION['trainer'])){
  require_once('trainers/trainer-home.php');
}else{
  header("location: http://localhost/main/");
  session_destroy();
  exit();
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

?>
