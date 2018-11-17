<?php

session_start();


if(!isset($_SESSION['member']) ){
  header("location: http://localhost/main/");
  session_destroy();
  exit();
}else{
  $tableType = $_SESSION['type'];
  $memberArray = get_member_profile($tableType);

  foreach ($memberArray as $item){
    $birthday = $item->birthday;
    $imagePath = $item->imagePath;
    $heightFeet = $item->heightFeet;
    $heightInch = $item->heightInch;
    $weight = $item->weight;
    $purpose = $item->purpose;
    $description = $item->description;
    $goal = $item->goal;
    $phoneNumber = $item->$phoneNumber;
    $email = $item->email;
    $athleteType = $item->athleteType;
  }
}


global $wpdb;

$username = $_SESSION['member'];

$table = $wpdb->prefix . "members";

  $sql = $wpdb->prepare("SELECT t.fName, t.lName, t.type FROM $table t where t.username = %s", array($username));
  $result = $wpdb->get_results($sql);

  // if(empty($result)){
  //   header("Location: ?empty");
  // }

foreach ($result as $item){
  $_SESSION['type'] = $item->type;
  $_SESSION['firstName'] = $item->fName;
  $_SESSION['lastName'] = $item->lName;
}

$type = $_SESSION['type'];
$firstName = $_SESSION['firstName'];
$lastName = $_SESSION['lastName'];

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

<div id="primary" class="content-area sidebar-left" style = "background-color: black;">
  <div id = "header-info" class = "header-info">

    <div id = "profile-info" class = "profile-info">
      <img src = "<?php echo site_url($imagePath); ?>"/>
      <h2>Name: <?php echo $firstName . " " .   $lastName; ?> </h2>
      <h2>Athlete: <?php echo stripslashes($athleteType); ?></h2>
      <h2>Birthday: <?php echo GetAge($birthday); ?> years old</h2>
      <h2>Height: <?php echo $heightFeet ?>'<?php echo $heightInch ?>"</h2>
      <h2>Email: <?php echo $email ?> </h2>

    </div>



    <div id = "entry-header" class = "entry-header">
      <h1>Welcome <?php echo $_SESSION['member']; ?>!</h1>
      <h2>Background: <?php echo stripslashes($description); ?></h2>
      <h2>Purpose: <?php echo stripslashes($purpose); ?></h2>
      <h2>Goal: <?php echo stripslashes($goal); ?></h2>
    </div>

  </div>
  <?php if($tableType == "client"){
    //Add annoucement attribute
    //Add trainer profile
  }?>

</div>



<?php get_footer('custes'); ?>
