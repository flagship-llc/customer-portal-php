<?php 
    $theme = 'default';
    if($subscription->planId == 'yumetwins-monthly-plan' || $subscription->planId == 'yumetwins-3-month-prepay-plan' || $subscription->planId == 'yumetwins-6-month-prepay-plan' || $subscription->planId == 'yumetwins-12-month-prepay-plan'){
        $yume = true;
        $theme = 'yume';
    } elseif ( $subscription->planId == 'nomakenolife-monthly-plan' || $subscription->planId == 'nomakenolife-3-month-prepay-plan' || $subscription->planId == 'nomakenolife-6-month-prepay-plan' || $subscription->planId == 'nomakenolife-12-month-prepay-plan' ){
        $yume  = false;
        $theme = 'nomake';
    }else{
        $yume = false;
    }
?>