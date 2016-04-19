<?php
    include_once('init.php');
    $customer = $servicePortal->getCustomer();
    $billingAddress = $customer->billingAddress;
    $subscription = $servicePortal->getSubscription();
    $customerInvoice = $servicePortal->retrieveInvoice();

    $subscription_id = $subscription->id;

    ChargeBee_Environment::configure("tokyotreat-test","test_GaRJqYcqiISoo439GgkSbPUgFHIjS6GD");
    $result = ChargeBee_Subscription::cancel($subscription_id);
    $subscription = $result->subscription();
    $customer = $result->customer();
    $card = $result->card();
    $invoice = $result->invoice();
?>