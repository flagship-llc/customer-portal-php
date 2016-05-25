<?php
    include("header.php");
    $subscription = $servicePortal->getSubscription();
    $customer = $servicePortal->getCustomer();
    $billingAddress = $customer->billingAddress;
    $subscription = $servicePortal->getSubscription();
    $customerInvoice = $servicePortal->retrieveInvoice();

    date_default_timezone_set('UTC');
    include("skip_true.php");
    if($skip_st){
        $subscription_id = $subscription->id;
        $subscription_term_end = $subscription->currentTermEnd;
        $subscription_term_end = strtotime( '+ 9 hour',$subscription_term_end);
        
        $end_month = date('m',$subscription_term_end) + 1;
        $end_year = date('Y',$subscription_term_end);
        $nextmonth_end_day = date('t', mktime(0, 0, 0, $end_month, 1, $end_year));
        $current_end_day = date('d',$subscription_term_end);

        if($nextmonth_end_day - $current_end_day < 0){ //31日などの狂いが生じる場合
            $next_last = date('Y-m-t', mktime(0, 0, 0, $end_month, 1, $end_year));
            $one_month_after_end = strtotime($next_last);
        }else{
            $one_month_after_end = strtotime( '+ 1 month - 9 hour', $subscription_term_end);
        }

        $result = ChargeBee_Subscription::changeTermEnd($subscription_id, array(
        "termEndsAt" => $one_month_after_end));
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
