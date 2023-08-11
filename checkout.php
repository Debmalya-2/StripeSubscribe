<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
// require_once './vendor/autoload.php';
include './stripe-php-master/init.php';
// require_once './secrets.php';

\Stripe\Stripe::setApiKey('sk_test_4eC39HqLyjWDarjtT1zdp7dc');
header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost/stripe/';

$checkout_session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['card'],
  'line_items' => [[
    'price_data' => [
      'currency' => 'inr',
      'unit_amount' => $_SESSION['price']*100,
      'product_data' => [
        'name' => $_SESSION['option']." Subscription",
      ],
    ],
    # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
    // 'price' => 'price_1NdXvQSJeomKVOrBY5B3WoRZ',
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . 'details.php',
  'cancel_url' => $YOUR_DOMAIN . 'details.php',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);