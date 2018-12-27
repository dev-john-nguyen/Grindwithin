<?php

session_start();


if(!isset($_SESSION['member']) && !$_SESSION['type'] == 'trainer'){
  header("location: " . site_url());
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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


	<div id="primary" class="content-area sidebar-left">

		<main id="main" class="site-main" role="main">

            <div class = "contact-support-div" style = "margin-top: 12%;">
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

          <p id = "profile-name"></p>
          <p id = "profile-height"></p>
          <p id = "profile-weight"></p>
          <p id = "profile-birthday"></p>
          <img id = "profile-image"/>
          <p id = "profile-description"></p>

        </div>



        <div id = "client-header" class = "client-header">
          <p id = "profile-goal"></p>
          <p id = "profile-purpose"></p>
          <p id = "sessionAmount"></p>
          <p id = "email"></p>
          <p id = "phoneNumber"></p>
        </div>

      </div>

      <form id = "add-sessions-form" method = "post">
        <input type = "text" name = "trainer-username" id = "trainer-username" value = "<?php echo $trainerUser; ?>" readonly hidden/>
        Send Additional Sessions: <input type = "number" id = "add-sessions" min = "1"/>
        <input type = "submit"/>
      </form>

      <form id = "client-reminder" name = "client-reminder" method = "post">
        <input type = "text" name = "trainer-username" id = "trainer-username" value = "<?php echo $trainerUser; ?>" readonly hidden/>
      Send a Reminder: <input type ="text" name = "reminder-input" id = "reminder-input" value = "<?php echo stripslashes(); ?>" />
      <input type = "submit">
      </form>

</div>

		</main><!-- #main -->


	</div><!-- #primary -->

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
