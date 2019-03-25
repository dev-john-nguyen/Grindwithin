<?php

require('active-member.php');

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
        $phoneNumber = $item->phoneNumber;
        $email = $item->email;
        $athleteType = $item->athleteType;
        $sessionAmount = $item->sessionAmount;
        $trainer = $item->trainer;
        $stripeId = $item->stripeId;
        $last4 = $item->last4;
        $annoucement = $item->annoucement;
      }




if($tableType == "client"){

?>

<div class = "popup-session">
  <div class = "popup-session-form">
    <div class = "close-form">+</div>
    <img src = "<?php echo site_url('wp-content/uploads/2018/03/Logomakr_6i0BZz.png') ?>" style = "width: 12%; margin-top: 5%;"/>
    <h2 style = "text-align: center; margin-top: 5%;">Purchase More Sessions</h2>
    <div class = "popup-form">
      <select class = "popup-form-select">
        <option value = "default">Select Package</option>
        <option value = "1" id = "40">1 Session Package($40)</option>
        <option value = "10" id = "38">10 Sessions Package($380)</option>
        <option value = "20" id = "35">20 Sessions Package($700)</option>
      </select>
      <select class = "select-payment-options" style = "display: none; margin-bottom: 5%;">
        <option value = "default">Select Payment</option>
        <option value = "old">Card on File</option>
        <option value = "new">New Card</option>
      </select>

<div class = "all-forms" style = "display: none;">

      <!-- Old Card Form -->
    <div id = "old-card-form" style = "display: none; margin-bottom: 5%;">
      <form id = "old-form" action="<?php echo site_url('renew-session?oldform'); ?>" method="post">
        <div id = "old-form-items">
        </div>
      <div id = "old-payment">
        <input type = "text" name = "old-last4" value = "<?php echo $last4; ?>" hidden readonly/>
        <input type = "text" name = "stripeId" value = "<?php echo $stripeId; ?>" hidden readonly/>
        <p><b>Last 4 Digits: </b><?php echo $last4; ?></p>
      </div>
      <button class = "btn btn-primary btn-block mt-4" id = "old-form-btn" hidden></button>
    </form>

    <button class="btn btn-primary btn-block mt-4 pre-confirm-submit" value = "old">Submit</button>
  </div>

        <!-- New Card Form -->
      <div id = "payment-card-form" style = "display:none; margin-bottom: 5%;">
        <form action="<?php echo site_url('renew-session?newform'); ?>" method="post" id="payment-form">
          <div id = "new-form-items">
          </div>
          <div class="form-row">
                    <input type = "text" name = "stripeId" value = "<?php echo $stripeId; ?>" hidden readonly/>
           <input type="text" name="first_name" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="First Name" required>
           <input type="text" name="last_name" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Last Name" required>
           <input type="email" name="email" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Email Address" required>
           <div id="card-element" class="form-control">
             <!-- a Stripe Element will be inserted here. -->
           </div>

           <!-- Used to display form errors -->
           <div id="card-errors" role="alert"></div>
         </div>
         <button class="btn btn-primary btn-block mt-4" id = "new-form-btn" hidden></button>
        </form>

        <button class="btn btn-primary btn-block mt-4 pre-confirm-submit" value = "new">Submit</button>
      </div>

</div>

    </div>
  </div>
</div>

<div class = "popup-confirm">
  <div class = "popup-confirm-form">
    <div class = "container" style = "margin-bottom: 5%;">
      <img src = "<?php echo site_url('wp-content/uploads/2018/03/Logomakr_6i0BZz.png') ?>" style = "width: 12%; margin-top: 5%;"/>
      <div class = "row">
        <div class = "col" id = "confirm-content"></div>
      </div>
      <div class = "row">
        <div class = "col">
          <button class="btn btn-primary btn-block mt-4" id = "confirmBtn">Confirm</button>
        </div>
        <div class = "col">
          <button class="btn btn-primary btn-block mt-4" id = "cancelBtn">Cancel</button>
        </div>
      </div>

    </div>


  </div>
</div>

<?php

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

<?php if($tableType == "client"){ ?>
  <script src="https://js.stripe.com/v3/"></script>
  <script src= "<?php echo get_stylesheet_directory_uri(); ?>/js/charge.js"></script>
<?php } ?>

<div class="container-fluid">

<div id = "client-main" class = "client-main">

  <div id = "display-sessions" class="row align-items-center text-center" style = "padding-bottom: 50px;">
    <div class="col align-items-center" id = "header-content-items">
        <h1 class = "page-header">Welcome <?php echo $firstName; ?>!</h1>

        <?php if($_SESSION['type'] == "trainer"){ ?>
            <p style="text-align: center;">
              <a class="button primary-button" href="<?php echo site_url('home/my-clients'); ?>">New Clients</a>
              <a class="button secondary-button" href="<?php echo site_url('home/available-clients'); ?>">Available Clients</a>
            </p>
        <?php }else{ ?>
          <h2>Training Sessions Available: <?php echo $sessionAmount; ?></h2>
          <div id = "session-buttons" class = "session-buttons" style = "display: inline-flex;">
            <input type = "button" id = "popupbtn" class="btn btn-primary btn-block mt-1" value = "Purchase More Sessions" />
          </div>
        <?php } ?>

      </div>

  </div>

  <div class="container">


<!-- Display Annoucement For Client -->

<?php if($tableType == "client") {?>
    <div class = "row text-center margin-top-header">
      <div class = "col"></div>
      <div class = "col-sm-8 form-layout">
        <h2><b>Annoucement:</b> <?php echo stripslashes($annoucement); ?><h2>
      </div>
      <div class = "col"></div>
    </div>

<?php }else if($tableType == "trainer"){
  $tableClient = $wpdb->prefix . "clients";
  $resultSessionClient = $wpdb->get_results("SELECT t.username, t.sessionAmount FROM $tableClient t WHERE t.trainer = '$username' AND t.sessionAmount is null OR t.sessionAmount = 0");
  ?>
  <div class = "row text-center margin-top-header">
    <div class = "col"></div>
    <div class = "col-sm-8 form-layout">

      <?php if(empty($resultSessionClient)){ ?>
        <h2>Keep It Up!<h2>
      <?php }else{ ?>
                <h2 class = "text-danger"><u>Warning: Clients Without Sessions!</u></h2>
        <select>
          <option value = "default">Clients</option>
        <?php
        foreach ($resultSessionClient as $item){
          $username = $item->username;
          $sessionAmount = $item->sessionAmount;

          if($sessionAmount < 1) {
            $sessionAmount = 0;
          }

          ?>
          <option><?php echo $username . " (" . $sessionAmount . " sessions)"; ?>
          </option>
          <?php } ?>
      </select>
      <?php } ?>
    </div>
    <div class = "col"></div>
  </div>
<?php } ?>



<div class="row" <?php if($_SESSION['type'] == "trainer"){?> style = "width: 50%; margin: 0 auto;" <?php } ?>>
  <div class = "col">
    <div class = "col profile">

    <div id = "profile-header-information" class = "row align-items-center">

          <div id = "profile-img-description" class = "col-sm-4" style = "text-align: center;">
            <h2 id = "profile-header-text" style = "text-align: center;"><?php echo $type; ?></h2>
            <img class = "profile-image" src = "<?php echo site_url($imagePath); ?>"/>
          </div>

            <div id = "profile-personal" class = "col-sm-8">
            <p><b>Name:</b> <?php echo $firstName . " " .   $lastName; ?> </p>
            <p><b>Athlete:</b> <?php echo stripslashes($athleteType); ?></p>
            <p><b>Birthday:</b> <?php echo GetAge($birthday); ?> years old</p>
            <p><b>Height:</b> <?php echo $heightFeet ?>'<?php echo $heightInch ?>"</p>
            </div>
    </div>

    <div id = "profile-information" class = "profile-information">

      <div id = "profile-description" class = "profile-description">
        <p><b>Background:</b> <?php echo stripslashes($description); ?></p>
        <p><b>Purpose:</b> <?php echo stripslashes($purpose); ?></p>
        <p><b>Goal:</b> <?php echo stripslashes($goal); ?></p>
      </div>

      <div id = "profile-contact" class = "profile-contact">
        <p><b>Email:</b> <?php echo $email; ?></p>
        <p><b>Phone Number:</b> <?php echo $phoneNumber; ?></p>
      </div>

    </div>

  </div>

  </div>

<!--Display Trainer Information For Client -->

  <?php if($tableType == "client"){

    if($trainer == "none"){
      ?>
  <div class = "col">
    <div class = "col profile text-center">
        <div id = "profile-trainer" class = "row">
          <h1>A trainer will be assigned to you shortly</h1>
        </div>
    </div>
  </div>
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
          $phoneNumber = $item->phoneNumber;
          $email = $item->email;
          $athleteType = $item->athleteType;
        }

        ?>

        <div class = "col">
          <div class = "col profile">
          <div id = "profile-header-information" class = "row align-items-center">

                <div id = "profile-img-description" class = "col-sm-4" style = "text-align: center;">
                  <h2 id = "profile-header-text" style = "text-align: center;">Trainer</h2>
                  <img class = "profile-image" src = "<?php echo site_url($imagePath); ?>"/>
                </div>

                  <div id = "profile-personal" class = "col-sm-8">
                  <p><b>Name:</b> <?php echo $firstName . " " .   $lastName; ?> </p>
                  <p><b>Athlete:</b> <?php echo stripslashes($athleteType); ?></p>
                  <p><b>Birthday:</b> <?php echo GetAge($birthday); ?> years old</p>
                  <p><b>Height:</b> <?php echo $heightFeet ?>'<?php echo $heightInch ?>"</p>
                  </div>
          </div>

          <div id = "profile-information" class = "profile-information">

            <div id = "profile-description" class = "profile-description">
              <p><b>Background:</b> <?php echo stripslashes($description); ?></p>
              <p><b>Purpose:</b> <?php echo stripslashes($purpose); ?></p>
              <p><b>Goal:</b> <?php echo stripslashes($goal); ?></p>
            </div>

            <div id = "profile-contact" class = "profile-contact">
              <p><b>Email:</b> <?php echo $email; ?></p>
              <p><b>Phone Number:</b> <?php echo $phoneNumber; ?></p>
            </div>

          </div>


        </div>
      </div>

        <?php


  }

}?>

</div>
</div>
  </div>
</div>

  <script src= "<?php echo get_stylesheet_directory_uri(); ?>/js/home.js"></script>


<?php get_footer('custes'); ?>
