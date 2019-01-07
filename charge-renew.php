<?php

require_once('vendor/autoload.php');

\Stripe\Stripe::setApiKey('sk_test_cosoTfzbWr3wQg7yLLE9x6fh');

// Sanitize Post Array
$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

$first_name = $POST['first_name'];
$last_name = $POST['last_name'];
$email = $POST['email'];
$token = $POST['stripeToken'];

$stripeId = $POST['stripeId'];

$text = "sessions";
$amount = $POST['purchase-option-amount'];
$price = $POST['purchase-option-price'];

$priceStr = "$" . $price . " per session";

$price = $amount * $price;

$descriptionStr = "Purchased " . $amount . " " . $text . " @ " . $priceStr . " ($" . $price . ")";

$price = $price * 100;

try {

  // update Customer In Stripe
  $customer = \Stripe\Customer::retrieve($stripeId);
  $customer->source = $token;
  $customer->save();

    // Charge Customer
    $charge = \Stripe\Charge::create(array(
      "amount" => $price,
      "currency" => "usd",
      "description" => $descriptionStr,
      "customer" => $stripeId,
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
$product = $charge->description;
$last4 = $customer->sources->data[0]->last4;

$username = $_SESSION['member'];

$table = $wpdb->prefix . "clients";

$sql = $wpdb->prepare("SELECT t.sessionAmount FROM $table t where t.username = %s", array($username));
$result = $wpdb->get_results($sql);

foreach($result as $item){
  $sessionAmount = $item->sessionAmount;
}

$sessionTotal = $sessionAmount + $amount;

$result = $wpdb->update($table, array('last4'=>$last4, 'sessionAmount'=>$sessionTotal), array('username'=>$username));


if(empty($tid) || empty($product)){
  header('Location: ' . site_url('home?paymentfailed'));
}else{
  header('Location: ' . site_url('renew-session?success&tid='.$tid.'&sessionTotal='.$sessionTotal));
}


?>
