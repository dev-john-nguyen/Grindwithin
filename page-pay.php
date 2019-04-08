<?php

// Sanitize Post Array
$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

session_start();

if(empty($POST['purchase-option-text']) || empty($POST['purchase-option-amount']) ||
empty($POST['purchase-option-price'])){
  header("location: " . site_url('purchase-options'));
	exit();
}else{

	$text = $POST['purchase-option-text'];
		$amount = $POST['purchase-option-amount'];
			$price = $POST['purchase-option-price'];

			$totalPrice = $amount * $price;
			$headerstr = $amount . " " . $text . " ($" . $totalPrice . ")";


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

    <div id = "display-sessions" class="row align-items-center" style = "text-align: center; padding-bottom: 50px;">
      <div class="col align-items-center" id = "header-content-items">
          <h1 class = "page-header">Payment</h1>
          <h2>Enter Payment Information Below</h2>
          <p><b><u>Important</u></b>. We do not store your debit/credit card information.
          All payments are handle through Stripe.</p>
          <p>We offer a <b>100% Refund Policy </b>until the 1st month if unsatisfied or any other personal reasons.</p>
          <p>Please contact us if you have financial issues. We are here to help and offer
            special payment programs for individuals that fit the necessary requirements.</p>
          <p>Step 2/3</p>
          <a id = "arrowDownBtn"><img src = "<?php echo site_url('wp-content/uploads/2019/01/downpoint.png') ?>" style = "width: 10%;" /></a>
        </div>

    </div>

<div class="container form-layout form-width margin-top-header margin-bottom">

  <div class = "row">
    <div class = "col"></div>
    <div class = "col">
        <img src = "http://localhost/main/wp-content/uploads/2019/01/stripe-logo.jpg" style = "width: 30%;"/>
    </div>
    <div class = "col"></div>
  </div>

    <h2 class="my-4 text-center">Purchasing <?php echo $headerstr; ?></h2>
    <form action="<?php echo site_url('client-complete'); ?>" method="post" id="payment-form">
      <div class="form-row">
       <input type="text" name="first_name" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="First Name" required>
       <input type="text" name="last_name" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Last Name" required>
       <input type="email" name="email" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Email Address" required>
        <div id="card-element" class="form-control">
          <!-- a Stripe Element will be inserted here. -->
        </div>

        <!-- Used to display form errors -->
        <div id="card-errors" role="alert"></div>
      </div>

			<input type = "text" name = "text" value = "<?php echo $text; ?>" hidden readonly/>
      <input type = "number" name = "amount" value = "<?php echo $amount; ?>" hidden readonly/>
      <input type = "number" name = "price" value = "<?php echo $totalPrice; ?>" hidden readonly/>

      <button>Submit Payment</button>
    </form>
  </div>
</div>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
  <script src="https://js.stripe.com/v3/"></script>
  <script src= "<?php echo get_stylesheet_directory_uri(); ?>/js/charge.js"></script>
  <script src= "<?php echo get_stylesheet_directory_uri(); ?>/js/arrow_down.js"></script>



  <?php get_footer('custes'); ?>
