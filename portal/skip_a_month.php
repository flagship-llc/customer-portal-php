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
        $subscription_term_end = $subscription->currentTermEnd; // サブスクリプションの更新予定日
        $subscription_term_end = strtotime( '+ 9 hour',$subscription_term_end); // **修正**
        
        $end_month = date('m',$subscription_term_end) + 1; // サブスクリプションの更新予定日の月（フォーマットは01-12）の翌月
        $end_year = date('Y',$subscription_term_end); // サブスクリプションの更新予定日の年（フォーマットは4 桁の数字）
        $nextmonth_end_day = date('t', mktime(0, 0, 0, $end_month, 1, $end_year)); // 指定した年月の日数（最終日）（例：28-31）
        $current_end_day = date('d',$subscription_term_end); // 次回更新予定日の日（フォーマットは01-31）

        // 変更前の月の日数が、翌月の日数よりも多い時（例： 31日間 vs 30日間）
        if($nextmonth_end_day - $current_end_day < 0){
            $next_last = date('Y-m-t', mktime(0, 0, 0, $end_month, 1, $end_year)); // **修正**
            $one_month_after_end = strtotime($next_last); // **修正**
        }else{ // 上記以外
            $one_month_after_end = strtotime( '+ 1 month - 9 hour', $subscription_term_end); // **修正**
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
