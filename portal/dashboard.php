<?php
include_once('header.php');
$customer = $servicePortal->getCustomer();
?>

<h1 class="text-center Candal">Conversions</h1>

<?php 
  $id = 'af0c5baf-eda4-4262-8553-3f008db772f2';
  $pass = 'd402684f-9d63-4eb1-a6b4-620e1b94c8f2';
  $url = 'https://' . $id . ':' . $pass . '@api.friendbuy.com/v1/customers?account_id='.$customer->id;
  $json = file_get_contents($url);
  $json_obj = json_decode($json,true);
  $result = ChargeBee_Customer::addPromotionalCredits($customer->id, array(
    "amount" => 500, 
    "description" => "Loyalty credits"));
?>  

<div class="container">
  <?php foreach ($json_obj['results'] as $result) { ?>
    <div class="row clearfix">
      <div class="col-sm-3"><b>Email Address:</b><br><?php echo $result['rewards']['id'];?></div>
      <div class="col-sm-3"><b>Invited On:</b><br><?php echo $result['rewards']['amount'];?></div>
      <div class="col-sm-3"><b>Status:</b><br><?php echo $result['purchase'];?></div>
      <div class="col-sm-3"><b>Action:</b><br>Send reminder</div>
    </div>
  <?php } ?>
</div>

<?php include("footer.php"); ?>
