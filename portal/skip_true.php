<?php
//１ヶ月想定
  $current_end = $subscription_term_end = $subscription->currentTermEnd; //タームエンド
  $current_start = $subscription_term_end = $subscription->currentTermStart;  //タームのスタート
  $allPlans = $servicePortal->retrieveAllPlans();

  foreach ($allPlans as $plan) {
      if($subscription->planId == $plan->plan()->id){
          $end_term_add_month = $plan->plan()->period;
      }
  }
  if($end_term_add_month == 1){
    $cur_term_x = strtotime('+ 1 month',$current_start); //スキップ ア マンスをしていない場合のタームエンド(１ヶ月)
  }elseif($end_term_add_month == 3){
    $cur_term_x = strtotime('+ 3 month',$current_start); //スキップ ア マンスをしていない場合のタームエンド(3ヶ月)
  }elseif($end_term_add_month == 6){
    $cur_term_x = strtotime('+ 6 month',$current_start); //スキップ ア マンスをしていない場合のタームエンド(6ヶ月)
  }elseif($end_term_add_month == 12){
    $cur_term_x = strtotime('+ 12 month',$current_start); //スキップ ア マンスをしていない場合のタームエンド(12ヶ月)    
  }
  $skip_limit = strtotime('- 1 month',$current_end); //次回スキップ ア マンス開放日
  $no_skip_cur_end = date('Ym01',$cur_term_x); //スキップ ア マンスをしていない場合のタームエンド(１ヶ月)
  $cur_end = date('Ym01',$current_end); //実際のタームエンド
  $skip_st = true;

  $time_now = time(); //現在時間
  if ($time_now >= $skip_limit) {
    $skip_st = true; //タームエンドより1ヶ月以内だったら true
  }else{
    $skip_st = false; //タームエンドより1ヶ月以上前だったら false
  }    
?>