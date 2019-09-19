<?php

require_once('vendor/autoload.php');

\Stripe\Stripe::setApiKey('sk_test_cosoTfzbWr3wQg7yLLE9x6fh');

// Sanitize Post Array
$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

$first_name = $POST['first_name'];
$last_name = $POST['last_name'];
$email = $POST['email'];
$token = $POST['stripeToken'];

$text = $POST['text'];
$amount = $POST['amount'];
$price = $POST['price'];
$descriptionStr = "Purchased " . $amount . " " . $text . " ($" . $price . ")";
$price = $price * 100;

try {
    // Create Customer In Stripe
    $customer = \Stripe\Customer::create(array(
      "email" => $email,
      "source" => $token
    ));

    // Charge Customer
    $charge = \Stripe\Charge::create(array(
      "amount" => $price,
      "currency" => "usd",
      "description" => $descriptionStr,
      "customer" => $customer->id,
      'receipt_email' => $email
    ));

  // Use Stripe's library to make requests...
} catch(\Stripe\Error\Card $e) {
  // Since it's a decline, \Stripe\Error\Card will be caught
  $body = $e->getJsonBody();
  $err  = $body['error'];

  print('Status is:' . $e->getHttpStatus() . "\n");
  print('Type is:' . $err['type'] . "\n");
  print('Code is:' . $err['code'] . "\n");
  // param is '' in this case
  print('Param is:' . $err['param'] . "\n");
  print('Message is:' . $err['message'] . "\n");
} catch (\Stripe\Error\RateLimit $e) {
  // Too many requests made to the API too quickly
} catch (\Stripe\Error\InvalidRequest $e) {
  // Invalid parameters were supplied to Stripe's API
} catch (\Stripe\Error\Authentication $e) {
  // Authentication with Stripe's API failed
  // (maybe you changed API keys recently)
} catch (\Stripe\Error\ApiConnection $e) {
  // Network communication with Stripe failed
} catch (\Stripe\Error\Base $e) {
  // Display a very generic error to the user, and maybe send
  // yourself an email
} catch (Exception $e) {
  // Something else happened, completely unrelated to Stripe
}

$tid = $charge->id;
$customerId = $customer->id;
$product = $charge->description;
$last4 = $customer->sources->data[0]->last4;

if(empty($tid) || empty($product)){
  header('Location: ' . site_url('purchase-options?paymentfailed'));
}


//Store New Users Information Into Member Table

session_start();

$username = $_SESSION['username'];
$password = $_SESSION['password'];
$fName = $_SESSION['fName'];
$lName = $_SESSION['lName'];
$email = $_SESSION['email'];

$table = $wpdb->prefix . "members";


$currentDate = current_time( 'mysql' );

$hashPass = wp_hash_password( $password );
// $salt = wp_salt($hashPass);
//
// $hashPass = $salt;

$type = "client";

$result = $wpdb->insert(
      $table,
      array(
    'fName' => $fName,
    'lName' => $lName,
    'type' => $type,
    'email' => $email,
    'username' => $username,
    'damn' => $hashPass,
    'created' => $currentDate,
    'last4' => $last4,
    'stripeId' => $customerId,
    'active' => 1
      )
  );

//Check if result executed correctly
if(!$result > 0 || !$result || $result === false){
  //log error and send notification
}




?>
