<?php
    include("header.php");
    $customer = $servicePortal->getCustomer();
    $customer_id = $customer->id;
    $billingAddress = $customer->billingAddress;
    $customerInvoice = $servicePortal->retrieveInvoice();
    $subscription = $servicePortal->getSubscription();

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
?>

    <div class="container text-center"><b>Update Billing Info now...</b></div>

    <?php include("footer.php"); ?>
    <script>
        function jump(){
            location.href = "index.php";
        }
        jump();

    </script>