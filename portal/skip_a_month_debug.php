<?php
date_default_timezone_set('UTC');

function skip_debug($time){
  $subscription_term_end = $time; // サブスクリプションの更新予定日
  
  $end_month = date('m',$subscription_term_end) + 1; // サブスクリプションの更新予定日の月（フォーマットは01-12）の翌月
  $end_year = date('Y',$subscription_term_end); // サブスクリプションの更新予定日の年（フォーマットは4 桁の数字）
  $nextmonth_end_day = date('t', mktime(0, 0, 0, $end_month, 1, $end_year)); // 指定した年月の日数（最終日）（例：28-31）
  $current_end_day = date('d',$subscription_term_end); // 次回更新予定日の日（フォーマットは01-31）
  $current_end_hour = date('H',$subscription_term_end); // 次回更新予定日の時（フォーマットは00-23）
  $current_end_minutes = date('i',$subscription_term_end); // 次回更新予定日の分（フォーマットは00-59）
  $current_end_secound = date('s',$subscription_term_end); // 次回更新予定日の秒（フォーマットは00-59）

  // 変更前の月の日数が、翌月の日数よりも多い時（例： 31日間 vs 30日間）
  // 例：30日(間) - 31日 = 0以下となった場合、+ 1 monthでは、次回更新予定日が翌々月になってしまう
  // 上記例に当てはまる月末日のための処理
  if($nextmonth_end_day - $current_end_day < 0){
      $next_last = date('Y-m-t H:i:s', mktime($current_end_hour, $current_end_minutes, $current_end_secound, $end_month, 1, $end_year)); // 次回更新日を翌月の最終日に設定
      $one_month_after_end = strtotime($next_last); // 次回契約更新日の延長予定日をタイムスタンプに変換
  }else{ // 上記以外
      $one_month_after_end = strtotime( '+ 1 month', $subscription_term_end); // 次回契約更新日に1ヶ月足す
  }

  echo date('Y/n/j gA',$subscription_term_end).'（UTC） => Skip a Month => Next billing at: '.date('Y/n/j gA',$one_month_after_end).'（UTC）<br>';

}

skip_debug('1456786800');
skip_debug('1454270400');
skip_debug('1459368000');
skip_debug('1462046400');
skip_debug('1459429200');
skip_debug('1459461600');

?>








