<?php
    include("header.php");
    $customer = $servicePortal->getCustomer();
    $billingAddress = $customer->billingAddress;
    $subscription = $servicePortal->getSubscription();
    $customerInvoice = $servicePortal->retrieveInvoice();

    $subscription_id = $subscription->id;
    $subscription_term_start = $subscription->currentTermStart;
    $subscription_term_end = $subscription->currentTermEnd;
    $one_month_after_start = strtotime( "+1 month", $subscription_term_start) ;
    $one_month_after_end = strtotime( "+1 month", $subscription_term_end) ;

    ChargeBee_Environment::configure("tokyotreat-test","test_GaRJqYcqiISoo439GgkSbPUgFHIjS6GD");
    $result = ChargeBee_Subscription::changeTermEnd($subscription_id, array(
    "termEndsAt" => $one_month_after_end));
    $subscription = $result->subscription();
    $customer = $result->customer();
    $card = $result->card();
?>

<div class="container text-center"><b>Skip a month　実行中</b></div>

<?php include("footer.php"); ?>
<script>
    function jump(){
        location.href = "index.php";
    }
    jump();

</script>