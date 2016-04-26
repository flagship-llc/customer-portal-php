<?php
    include("header.php");
    $customer = $servicePortal->getCustomer();
    $billingAddress = $customer->billingAddress;
    $subscription = $servicePortal->getSubscription();
    $customerInvoice = $servicePortal->retrieveInvoice();

        $subscription_id = $subscription->id;
        $subscription_term_end = $subscription->currentTermEnd;
        
        $end_day = date('d',$subscription_term_end);    
        $end_month = date('m',$subscription_term_end);
        $end_year = date('Y',$subscription_term_end);
        $last_day = date('t', mktime(0, 0, 0, $end_month, 1, $end_year));
        $next_add_day ='+ '.($last_day - $end_day + 1).' day';

        $one_month_after_end = strtotime( $next_add_day.'+ 7 hour', $subscription_term_end) ;

        $result = ChargeBee_Subscription::changeTermEnd($subscription_id, array(
        "termEndsAt" => $one_month_after_end));
        $subscription = $result->subscription();
        $customer = $result->customer();
        $card = $result->card();
    

?>
        <div class="container text-center"><b>Skip a month now...</b></div>
        <!-- <div class="container text-center"><b>You can't Skip a Month</b></div> -->

    <?php include("footer.php"); ?>
    <script>
        function jump(){
            location.href = "index.php";
        }
        jump();

    </script>
