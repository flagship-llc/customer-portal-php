<?php
    include("header.php");
    $subscription = $servicePortal->getSubscription();
    $subscription_id = $subscription->id;
    $billingAddress = $customer->billingAddress;

    $result = ChargeBee_Subscription::cancel($subscription_id);

    $comment_note = $_POST['feedback'];
    if($comment_note){
        $result = ChargeBee_Comment::create(array(
          "entityType" => "subscription", 
          "entityId" => $subscription_id, 
          "addedBy" => $billingAddress->email,
          "type" => 'user',
          "notes" => $comment_note));
        $comment = $result->comment();
    }

?>
    <div class="container text-center"><b>Cancel Subscription now...</b></div>

    <?php include("footer.php"); ?>

    <script>
        function jump(){
            location.href = "index.php";
        }
        jump();

    </script>