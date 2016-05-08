<?php
include_once('header.php');
$subscription = $servicePortal->getSubscription();
$termEndDate = date('d-M-Y', $subscription->currentTermEnd);
include("skip_true.php");
$one_month_after_end = strtotime( "+1 month", $current_end);


?>

<div class="container">

    <div id="skip_a_month" class="cb-user-content">
        <div class="text-center skip-desc">
            <h1 class="text-orange"><strong>Skip a Month!</strong></h1>
            <p>You can Skip a Month, and postpone the fun!<br class="hidden-xs"> The <?php echo date('M Y', $current_end); ?> treat will get skipped, and your next treat will be <?php echo date('M Y', $one_month_after_end); ?>.</p>
            <form action="skip_a_month.php" method="post">
                <input type="hidden" name="skip_true" value="true">
                <input type="submit" value="Skip a Month" class="button">
            </form>
            <div class="go_cancel"><a href="<?php echo getEditUrl("index.php", $configData) ?>">Go Back</a></div>
        </div>
    </div>

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
