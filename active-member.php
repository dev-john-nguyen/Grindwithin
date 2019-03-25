<?php

session_start();

if(!isset($_SESSION['member']) ){
  header("location: " . site_url());
  session_destroy();
  exit();
}

if(isset($_SESSION['active']) ){
  header("location: " . site_url('?inactive'));
  session_destroy();
  exit();
}

?>
