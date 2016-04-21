<?php
include_once('header.php');
$subscription = $servicePortal->getSubscription();
$termEndDate = date('d-M-Y', $subscription->currentTermEnd);
$subscription_term_end = $subscription->currentTermEnd;
$one_month_after_end = strtotime( "+1 month", $subscription_term_end) ;
?>

<div class="container">
<?php if(!$_COOKIE["skip_status"]): ?>
    <div id="skip_a_month" class="cb-user-content">
        <div class="text-center skip-desc">
            <h1 class="text-orange"><strong>You could just Skip a Month!</strong></h1>
            <p>Now you can Skip a Month, refreshed and ready for your next Treat!<br class="hidden-xs"> You would <span class="text-orange">Skip <?php echo date('M Y', $subscription_term_end); ?></span> and get your next crate in <?php echo date('M Y', $one_month_after_end); ?>.</p>
            <form action="skip_a_month.php" method="post">
                <input type="hidden" name="skip_true" value="true">
                <input type="submit" value="Skip a Month" class="button">
            </form>
            <div class="go_cancel"><a href="cancel-disp">Cancel Subscription</a></div>
            <div class="go_top"><a href="<?php echo getEditUrl("index.php", $configData) ?>">Go Back</a></div>
        </div>
    </div>
<?php endif;?>
    <div <?php if(!$_COOKIE["skip_status"]){echo 'id="cancel-disp"';} ?>>
        <div id="cb-wrapper-ssp">
    		<?php include("processing.php") ?>
            <div id="cb-user-content">
                <form id="portal_subscription_cancel_submit" action="cancel_logic.php" method="POST">
                    <input id="cancelLaterText" name="cancelLaterText" type="hidden" class="form-control" value="<?php echo str_replace('$subscription.current_term_end', $termEndDate, $infoconfigData['Warnings_during_Cancellation']['Cancel_on_end_of_term_active']) ?>" > 
                    <input id="cancelImmediateText" name="cancelImmediateText" type="hidden" class="form-control" value="<?php echo $infoconfigData['Warnings_during_Cancellation']['Cancel_immediately'] ?>" > 
                    <div class="cb-well">
                        <h3 class="text-center">Cancel Subscription</h3>
                        <p>If you cancel now, you will lose a chance to receive the monthly <a href="https://tokyotreat.com/about/how-it-works/#lucky-treat">Lucky Treat</a> with value over $500 USD! Are you sure..? (TωT)</p>
                        <p>Please let us know why you would like to cancel</p>
                        <textarea name="feedback" class="form-control" style="margin-bottom:20px;"></textarea>
                        <?php 
                        $cancelImmediateMessage = $infoconfigData['Warnings_during_Cancellation']['Cancel_immediately'];

                        if($subscription->status == 'in_trial'){
                            $cancelEndOfTermMessage = str_replace('$subscription.trial_end', $subscription->trialEnd, $infoconfigData['Warnings_during_Cancellation']['Cancel_on_end_of_term_trial']);
                        }
                        $cancelEndOfTermMessage = str_replace('$subscription.current_term_end', $termEndDate, $infoconfigData['Warnings_during_Cancellation']['Cancel_on_end_of_term_active']);
                        if (($settingconfigData["cancelsubscription"]["immediately"] == 'true' && $subscription->status == "non_renewing")
                                || ($settingconfigData["cancelsubscription"]["immediately"] == 'true' && $subscription->status == 'future')) {
                           ?>
                            
                                <input type="hidden" id="endOfTerm" value="true" name="endOfTerm" >
                                <div id="cancel-immediately-info" class="alert alert-warning" >
                                    <div class="media text-left">
                                        <span class="glyphicon glyphicon-exclamation-sign pull-left"></span>
                                        <div class="media-body">
                                            Your subscription will be canceled immediately.
                                        </div>
                                    </div>
                                </div> 
                            <?php 
                        } elseif ($settingconfigData["cancelsubscription"]["immediately"] == 'true' && $settingconfigData["cancelsubscription"]["endcurrentterm"] == 'true') { ?>
                            <!-- <div class="radio-group">                            
                                <div class="radio">
                                    <label>                                 
                                        <input type="radio" name="endOfTerm" id="cancelNow" value="false" checked=""> Cancel Immediately
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" id="cancelLater" value="true" name="endOfTerm" id="cancelLater"> Cancel on next renewal                                
                                    </label>
                                </div>
                                <span id="sub_cancel.err" class="text-danger">&nbsp;</span>
                            </div>  -->
                            
                                <div id="cancel-immediately-info" class="alert alert-warning">
                                    <div class="media text-left">
                                        <span class="glyphicon glyphicon-exclamation-sign pull-left"></span>
                                        <div class="media-body">
                                            <span id="cancelText"><?php echo $cancelImmediateMessage ?></span>
                                        </div>
                                    </div>
                                </div>     
                                <div class="text-center">
                                    <div id="cancel-next-renewal-info" class="alert alert-warning" style='display:none;'>
                                        <div class="media text-left">
                                            <span class="glyphicon glyphicon-exclamation-sign pull-left"></span>
                                            <div class="media-body">
                                                <?php echo $cancelEndOfTermMessage ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php 
                        } 
                        elseif ($settingconfigData["cancelsubscription"]["endcurrentterm"] == 'true') { 
                             ?>
                            
                                <input type="hidden" id="endOfTerm" value="true" name="endOfTerm" >
                                <div class="text-center">
                                    <div id="cancel-next-renewal-info" class="alert alert-warning" >
                                        <div class="media text-left">
                                            <span class="glyphicon glyphicon-exclamation-sign pull-left"></span>
                                            <div class="media-body">
                                                Your subscription will be canceled immediately.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php  
                        } elseif ($settingconfigData["cancelsubscription"]["immediately"] == 'true') {?>
                            
                                <input type="hidden" id="endOfTerm" value="false" name="endOfTerm" >
                                <div id="cancel-immediately-info" class="alert alert-warning" >
                                    <div class="media text-left">
                                        <span class="glyphicon glyphicon-exclamation-sign pull-left"></span>
                                        <div class="media-body">
                                            <?php echo $cancelImmediateMessage ?>
                                        </div>
                                    </div>
                                </div> 
                            <?php 
                        }             
                        ?>           
                        <br> 
                        <div class="form-inline">
                            <div class="form-group cancel-button">
                                <input type="hidden" value="true" name="cancel_true" >
                                <input type="submit" value="Cancel Subscription" class="btn btn-danger">
                            </div>
                            <div class="form-group">
                                <a class="btn btn-link" id="back" href=<?php echo getCancelURL($configData) ?>>Keep My Subscription!</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php"); ?>
<script>
    $('.go_cancel a').click(function () {
        var disp_ele = $(this).attr('href');
        $('#'+disp_ele+'').show();
        return false;
    });
    $('#cancelNow').click(function () {
        var cancelImmediateText = $("#cancelImmediateText").val();
        $('#cancelText').text(cancelImmediateText);
    });
    $('#cancelLater').click(function () {
        var cancelLaterText = $("#cancelLaterText").val();
        $('#cancelText').text(cancelLaterText);
    });

    $('#updateSubscription').click(function () {
        var subscriptionId = $("#subscriptionId").val();
        var endOfTerm = $('input[name=endOfTerm]:checked', '#cancelForm').val();
        if(endOfTerm == ''){
            var endOfTerm = $("#endOfTerm").val();
   	 	}    
        var params = {action: "subscriptionCancel", endOfTerm: endOfTerm, subscriptionId: subscriptionId};
        AjaxCallMessage('api.php', 'POST', 'json', $.param(params), 'cancelsubscription');
    });
</script>
