<?php
    include("header.php");
    $customer = $servicePortal->getCustomer();
    $billingAddress = $customer->billingAddress;
    $subscription = $servicePortal->getSubscription();
    $customerInvoice = $servicePortal->retrieveInvoice();

    $subscription_id = $subscription->id;

    ChargeBee_Environment::configure("tokyotreat-test","test_GaRJqYcqiISoo439GgkSbPUgFHIjS6GD");
    $result = ChargeBee_Subscription::cancel($subscription_id);
    $subscription = $result->subscription();
    $customer = $result->customer();
    $card = $result->card();
    $invoice = $result->invoice();


    $comment_note = $_POST['feedback'];
    if($comment_note){
        ChargeBee_Environment::configure("tokyotreat-test","test_GaRJqYcqiISoo439GgkSbPUgFHIjS6GD");
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