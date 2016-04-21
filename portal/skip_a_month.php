<?php
    include("header.php");
    $customer = $servicePortal->getCustomer();
    $billingAddress = $customer->billingAddress;
    $subscription = $servicePortal->getSubscription();
    $customerInvoice = $servicePortal->retrieveInvoice();

    $subscription_id = $subscription->id;
    $subscription_term_end = $subscription->currentTermEnd;
    $subscription_term_end_jp = new DateTime();
    $subscription_term_end_jp->setTimestamp($subscription_term_end)->setTimezone(new DateTimeZone('Asia/Tokyo'));
    
    $end_day = date('d',$subscription_term_end_jp);    
    $end_month = date('m',$subscription_term_end_jp);
    $end_year = date('Y',$subscription_term_end_jp);
    $last_day = date('t', mktime(0, 0, 0, $end_month, 1, $end_year));
    $next_add_day ='+ '.($last_day - $end_day + 1).' day';
    
    $one_month_after_end = strtotime( $next_add_day.'+ 7 hour', $subscription_term_end) ;

    ChargeBee_Environment::configure("tokyotreat-test","test_GaRJqYcqiISoo439GgkSbPUgFHIjS6GD");
    $result = ChargeBee_Subscription::changeTermEnd($subscription_id, array(
    "termEndsAt" => $one_month_after_end));
    $subscription = $result->subscription();
    $customer = $result->customer();
    $card = $result->card();
    

?>

    <div class="container text-center"><b>Skip a month now...</b></div>

    <?php include("footer.php"); ?>
    <script>
        function jump(){
            location.href = "index.php";
        }
        jump();

    </script>
