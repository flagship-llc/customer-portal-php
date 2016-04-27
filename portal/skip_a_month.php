<?php
    include("header.php");
    $subscription = $servicePortal->getSubscription();
    $customer = $servicePortal->getCustomer();
    $billingAddress = $customer->billingAddress;
    $subscription = $servicePortal->getSubscription();
    $customerInvoice = $servicePortal->retrieveInvoice();

    include("skip_true.php");
    if($skip_st){
        $subscription_id = $subscription->id;
        $subscription_term_end = $subscription->currentTermEnd;
        
        $end_day = date('d',$subscription_term_end);    
        $end_current_month = date('m',$subscription_term_end);
        $end_month = date('m',$subscription_term_end) + 1;
        $end_year = date('Y',$subscription_term_end);

        if($end_month == 13 ){
            $end_month = 1;
            $end_year = $end_year + 1;
        }

        $current_last_day = date('t', mktime(0, 0, 0, $end_current_month, 1, $end_year));
        $next_last_day = date('t', mktime(0, 0, 0, $end_month, 1, $end_year));
        $next_add_day =$current_last_day - $end_day + 1;
        $next_term = $next_last_day + $next_add_day;
        if($past_skip_true){
            $one_month_after_end = strtotime( '+ '.$next_add_day .' day + 7 hour', $subscription_term_end) ;
        }else{
            $one_month_after_end = strtotime( '+ '.$next_term .' day + 7 hour', $subscription_term_end) ;
        }
        
        $result = ChargeBee_Subscription::changeTermEnd($subscription_id, array(
        "termEndsAt" => $one_month_after_end));
        $subscription = $result->subscription();
        $customer = $result->customer();
        $card = $result->card();        
    }

?>
    <?php if($skip_st):?>
        <div class="container text-center"><b>skipping a month now<b></div>
    <?php else: ?>
        <div class="container text-center"><b>You can skip only one month.</b></div>
    <?php endif;?>

    <?php include("footer.php"); ?>
    
    <script>
        function jump(){
            location.href = "index.php";
        }
        jump();

    </script>
