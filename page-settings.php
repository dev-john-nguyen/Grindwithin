<?php

session_start();


if(!isset($_SESSION['member']) ){
  header("location: " . site_url('?logout'));
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


<div id="primary" class="content-area sidebar-left">

  <h1 name = 'member' id = 'member' style = "color: black;"> <?php echo $_SESSION['member'] ?> </h1>
  <form id = "member-settings" name = "member-settings" method = "post" enctype="multipart/form-data">
      <input type = "text" name = "member" id = "member" value = "<?php echo stripslashes($_SESSION['member']); ?>" readonly hidden/>
      <input type = "text" name = "type" id = "type" value = "<?php echo $tableType; ?>" readonly hidden/>
      <input type = "email" name = "email" id = "email" placeholder = "email" value = "<?php echo $email ?>"/>
      <input type = "number" name = "phoneNumber" id = "phoneNumber" placeholder = "Phone Number" value = "<?php echo $phoneNumber ?>"/>
      <input type = "text" name = "athleteType" id = "athleteType" placeholder = "What type of athlete are you?" value = "<?php echo stripslashes($athleteType); ?>"/>
      <input type ="date" name = "birthday" id = "birthday" placeholder="ddmmyyyy" value = "<?php echo $birthday ?>"/>
      <input type ="number" name = "height-feet" id = "height-feet" max = '8' min = '0' value = "<?php echo $heightFeet ?>"/>
      <input type ="number" name = "height-inch" id = "height-inch" max = '11' min = '0' value = "<?php echo $heightInch ?>"/>
      <input type ="number" name = "weight" id = "weight" placeholder = "weight" value = "<?php echo $weight ?>"/>
      <input type = "file" name  = "file-member" id = "file-member"/>
      <img name = "image" id = "image" src = "<?php echo site_url($imagePath); ?>"/>
      <textarea type = "text" name = "purpose" id = "purpose" placeholder = "purpose"><?php echo stripslashes($purpose); ?></textarea>
      <textarea type ="text" name = "goal" id = "goal" placeholder="goal"><?php echo stripslashes($goal); ?></textarea>
      <textarea name = "description" id = "description" placeholder="Description"><?php echo stripslashes($description); ?></textarea>
      <input type = "submit" name = "submit-member-settings" id = "submit-member-settings"/>
  </form>



</div>

<?php
$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if(strpos($fullUrl, "failed") == true) {
  echo "failed";
}
?>

<?php get_footer('custes'); ?>
