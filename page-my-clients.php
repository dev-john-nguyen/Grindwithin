<?php

session_start();


if(!isset($_SESSION['member']) && !$_SESSION['type'] == 'trainer'){
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

 get_header();

?>

<div id="primary" class="content-area sidebar-left" style = "background-color: black;">

<?php
$table = $wpdb->prefix . "clients";
$trainerUser = $_SESSION['member'];
$sql = $wpdb->prepare("SELECT t.fName, t.lName, t.username FROM $table t WHERE t.trainer = %s", array($trainerUser));
$results = $wpdb->get_results($sql);

?>
<select id = "my-client-list" name = "my-client-list">
  <option value = "default">Select a Client</option>
  <?php
  foreach($results as $item){
    $username = $item->username;
    $fName = $item->fName;
    $lName = $item->lName;
    ?>
    <option value = "<?php echo $username ?>" ><?php echo $fName . " " . $lName ?> </option>
    <?php
  }
  ?>
</select>


<div name = "client-info" id = "client-info">

  <div id = "profile-info" class = "profile-info">

    <h2 id = "profile-name"></h2>
    <h2 id = "profile-height"></h2>
    <h2 id = "profile-weight"></h2>
    <h2 id = "profile-birthday"></h2>
    <img id = "profile-image"/>
    <h2 id = "profile-description"></h2>

  </div>



  <div id = "client-header" class = "client-header">
    <h2 id = "profile-goal"></h2>
    <h2 id = "profile-purpose"></h2>
  </div>

</div>

<form id = "client-reminder" name = "client-reminder" method = "post">
  <input type = "text" name = "trainer-username" id = "trainer-username" value = "<?php echo $_SESSION['member']; ?>" readonly hidden/>
Send a Reminder: <input type ="text" name = "reminder-input" id = "reminder-input" value = "<?php echo stripslashes(); ?>" />
<input type = "submit" id = "reminder-submit" name = "reminder-submit">
</form>

</div>

<!-- <form id = "workout-form" name = "workout-form" method = "post">
  <label for = "month-workout">Insert Month</label>
  <input type = "number" min = "0" id = "input-month"/>
  <label for="select-week">Select Week</label>
  <select id="select-week" name="select-week">
    <option value="week1">week 1</option>
    <option value="week2">week 2</option>
    <option value="week3">week 3</option>
    <option value="week4">week 4</option>
  </select>
  <label for="select-day">Select Day</label>
  <select id="select-day" name="select-day">
    <option value="day1">day 1</option>
    <option value="day2">day 2</option>
    <option value="day3">day 3</option>
    <option value="day4">day 4</option>
    <option value="day5">day 5</option>
    <option value="day6">day 6</option>
    <option value="day7">day 7</option>
  </select><button type="button" id="displayBtn">Display</button>
</form> -->


<?php get_footer('custes'); ?>
