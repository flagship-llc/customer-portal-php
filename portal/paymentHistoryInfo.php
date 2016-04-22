<?php
$page = 1;
$nextOffset = $customerInvoice->nextOffset();
$lastInvoiceNo = 0;
ChargeBee_Environment::configure("tokyotreat-test","test_GaRJqYcqiISoo439GgkSbPUgFHIjS6GD");
$all = ChargeBee_Invoice::invoicesForSubscription($subscription->id, array(
  "limit" => 100));
$max_invoice_count = 0;
foreach($all as $entry){
  $invoice = $entry->invoice();
  $max_invoice_count = $max_invoice_count + 1;
}

?>
<div id="invoiceTableShow">
    <?php include("invoiceTable.php"); ?>
</div>
