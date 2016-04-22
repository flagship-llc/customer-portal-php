<?php
include_once('header.php');
$customer = $servicePortal->getCustomer();
$subscription = $servicePortal->getSubscription();
$termEndDate = date('d-M-Y', $subscription->currentTermEnd);
$subscription_term_end = $subscription->currentTermEnd;
$one_month_after_end = strtotime( "+1 month", $subscription_term_end) ;

require 'ChargeBee.php';
ChargeBee_Environment::configure("tokyotreat-test","test_GaRJqYcqiISoo439GgkSbPUgFHIjS6GD");
$all = ChargeBee_Subscription::subscriptionsForCustomer($customer->id, array(
  "limit" => 5));
foreach($all as $entry){
  $subscription = $entry->subscription();
}
?>