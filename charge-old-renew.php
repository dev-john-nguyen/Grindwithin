<?php

require_once('vendor/autoload.php');

\Stripe\Stripe::setApiKey('sk_test_cosoTfzbWr3wQg7yLLE9x6fh');

// Sanitize Post Array
$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

$stripeId = $POST['stripeId'];

$text = "sessions";
$amount = $POST['purchase-option-amount'];
$price = $POST['purchase-option-price'];

$priceStr = "$" . $price . " per session";

$price = $amount * $price;

$descriptionStr = "Purchased " . $amount . " " . $text . " @ " . $priceStr . " ($" . $price . ")";

$price = $price * 100;

try {


    // Charge Customer
    $charge = \Stripe\Charge::create(array(
      "amount" => $price,
      "currency" => "usd",
      "description" => $descriptionStr,
      "customer" => $stripeId
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

$username = $_SESSION['member'];

$table = $wpdb->prefix . "clients";

$sql = $wpdb->prepare("SELECT t.sessionAmount FROM $table t where t.username = %s", array($username));
$result = $wpdb->get_results($sql);

foreach($result as $item){
  $sessionAmount = $item->sessionAmount;
}

$sessionTotal = $sessionAmount + $amount;

$result = $wpdb->update($table, array('sessionAmount'=>$sessionTotal), array('username'=>$username));


if(empty($tid) || empty($product)){
  header('Location: ' . site_url('home?oldFailed'));
}else{
  header('Location: ' . site_url('renew-session?success&tid='.$tid.'&sessionTotal='.$sessionTotal));
}

?>
