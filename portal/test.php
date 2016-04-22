<?php
include_once('header.php');
$customer = $servicePortal->getCustomer();
$subscription = $servicePortal->getSubscription();
$termEndDate = date('d-M-Y', $subscription->currentTermEnd);
$subscription_term_end = $subscription->currentTermEnd;
$one_month_after_end = strtotime( "+1 month", $subscription_term_end) ;

?>

<div class="container">

<?php
ChargeBee_Environment::configure("tokyotreat-test","test_GaRJqYcqiISoo439GgkSbPUgFHIjS6GD");
$all = ChargeBee_Subscription::subscriptionsForCustomer($customer->id, array(
  "limit" => 5));
foreach($all as $entry){
  $subscription = $entry->subscription();
  var_dump($subscription);
}

?>

</div>
<?php include("footer.php"); ?>
<script>
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
