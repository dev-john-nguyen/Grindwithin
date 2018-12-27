<?php

session_start();


if(!isset($_SESSION['member']) ){
  header("location: " . site_url());
  session_destroy();
  exit();
}else{
  $tableType = $_SESSION['type'];
  $memberArray = get_member_profile($tableType, $_SESSION['member']);

  foreach ($memberArray as $item){
    $birthday = $item->birthday;
    $imagePath = $item->imagePath;
    $heightFeet = $item->heightFeet;
    $heightInch = $item->heightInch;
    $weight = $item->weight;
    $purpose = $item->purpose;
    $description = $item->description;
    $goal = $item->goal;
    $email = $item ->email;
    $athleteType = $item->athleteType;
    $phoneNumber = $item->phoneNumber;
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
  <main id="main" class="site-main" role="main">

  <div class = "contact-support-div" style = "margin-top: 12%; text-align: left !important;">

    <h3 style = "margin-bottom: 1.5rem; text-align: center;"><u>Settings</u></h3>

  <label for = "member" style = "float: left; padding-right: 10px;"><b>Username: </b></Label>
  <p name = 'member' id = 'member'> <?php echo $_SESSION['member'] ?> </p>

  <form id = "member-settings" name = "member-settings" method = "post" enctype="multipart/form-data">
      <input type = "text" name = "member" id = "member" value = "<?php echo stripslashes($_SESSION['member']); ?>" readonly hidden/>
      <input type = "text" name = "type" id = "type" value = "<?php echo $tableType; ?>" readonly hidden/>

      <label for = "email"><b>Email: </b></Label>
      <input type = "email" name = "email" id = "email" placeholder = "email" value = "<?php echo $email ?>"/>
<br>
      <label for = "phoneNumber"><b>Phone Number: </b></Label>
      <input type = "number" name = "phoneNumber" id = "phoneNumber" placeholder = "Phone Number" value = "<?php echo $phoneNumber ?>"/>
<br>
      <label for = "athleteType"><b>Athlete: </b></Label>
      <input type = "text" name = "athleteType" id = "athleteType" placeholder = "What type of athlete are you?" value = "<?php echo stripslashes($athleteType); ?>"/>
<br>
      <label for = "birthday"><b>Birthday: </b></Label>
      <input type ="date" name = "birthday" id = "birthday" placeholder="ddmmyyyy" value = "<?php echo $birthday ?>"/>
<br>
      <label for = "height-feet"><b>Height: </b></Label>
      <input type ="number" name = "height-feet" id = "height-feet" max = '8' min = '0' value = "<?php echo $heightFeet ?>" style = "display: table-cell; width: 15%;"/>
      <input type ="number" name = "height-inch" id = "height-inch" max = '11' min = '0' value = "<?php echo $heightInch ?>" style = "display: table-cell; width: 15%;"/>
<br>
      <label for = "weight"><b>Weight: </b></Label>
      <input type ="number" name = "weight" id = "weight" placeholder = "weight" value = "<?php echo $weight ?>"/>
<br>
      <label for = "file-member"><b>Profile Image: </b></Label>
        <br>
      <input type = "file" name  = "file-member" id = "file-member" style = "float: left;"/>
      <img name = "image" id = "image" src = "<?php echo site_url($imagePath); ?>"/>
<br>
      <label for = "purpose"><b>Purpose: </b></Label>
      <textarea type = "text" name = "purpose" id = "purpose" placeholder = "What is your why?"><?php echo stripslashes($purpose); ?></textarea>
<br>
      <label for = "goal"><b>Goal: </b></Label>
      <textarea type ="text" name = "goal" id = "goal" placeholder="What is your goal?"><?php echo stripslashes($goal); ?></textarea>
<br>
      <label for = "description"><b>Background: </b></Label>
      <textarea name = "description" id = "description" placeholder="Give a brief background about yourself"><?php echo stripslashes($description); ?></textarea>

      <input type = "submit" name = "submit-member-settings" id = "submit-member-settings" style = "width: 100%;"/>
  </form>

</div>
</div>
</div>

<?php
$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if(strpos($fullUrl, "failed") == true) {
  echo "failed";
}
?>

<?php get_footer('custes'); ?>
