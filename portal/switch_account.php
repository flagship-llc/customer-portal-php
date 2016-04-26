<?php
include_once('header.php');
$accounts = $portalSession->linkedCustomers;
?>
<div class="container">


<div id="cb-user-content"><div class="cb-well">
<h3 class="text-center">Your Accounts</h3>
<p class="text-center"><a href="mailto:<?php echo $customer->email;?>"><?php echo $customer->email;?></a></p>

    <p>All the accounts linked to your email address are shown below. Click on &#39;Manage&#39; to view and edit an account.</p>

<div class="cb-subscription-manage">
    
    <?php 
        $count = 0;
        foreach ($accounts as $account) {
            $id = $account->customerId;
            $result = ChargeBee_Customer::retrieve($id);
            $customer = $result->customer();
            $all = ChargeBee_Subscription::subscriptionsForCustomer($id, array(
              "limit" => 1));
            foreach($all as $entry){
              $subscription = $entry->subscription();
            }
            $count++;
    ?>

        <dl class="row">
            <dt class="col-xs-8">
                Account #<?php echo $count; ?>
                <br />
                <span class="text-muted">Signed up on <?php echo date('d-M-Y',$customer->createdAt); ?></span>
            </dt>
            <dd class="col-xs-4 text-right">
                <a href="index.php?s_id=<?php echo $subscription->id; ?>" id="change-manage">Manage<span class="glyphicon glyphicon-chevron-right"></span></a>
            </dd>
        </dl>

    <?php } ?>
    
</div>


</div>

</div>

</div>

<?php include("footer.php"); ?>
