<?php
include("header.php");
$subscription = $servicePortal->getSubscription();
$subscription_term_end = $subscription->currentTermEnd;
$customer = $servicePortal->getCustomer();
$billingAddress = $customer->billingAddress;
$customerInvoice = $servicePortal->retrieveInvoice();
$currentPlanDetails = $servicePortal->retrievePlan($subscription->planId);
if($subscription->hasScheduledChanges){
    $result = ChargeBee_Subscription::retrieveWithScheduledChanges($subscription->id);
    $next_subscription = $result->subscription();
    $next_plan = ChargeBee_Plan::retrieve($next_subscription->planId)->plan();
}
$cur_plans = ChargeBee_Plan::retrieve($subscription->planId);
include("skip_true.php");
?>

<div class="modal fade" id="Timeline" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="title glay Candal" id="modal-label"><span>Timeline</span></h2>
            </div>
            <div class="modal-body">

            <p class="text-muted">
                <?php 
                $phrase = $infoconfigData['Timeline']['Recurring_charge'];
                $default = array('$planperiod', '$planunit');
                $assign   = array($currentPlanDetails->period, $currentPlanDetails->periodUnit);
                echo str_replace($default,  $assign, $phrase); ?> </p>
                <?php if(isset($subscription->currentTermStart)){ ?>
                    <?php if ($subscription->status != "cancelled") { ?>   
                        <p class="text-muted">
                            <?php 
                                $phrase = $infoconfigData['Timeline']['Current_term2'];
                                $default = array('$subscription.current_term_start', '$subscription.current_term_end');
                                $assign   = array(date('d-M-Y', $subscription->currentTermStart), date('d-M-Y', $subscription->currentTermEnd));
                                echo str_replace($default,  $assign, $phrase);
                             ?> 
                        </p> 
                    <?php } ?>
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
                        <?php echo str_replace('$subscription.activated_at', date('d-M-Y', $subscription->activatedAt),
                                                            $infoconfigData['Timeline']['Activation_date']); ?> 
                    </p> 
            <?php } else if ($subscription->status == "active") { ?>   
                    <p class="text-muted">
                        <?php 
                            if($next_plan){
                                echo str_replace('$subscription.current_term_end', date('d-M-Y', $subscription->currentTermEnd),$infoconfigData['Timeline']['Next_billing_date']);
                                echo "(".$next_plan->name.").";
                            }else{                                
                                echo str_replace('$subscription.current_term_end', date('d-M-Y', $subscription->currentTermEnd),$infoconfigData['Timeline']['Next_billing_date']);
                                echo "(".$cur_plans->plan()->name.").";
                            }
                        ?>

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
                        <?php echo str_replace('$subscription.created_at', date('d-M-y', $subscription->createdAt),
                                            $infoconfigData['Timeline']['Signed_up_on']); ?> 
                    </p>
            </div>
        </div>
    </div>
</div>

    <h2 id="customer-title" class="text-center Candal text-darkblue">
        <span class="small-text">カスタマーポータル</span><br>
        CUSTOMER PORTAL
    </h2>
    <?php 
      $estimate = $servicePortal->retrieveEstimate(); 
    ?>
    <div class="container renew">

        <div id="cb-wrapper-ssp">
             <?php include("processing.php");  ?>
            <div id="cb-content">

                <div class="cb-well" id="subscripion-info">
                  <h2 class="title back-orange Candal"><span>My Subscription</span></h2>
                  <div class="clearfix wraps">
                    <div class="col-sm-6 box-info">
                      <div class="image-wrap text-center">
                        <?php if($subscription->planId == 'premium-12-month-prepay-plan'){?>
                            <img src="assets/images/premium-12.png" alt="">
                        <?php }else if($subscription->planId == 'premium-6-month-prepay-plan'){ ?>
                            <img src="assets/images/premium-6.png" alt="">
                        <?php }else if($subscription->planId == 'premium-3-month-prepay-plan'){ ?>
                            <img src="assets/images/premium-3.png" alt="">
                        <?php }else if($subscription->planId == 'premium-monthly-plan'){ ?>
                            <img src="assets/images/premium-1.png" alt="">
                        <?php }else if($subscription->planId == 'regular-12-month-prepay-plan'){ ?>
                            <img src="assets/images/regular-12.png" alt="">
                        <?php }else if($subscription->planId == 'regular-6-month-prepay-plan'){ ?>
                            <img src="assets/images/regular-6.png" alt="">
                        <?php }else if($subscription->planId == 'regular-3-month-prepay-plan'){ ?>
                            <img src="assets/images/regular-3.png" alt="">
                        <?php }else if($subscription->planId == 'regular-monthly-plan'){ ?>
                            <img src="assets/images/regular-1.png" alt="">
                        <?php }else if($subscription->planId == 'small-12-month-prepay-plan'){ ?>
                            <img src="assets/images/small-12.png" alt="">
                        <?php }else if($subscription->planId == 'small-6-month-prepay-plan'){ ?>
                            <img src="assets/images/small-6.png" alt="">
                        <?php }else if($subscription->planId == 'small-3-month-prepay-plan'){ ?>
                            <img src="assets/images/small-3.png" alt="">
                        <?php }else if($subscription->planId == 'small-monthly-plan'){ ?>
                            <img src="assets/images/small-1.png" alt="">
                        <?php } ?>
                      </div>
                    <div class="info clearfix row">
                    <?php if ($subscription->status != "cancelled") {?>
                      <div class="col-sm-8">
                    <?php } else {?>
                      <div class="col-sm-12">
                    <?php }?>
                        <?php 
                            $phrase = $infoconfigData['Timeline']['Recurring_charge'];
                            $default = array('$planperiod', '$planunit');
                            $assign   = array($currentPlanDetails->period, $currentPlanDetails->periodUnit);
                            echo str_replace($default,  $assign, $phrase); ?>
                        <?php if ($subscription->status != "cancelled") {?>
                        <br>
                        <div class="price">
                          <b class="visible-xs"><span><?php echo $configData['currency_value'] .' '.number_format($estimate->amount / 100, 2, '.', '') ?></span></b>
                        </div>
                        <p class="text-orange"><b><span>
                          <?php
                          
                            if($next_plan){
                                echo str_replace('$subscription.current_term_end', date('d-M-Y', $subscription->currentTermEnd),$infoconfigData['Active_Subscriptions']['Subscription_renewal_info']);
                                echo "(".$next_plan->name.").";
                            }else{
                                echo str_replace('$subscription.current_term_end', date('d-M-Y', $subscription->currentTermEnd),$infoconfigData['Active_Subscriptions']['Subscription_renewal_info2']);
                                echo "(".$cur_plans->plan()->name.").";
                            }
                          ?>
                          </span></b></p>
                          
                        <?php }else{?>
                          <p class="text-danger">Your subscription has been canceled.<br> Please Reactivate your subscription! </p>
                        <?php } ?>
                        </div>
                      <?php if ($subscription->status != "cancelled") {?>
                        <div class="col-sm-4 price hidden-xs">
                          <b><span>
                          <?php echo $configData['currency_value'] .' '.number_format($estimate->amount / 100, 2, '.', '') ?></span></b>
                        </div>
                      <?php } ?>
                      </div>



                      <div class="clearfix">
                        <?php
                            if ($settingconfigData["changesubscription"]["allow"] == 'true'){
                                $showEditDisplay = $servicePortal->getEditSubscription($settingconfigData); 
                                if($showEditDisplay==true) {   ?>
                                    <a href=<?php echo getEditUrl("editSubscription.php", $configData) ?> class="arrow glay pull-left">
                                        Change Plan<span class="glyphicon glyphicon-chevron-right" title="Download"></span>
                                    </a>
                                <?php
                                    $showEditDisplay = false;
                                }             
                            }               
                        ?>
                        <a id="timeline-disp" class="arrow pull-right" data-toggle="modal" data-target="#Timeline">Timeline<span class="glyphicon glyphicon-chevron-right" title="Download"></span></a>
                      </div>
                    </div>
                    <div class="col-sm-6 my-info">
                      <h3>TOKYOTREAT will ship to</h3>
                      <?php include("shippingAddressInfo.php") ?>
                      <?php if ($settingconfigData["shipping"]["addedit"] == 'true') { ?>
                         <a href=<?php echo getEditUrl("editShippingAddress.php", $configData) ?> id="cb-portal-billing-edit-link" class="arrow glay">
                            <?php if(!isset($subscription->shippingAddress)) {?>
                                Add Shipping Address<span class="glyphicon glyphicon-chevron-right" title="Download"></span>
                            <?php } else {?>
                                 Change Shipping Address<span class="glyphicon glyphicon-chevron-right" title="Download"></span>
                            <?php } ?>
                        </a>
                      <?php } ?>
                      <div class="text-center">
                        <div class="subsc-menu">                    
                            <?php if($subscription->status == "cancelled") {?>
                                <?php if($settingconfigData["reactivatesubscription"]["allow"] == 'true') {?>
                                    <a data-cb-jshook="link-cancel-subscription" id="reactivateSubscription">Reactivate</a> this subscription
                                <?php } ?>
                                    <?php } else if ($settingconfigData["cancelsubscription"]["allow"] == 'true') { 
                                    if (!($subscription->status == "non_renewing" && 
                                    $settingconfigData["cancelsubscription"]["immediately"] == "false")) { ?>
                                    <?php if($skip_st){ ?>
                                        <a href=<?php echo getEditUrl("skip_a_month_view.php", $configData) ?> >Skip a Month</a> | 
                                    <?php } else { ?>
                                        <span class="text-muted">Can't Skip a Month</span> | 
                                    <?php }?>
                                        <a href=<?php echo getEditUrl("cancelSubscription.php", $configData) ?> id="cancelSubscription">
                                    Cancel
                                    </a> this subscription
                                <?php } ?>
                            <?php } ?>               
                        </div>
                      </div>  
                    </div>
                  </div>   
                </div>

                <div class="clearfix row">
                <?php if ($settingconfigData["billing"]["addedit"] == 'true'){ ?>
                    <div class="col-sm-6">
                        <div class="cb-well glay-border" id="cb-portal-billing">
                            <h2 class="title back-glay Candal"><span>Billing Info</span></h2>
                            <?php include("billingAddressInfo.php") ?>
                            <div class="link-area">
                                <?php if ($settingconfigData["billing"]["addedit"] == 'true') { ?>
                                        <a href=<?php echo getEditUrl("editBillingAddress.php", $configData) ?> id="cb-portal-billing-edit-link" class="arrow glay">
                                            <?php if(!isset($customer->billingAddress)) {?>
                                                <span class='glyphicon glyphicon-plus'></span>Add
                                            <?php } else {?>
                                                 Change Billing Info<span class="glyphicon glyphicon-chevron-right" title="Download"></span>
                                            <?php } ?>
                                        </a>
                                <?php } ?>                            
                            </div>
                        </div>
                    </div>
                <?php }?>
                    <div class="col-sm-6">
                        <div class="cb-well glay-border" id="cb-portal-payment-method">
                            <h2 class="title back-glay Candal"><span>Payment Method</span></h2>
                            <div class="info-box">
                            <?php include("cardInfo.php") ?>
                    
                        <a id="cb-portal-payment-info-edit-link" href=<?php echo getEditUrl("editCard.php", $configData) ?> class="arrow glay">
                        <?php if(!isset($customer->paymentMethod)) {?>
                            Add Payment Method<span class='glyphicon glyphicon-plus'></span>
                        <?php } else {?>
                             Change Payment Method<span class="glyphicon glyphicon-chevron-right" title="edit card info">
                        <?php } ?>
                        </a>
                        <div class="text-muted payment-attention">Your card will be automatically charged when a new invoice is generated.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="payment-history">
                    <h2 class="Candal text-orange"><span>Payment History</span></h2>
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


<?php include("footer.php"); ?>
<script>
    var hidden_alert = function () {
        $(".alert-success").fadeOut(2000);
    }
    setTimeout(hidden_alert, 10000);
    $('#reactivateSubscription').click(function () {
        var data = $.param({action: "subscriptionReactivate"});
        AjaxCallMessage('api.php', 'POST', 'json', data, 'index');
		return false;
    });
</script>