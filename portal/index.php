<?php
include("header.php");
$customer = $servicePortal->getCustomer();
$billingAddress = $customer->billingAddress;
$subscription = $servicePortal->getSubscription();
$customerInvoice = $servicePortal->retrieveInvoice();

?> 
<div class="container">
    <h2 id="customer-title" class="text-center Candal text-darkblue">
        <span class="small-text">カスタマーポータル</span><br>
        CUSTOMER PORTAL

    </h2>
    <div id="cb-wrapper-ssp">

<?php
//１ヶ月想定
  $current_end = $subscription_term_end = $subscription->currentTermEnd; //タームエンド
  $current_start = $subscription_term_end = $subscription->currentTermStart;  //タームのスタート
  $cur_term_x = strtotime('+ 2 month',$current_start); //スキップ ア マンスをしていない場合のタームエンド(１ヶ月)
  $no_skip_cur_end = date('Ym01',$cur_term_x); //スキップ ア マンスをしていない場合のタームエンド(１ヶ月)
  $cur_end = date('Ymd',$current_end); //実際のタームエンド
  $skip_st = true;
  if ($cur_end != $no_skip_cur_end ){ //想定しているタームエンドと異なった場合
      $skip_limit = strtotime('- 1 month',$current_end); //スキップ ア マンスをした後の期間
      $time_now = time(); //現在時間
      if ($time_now >= $skip_limit) {
        $skip_st = true; //タームエンドより1ヶ月以内だったら true
      }else{
        $skip_st = false; //タームエンドより1ヶ月以上前だったら false
      }    
  }
?>
         <?php include("processing.php")  ?>
        <div id="cb-content">

        <div data-cb-cancel-subscription-url="#">
            <div class="cb-well">
                <div id="cb-portal-subscription-title" class="page-header clearfix">
                    <span class="h3">Subscription</span>
                    <span class="cb-subscription-status <?php echo esc($subscription->status) ?>" >
                        <?php echo ucfirst(str_replace("_", " ",  $subscription->status)) ?>
                    </span>
                    <?php
                    if ($settingconfigData["changesubscription"]["allow"] == 'true'){
                        $showEditDisplay = $servicePortal->getEditSubscription($settingconfigData);                    
                        if($showEditDisplay==true) {   ?>
                            <a href=<?php echo getEditUrl("editSubscription.php", $configData) ?>>
                                <span class='glyphicon glyphicon-pencil'></span>Upgrade / Downgrade
                            </a>
                        <?php
                            $showEditDisplay = false;
                        }                    
                    }               
    ?>
                </div>
                <?php include("subscriptionInfo.php") ?>
            </div>

        <div class="cb-well">
            <div id="cb-portal-subscription-info-title" class="page-header clearfix">
                <span class="h4">Timeline</span>
            </div>
            <p class="text-muted">
                <?php 
                $phrase = $infoconfigData['Timeline']['Recurring_charge'];
                $default = array('$planperiod', '$planunit');
                $assign   = array($currentPlanDetails->period, $currentPlanDetails->periodUnit);
                echo str_replace($default,  $assign, $phrase); ?> </p>
                <?php if(isset($subscription->currentTermStart)){ ?>
                    <p class="text-muted">
                        <?php 
                        $phrase = $infoconfigData['Timeline']['Current_term'];
                        $default = array('$subscription.current_term_start', '$subscription.current_term_end');
                        // $assign   = array(date('d-M-Y', $subscription->currentTermStart), date('d-M-Y', $subscription->currentTermEnd));
                        // echo str_replace($default,  $assign, $phrase);

                     ?> 
                    </p> 
                <?php } ?>
                
         <?php if ($subscription->status == "in_trial") {  ?>
                <p class="text-muted">
                    <?php echo str_replace('$subscription.trial_end', date('d-M-Y', $subscription->trialEnd),
                                                $infoconfigData['Timeline']['Trial_ends_on']); ?> </p>
                <?php } else if ($subscription->status == "cancelled") { ?>  
                    <p class="text-muted">
                        <?php echo str_replace('$subscription.cancelled_at', date('d-M-Y', $subscription->cancelledAt),
                                                        $infoconfigData['Timeline']['Canceled_date']); ?> 
                    </p> 
                    <p class="text-muted">
                        <?php echo str_replace('$subscription.trial_start', date('d-M-Y', $subscription->trialStart),
                                                            $infoconfigData['Timeline']['Trial_started_on']); ?> 
                    </p> 
            <?php } else if ($subscription->status == "active") { ?>   
                    <p class="text-muted">
                        <?php echo str_replace('$subscription.current_term_end', date('d-M-Y', $subscription->currentTermEnd),
                                                $infoconfigData['Timeline']['Next_billing_date']); ?> 
                        <?php 
                            if (isset($estimate->lineItems)) {
                                foreach ($estimate->lineItems as $li) {
                                    echo ' Your next plan will be '.$li->description.'.';
                                }
                            }
                        ?>
                    </p>
                    <p class="text-muted">Your current billing term is 
                        <?php echo date('d-M-Y', $subscription->currentTermStart) ?> and 
                        <?php echo date('d-M-Y', $subscription->currentTermEnd) ?>. 
                    </p>
                    <p class="text-muted">
                        <?php echo str_replace('$subscription.activated_at', date('d-M-Y', $subscription->activatedAt),
                                    $infoconfigData['Timeline']['Activation_date']); ?> 
                    </p>
           <?php } else if ($subscription->status == "non_renewing") { ?>
                    <p class="text-muted">
                        <?php echo str_replace('$subscription.cancelled_at', date('d-M-Y', $subscription->currentTermEnd),
                                                $infoconfigData['Non_Renewing_Subscriptions']['Will_be_canceled']); ?> 
                    </p>
                    <p class="text-muted"><?php echo str_replace('$subscription.activated_at', date('d-M-Y', $subscription->activatedAt),
                                    $infoconfigData['Timeline']['Activation_date']); ?> </p>
            <?php }  ?>
            <p class="text-muted">
                <?php echo str_replace('$subscription.created_at', date('d-M-Y', $subscription->createdAt),
                                    $infoconfigData['Timeline']['Signed_up_on']); ?> 
            </p>
            <hr class="clearfix">
            <div class="text-right">
                <?php if($subscription->status == "cancelled") {?>
                    <?php if($settingconfigData["reactivatesubscription"]["allow"] == 'true') {?>
                        <a class="text-danger" data-cb-jshook="link-cancel-subscription" id="reactivateSubscription">Reactivate</a>
                            this subscription
                    <?php } ?>
                <?php } else if ($settingconfigData["cancelsubscription"]["allow"] == 'true') { 
                        if (!($subscription->status == "non_renewing" && 
                                        $settingconfigData["cancelsubscription"]["immediately"] == "false")) { ?>

                            <?php if($skip_st){ ?>
                                <a class="text-danger" href=<?php echo getEditUrl("skip_a_month_view.php", $configData) ?> >Skip a Month</a> | 
                            <?php }?>

                            <a class="text-danger" href=<?php echo getEditUrl("cancelSubscription.php", $configData) ?> 
                                id="cancelSubscription">
                                Cancel
                            </a> this subscription
                      <?php } ?>
                <?php } ?>


            </div>
        </div>
			
            <div id="cb-portal-payment-mode" class="cb-well">
                <div id="cb-portal-payment-mode-title" class="page-header clearfix">
                    <span class="h3">Payment Mode</span>
                </div>
				<?php include("paymentmode.php") ?>
            </div>
			
            <div id="cb-portal-payment-info" class="cb-well">
                <div id="cb-portal-payment-info-title" class="page-header clearfix">
                    <span class="h3">Payment Method Information</span>                    
                        <a id="cb-portal-payment-info-edit-link" href=<?php echo getEditUrl("editCard.php", $configData) ?> >
							<?php if(!isset($customer->paymentMethod)) {?>
                            	<span class='glyphicon glyphicon-plus'></span>Add
							<?php } else {?>
								 <span class='glyphicon glyphicon-pencil'></span>Edit
							<?php } ?>
                        </a>
                </div>
				<?php include("cardInfo.php") ?>
            </div>      

        <div class="clearfix row">
            <div class="col-sm-6">
                <div class="cb-well" id="cb-portal-billing">
                    <div class="page-header clearfix" id="cb-portal-billing-title">
                        <span class="h3">Billing Information</span>                 
        				<?php if ($settingconfigData["billing"]["addedit"] == 'true') { ?>
                            	<a href=<?php echo getEditUrl("editBillingAddress.php", $configData) ?> id="cb-portal-billing-edit-link">
        							<?php if(!isset($customer->billingAddress)) {?>
                                    	<span class='glyphicon glyphicon-plus'></span>Add
        							<?php } else {?>
        								 <span class='glyphicon glyphicon-pencil'></span>Edit
        							<?php } ?>
                            	</a>
        				<?php } ?>
        			</div>
        			<?php include("billingAddressInfo.php") ?>
            	</div>
            </div>

            <div class="col-sm-6">
                <div class="cb-well" id="cb-portal-shipping">
                    <div class="page-header clearfix" id="cb-portal-billing-title">
                    <span class="h3">Shipping Information</span>
                     <?php if ($settingconfigData["shipping"]["addedit"] == 'true') { ?>
                         <a href=<?php echo getEditUrl("editShippingAddress.php", $configData) ?> id="cb-portal-billing-edit-link">
                            <?php if(!isset($subscription->shippingAddress)) {?>
                                <span class='glyphicon glyphicon-plus'></span>Add
                            <?php } else {?>
                                 <span class='glyphicon glyphicon-pencil'></span>Edit
                            <?php } ?>
                        </a>
                      <?php } ?>
                    </div>
                    <?php include("shippingAddressInfo.php") ?>
                </div>
            </div>
        </div>

    <div id="cb-payments-container">
        <div id="cb-portal-portal-invoices" class="cb-well">
            <div id="cb-portal-portal-invoices-title" class="page-header clearfix">
                <span class="h3">Payment History</span>
            </div>

            <?php if (count($customerInvoice) <= 0) { ?>
                <div class="text-center">
                    <div class="alert alert-info">
                        <div class="media text-left">
                            <span class="glyphicon glyphicon-info-sign pull-left"></span>
                            <div class="media-body">
                                <?php echo $infoconfigData['Customer_Invoices']['Invoice_list_is_empty']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <?php include("paymentHistoryInfo.php") ?>
            <?php } ?>
        </div>
    </div>

</div>

</div>
</div>
</div>
<?php include("footer.php"); ?>
<script>
    $(document).ready(function () {
        $(".alert-success").fadeOut(10000);
    });
    $('#reactivateSubscription').click(function () {
        var data = $.param({action: "subscriptionReactivate"});
        AjaxCallMessage('api.php', 'POST', 'json', data, 'index');
		return false;
    });
</script>
