<?php

session_start();


if(!isset($_SESSION['member']) ){
  header("location: " . site_url('?logout'));
  session_destroy();
  exit();
}else{

        $username = $_SESSION['member'];

        $table = $wpdb->prefix . "members";

          $sql = $wpdb->prepare("SELECT t.fName, t.lName, t.type, t.active FROM $table t where t.username = %s", array($username));
          $result = $wpdb->get_results($sql);

        foreach ($result as $item){
          $active = $item->active;
          if(!$active){
            header("location: " . site_url('?inactive'));
            session_destroy();
            exit();
          }else{
            $_SESSION['type'] = $item->type;
            $_SESSION['firstName'] = $item->fName;
            $_SESSION['lastName'] = $item->lName;
          }
        }

        $type = $_SESSION['type'];
        $firstName = $_SESSION['firstName'];
        $lastName = $_SESSION['lastName'];
////////////////////////////////////////////////////////////

      $tableType = $_SESSION['type'];
      $memberArray = get_member_profile($tableType, $username);

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
        $sessionAmount = $item->sessionAmount;
        $trainer = $item->trainer;
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

<div id = "client-main" class = "client-main">

  <div id = "profile-member" class = "profile">
    <h2 id = "profile-header-text"><?php echo $type; ?></h2>
            <img class = "profile-image" src = "<?php echo site_url($imagePath); ?>"/>
    <div id = "profile-information" class = "profile-information">

      <div id = "profile-personal" class = "profile-personal">
      <p>Name: <?php echo $firstName . " " .   $lastName; ?> </p>
      <p>Athlete: <?php echo stripslashes($athleteType); ?></p>
      <p>Birthday: <?php echo GetAge($birthday); ?> years old</p>
      <p>Height: <?php echo $heightFeet ?>'<?php echo $heightInch ?>"</p>
      <p>Email: <?php echo $email; ?></p>
      <p>Phone Number: <?php echo $phoneNumber; ?></p>
      </div>

      <div id = "profile-description" class = "profile-description">
        <p>Background: <?php echo stripslashes($description); ?></p>
        <p>Purpose: <?php echo stripslashes($purpose); ?></p>
        <p>Goal: <?php echo stripslashes($goal); ?></p>
      </div>

    </div>


  </div>


  <?php if($tableType == "client"){

    if($trainer == "none"){
      ?>
      <p>A trainer will be assigned to you shortly</p>
      <?php
    }else{

        $tableType = 'trainer';
        $memberArray = get_member_profile($tableType, $trainer);

        $username = $trainer;


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

        ?>

        <div id = "profile-trainer" class = "profile">
          <h2 id = "profile-header-text">trainer</h2>
                  <img class = "profile-image" src = "<?php echo site_url($imagePath); ?>"/>
          <div id = "profile-information" class = "profile-information">

            <div id = "profile-personal" class = "profile-personal">
            <p>Name: <?php echo $firstName . " " .   $lastName; ?> </p>
            <p>Athlete: <?php echo stripslashes($athleteType); ?></p>
            <p>Birthday: <?php echo GetAge($birthday); ?> years old</p>
            <p>Height: <?php echo $heightFeet ?>'<?php echo $heightInch ?>"</p>
            <p>Email: <?php echo $email ?> </p>
            </div>

            <div id = "profile-description" class = "profile-description">
              <p>Background: <?php echo stripslashes($description); ?></p>
              <p>Purpose: <?php echo stripslashes($purpose); ?></p>
              <p>Goal: <?php echo stripslashes($goal); ?></p>
            </div>

          </div>


        </div>

        <?php


  }

}?>

  </div>
</div>



<?php get_footer('custes'); ?>
