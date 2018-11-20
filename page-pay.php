<?php

// Sanitize Post Array
$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

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

<div class="container">
    <h2 class="my-4 text-center">Purchasing <?php echo $headerstr; ?></h2>
    <form action="<?php echo site_url('signup'); ?>" method="post" id="payment-form">
      <div class="form-row">
       <input type="text" name="first_name" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="First Name">
       <input type="text" name="last_name" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Last Name">
       <input type="email" name="email" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Email Address">
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



  <?php get_footer('custes'); ?>
