<?php

session_start();


if(!isset($_SESSION['member']) || $_SESSION['type'] != 'trainer'){
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


 $table = $wpdb->prefix . "clients";
 $trainerUser = $_SESSION['member'];
 $results = $wpdb->get_results("SELECT t.fName, t.lName, t.imagePath, t.goal, t.username, t.annoucement FROM $table t WHERE t.trainer = 'none'");

?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


	<div id="primary" class="content-area sidebar-left">

    <div id = "display-sessions" class="row align-items-center" style = "text-align: center; padding-bottom: 50px;">
      <div class="col align-items-center" id = "header-content-items">
          <h1 class = "page-header">Register Clients</h1>
        </div>

    </div>

<div class = "container">
		<div class="row align-items-center">

      <div class = "col">
      </div>

            <div class = "col-8 profile">

              <h3 class ="text-center" style="margin-bottom: 1.5rem"><u>Search Available Clients</u></h3>

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

      <div class="row" style="width: 90%;margin: 0 auto;">

      <div name = "client-info" class = "col profile" style = "box-shadow: none; border: none; display: none;">

        <div id = "profile-info" class = "row align-items-center">

              <div id = "profile-img-description" class = "col-sm-4" style = "text-align: center;">
                  <h2 class="profile-header-text" style="text-align: center;"></h2>
                  <img id = "profile-image" class = "profile-image"/>
              </div>

              <div id = "profile-personal" class = "col-sm-8">
                  <p id = "profile-name"></p>
                  <p id = "profile-height"></p>
                  <p id = "profile-weight"></p>
                  <p id = "profile-birthday"></p>
              </div>

        </div>



        <div id = "profile-body" class = "row">

                  <div id = "profile-description" class = "col">
                      <p id = "profile-description"></p>
                      <p id = "profile-purpose"></p>
                      <p id = "profile-goal"></p>
                      <p id = "email"></p>
                      <p id = "phoneNumber"></p>
                  </div>

                  <div style = "display: none;"></div>

                  <div class = "col" style = "margin: 0 auto;">

                      <form id = "register-client" method = "post" style = "display: none;">
                        <input type = "text" name = "trainer-username" id = "trainer-username" value = "<?php echo $trainerUser; ?>" readonly hidden/>
                        <input type = "submit" value = "Register client"/>
                      </form>

                </div>

        </div>

      </div>


</div>
</div>

<div class = "col">
</div>

  </div><!-- #row -->
</div><!-- #container -->
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
