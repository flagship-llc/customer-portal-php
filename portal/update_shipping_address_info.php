<?php
    include_once('init.php');
    $customer = $servicePortal->getCustomer();
    $billingAddress = $customer->billingAddress;
    $subscription = $servicePortal->getSubscription();
    $customerInvoice = $servicePortal->retrieveInvoice();

    $subscription_id = $subscription->id;
    // var_dump($_POST);

    ChargeBee_Environment::configure("tokyotreat-test","test_GaRJqYcqiISoo439GgkSbPUgFHIjS6GD");
    $result = ChargeBee_Address::update(array(
        "subscriptionId" => $subscription_id, 
        "label" => "shipping_address", 
        "firstName" => $_POST['shipping_address']['first_name'], 
        "lastName" => $_POST['shipping_address']['last_name'], 
        "addr" => $_POST['shipping_address']['line1'], 
        "extendedAddr" => $_POST['shipping_address']['line2'], 
        "city" => $_POST['shipping_address']['city'], 
        "state" => $_POST['shipping_address']['state'], 
        "zip" => $_POST['shipping_address']['zip'], 
        "email" => $_POST['shipping_address']['email'], 
        "phone" => $_POST['shipping_address']['phone'], 
        "company" => $_POST['shipping_address']['company'], 
        "country" => $_POST['shipping_address']['country']
    ));
    $customer = $result->customer();
    $card = $result->card();
?>

<script>
    function jump(){
        location.href = "index.php";
    }
    jump();

</script>