<?php
$page = 1;
$nextOffset = $customerInvoice->nextOffset();
$lastInvoiceNo = 0;
$all = ChargeBee_Invoice::invoicesForSubscription($subscription->id, array(
"limit" => 100));
$maxInvoiceNo = count($all);
?>
<div id="invoiceTableShow">
    <?php include("invoiceTable.php"); ?>
</div>
