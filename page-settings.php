<?php

session_start();


if(!isset($_SESSION['member']) ){
  header("location: http://localhost/main/");
  session_destroy();
  exit();
}else{
  $memberArray = get_member_profile();

  foreach ($memberArray as $item){
    $birthday = $item->birthday;
    $imagePath = $item->imagePath;
    $heightFeet = $item->heightFeet;
    $heightInch = $item->heightInch;
    $weight = $item->weight;
    $purpose = $item->purpose;
    $description = $item->description;
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
    <input type ="date" name = "birthday" id = "birthday" placeholder="ddmmyyyy" value = "<?php echo $birthday ?>"/>
    <input type ="number" name = "height-feet" id = "height-feet" max = '8' value = "<?php echo $heightFeet ?>"/>
    <input type ="number" name = "height-inch" id = "height-inch" max = '11' value = "<?php echo $heightInch ?>"/>
    <input type ="number" name = "weight" id = "weight" placeholder = "weight" value = "<?php echo $weight ?>"/>
    <input type = "file" name  = "file-member" id = "file-member"/>
    <img src = "<?php echo site_url($imagePath); ?>"/>
    <input type = "text" name = "purpose" id = "purpose" placeholder = "purpose" value = "<?php echo $purpose ?>"/>
    <input type ="text" name = "goal" id = "goal" placeholder="goal" value = "<?php echo stripslashes($_SESSION['goal']); ?>" />
    <input type ="text" name = "description" id = "description" placeholder="Description" value = "<?php echo $description ?>"/>
    <input type = "submit" name = "submit-member-settings" id = "submit-member-settings"/>
  </form>
</div>

<?php
$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if(strpos($fullUrl, "empty") == true) {
  echo "<p>fuckboy</p>";
}
?>
<?php get_footer('custes'); ?>
