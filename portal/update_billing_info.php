<?php
    include_once('init.php');
    $customer = $servicePortal->getCustomer();
    $billingAddress = $customer->billingAddress;
    $subscription = $servicePortal->getSubscription();
    $customerInvoice = $servicePortal->retrieveInvoice();

    $customer_id = $customer->id;

    ChargeBee_Environment::configure("tokyotreat-test","test_GaRJqYcqiISoo439GgkSbPUgFHIjS6GD");
    $result = ChargeBee_Customer::updateBillingInfo($customer_id, array(
      "billingAddress" => array(
        "firstName" => $_POST['billing_address']['first_name'], 
        "lastName" => $_POST['billing_address']['last_name'], 
        "line1" => $_POST['billing_address']['line1'], 
        "line2" => $_POST['billing_address']['line2'], 
        "city" => $_POST['billing_address']['city'], 
        "state" => $_POST['billing_address']['state'], 
        "zip" => $_POST['billing_address']['zip'], 
        "email" => $_POST['billing_address']['email'], 
        "phone" => $_POST['billing_address']['phone'], 
        "company" => $_POST['billing_address']['company'], 
        "country" => $_POST['billing_address']['country']
      )));
    $customer = $result->customer();
    $card = $result->card();
?>

<script>
    function jump(){
        location.href = "index.php";
    }
    jump();

</script>