<?php

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


  $table = $wpdb->prefix . "app_trainer";

  $results = $wpdb->get_results("SELECT t.fName, t.lName, t.email, t.status FROM $table t where t.status != 'decline' OR t.status != 'complete'");

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


	<div id="primary" class="content-area sidebar-left">

		<div id = "display-sessions" class="row align-items-center" style = "text-align: center; padding-bottom: 50px;">
			<div class="col align-items-center" id = "header-content-items">
				<h1>Trainer Applications</h1>
				<a id = "arrowDownBtn"><img src = "http://localhost/main/wp-content/uploads/2019/01/downpoint.png" style = "width: 10%;" /></a>
			</div>
		</div>

			<div class = "container">

        <div class="row align-items-center">

          <div class = "col">
          </div>

                <div class = "col-10 profile">

                  <h3 class ="text-center" style="margin-bottom: 1.5rem"><u>Trainer Applications</u></h3>

      <div class = "row">

        <div class = "col">

          <select class = "applicant-list" name = "applicant-list">
            <option value = "default">Search Processing Applicants</option>
            <?php
            foreach($results as $item){
              $fName = $item->fName;
              $lName = $item->lName;
              $email = $item->email;
              $status = $item->status;

                if ($status == "processing"){
                ?>
                <option value = "<?php echo $email ?>" ><?php echo $fName . " " . $lName . " (" . $email . ")"?> </option>
                <?php
              }
            }
            ?>
          </select>

        </div>

        <div class = "col">

          <select class = "applicant-list" name = "applicant-list">
            <option value = "default">Search Review Applicants</option>
            <?php
            foreach($results as $item){
              $fName = $item->fName;
              $lName = $item->lName;
              $email = $item->email;
              $status = $item->status;

                if ($status == "review"){
                ?>
                <option value = "<?php echo $email ?>" ><?php echo $fName . " " . $lName . " (" . $email . ")"?> </option>
                <?php
              }
            }
            ?>
          </select>

        </div>

        <div class = "col">

          <select class = "applicant-list" name = "applicant-list">
            <option value = "default">Search Accepted Applicant</option>
            <?php
            foreach($results as $item){
              $fName = $item->fName;
              $lName = $item->lName;
              $email = $item->email;
              $status = $item->status;

                if ($status == "accept"){
                ?>
                <option value = "<?php echo $email ?>" ><?php echo $fName . " " . $lName . " (" . $email . ")"?> </option>
                <?php
              }
            }
            ?>
          </select>

        </div>

      </div>


          <div name = "applicant-info" class="row" style="width: 90%;margin: 0 auto; display: none;">

          <div class = "col profile" style = "box-shadow: none; border: none;">

            <div class = "row">

            <div id = "profile-info" class = "col align-items-center">

                  <div id = "profile-personal" class = "col-sm-8">
                      <p id = "full-name"></p>
                      <p id = "email"></p>
                      <p id = "certified"></p>
                      <p id = "yearsExp"></p>
                  </div>

            </div>



            <div id = "profile-body" class = "col-7">

                      <div id = "profile-description" class = "col">
                          <p id = "sportName"></p>
                          <p id = "sportLvl"></p>
                          <p id = "q1"></p>
                          <p id = "q2"></p>
                          <p id = "q3"></p>
                      </div>


            </div>

          </div>

          </div>

          <div class = "col" id = "trainer-app-buttons">
            <form id = "update-trainer-app">
              <input type = "text" name = "trainer-app-email" hidden readonly/>
              <input type = "button" id = "decline" class = "btn btn-primary btn-block mt-4" value = "Decline"/>
              <input type = "button" id = "review" class = "btn btn-primary btn-block mt-4" value = "Review"/>
              <input type = "button" id = "accept" class = "btn btn-primary btn-block mt-4" value = "Accept"/>
              <input type = "button" id = "complete" class = "btn btn-primary btn-block mt-4" value = "Complete"/>
            </form>
          </div>


    </div>
    </div>

    <div class = "col">
    </div>

      </div><!-- #row -->

	</div>

	</div><!-- #primary -->

  <script src= "<?php echo get_stylesheet_directory_uri(); ?>/js/arrow_down.js"></script>
	<script src= "<?php echo get_stylesheet_directory_uri(); ?>/js/trainer_application/search_applicant.js"></script>
  <script src= "<?php echo get_stylesheet_directory_uri(); ?>/js/trainer_application/trainer_update_app.js"></script>

<?php //get_footer(); ?>

<?php get_footer('custes'); ?>
