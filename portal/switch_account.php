<?php
include_once('header.php');
$accounts = $portalSession->linkedCustomers;
?>
<div class="container">


<div id="cb-user-content"><div class="cb-well" id="switch">
<h3 class="text-center">Your Accounts</h3>
<p class="text-center"><a href="mailto:<?php echo $customer->email;?>"><?php echo $customer->email;?></a></p>

    <p>All the accounts linked to your email address are shown below. Click on &#39;Manage&#39; to view and edit an account.</p>

<div class="cb-subscription-manage row">
    
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
              $cur_plan = ChargeBee_Plan::retrieve($subscription->planId);
              $cur_plan_name = $cur_plan->plan()->name;
              $theme_plan = 'default';
              if($cur_plan_name == 'YumeTwins Monthly Plan' || $cur_plan_name == 'YumeTwins 3 Month Prepay Plan' || $cur_plan_name == 'YumeTwins 6 Month Prepay Plan' || $cur_plan_name == 'YumeTwins 12 Month Prepay Plan'){
                $yume_plan = true;
                $theme_plan = 'yume';
              } elseif ( $cur_plan_name == 'nomakenolife Monthly Plan' || $cur_plan_name == 'nomakenolife 3 Month Prepay Plan' || $cur_plan_name == 'nomakenolife 6 Month Prepay Plan' || $cur_plan_name == 'nomakenolife 12 Month Prepay Plan') {
                $yume_plan = false;
                $theme_plan = 'nomake';
              }else{
                $yume_plan = false;
              }
            }
            $count++;
    ?>
        <dl class="<?php echo $subscription->planId; ?>">
            <dt class="col-xs-8">
                <?php //if($yume_plan){?>
                <?php if ( $theme_plan == 'yume' ) { ?>
                YumeTwins - <?php echo $cur_plan_name;?>
                <?php } elseif ( $theme_plan == 'nomake' ) { ?>
                NoMakeNoLife - <?php echo $cur_plan_name;?>
                <?php }else{?>
                TokyoTreat - <?php echo $cur_plan_name;?>
                <?php } ?>
                <br />
                <span class="text-muted">Signed up on <?php echo date('d-M-Y',$customer->createdAt); ?></span>
            </dt>
            <dd class="col-xs-4 text-right">
                <a href="index.php?s_id=<?php echo $subscription->id; ?>" id="change-manage" class="arrow">Manage<span class="glyphicon glyphicon-chevron-right"></span></a>
            </dd>
        </dl>

    <?php } ?>
    
</div>


</div>

</div>

</div>

<?php include("footer.php"); ?>
