<?php 
    if($subscription->planId == 'yumetwins-monthly-plan' || $subscription->planId == 'yumetwins-3-month-prepay-plan' || $subscription->planId == 'yumetwins-6-month-prepay-plan' || $subscription->planId == 'yumetwins-12-month-prepay-plan'){
        $yume = true;
    }else{
        $yume = false;
    }
?>