<?php
include_once('init.php');
$offset = $_POST['offset'];
$lastInvoiceNo = $_POST['lastInvoiceNo'];
$maxInvoiceNo = $_POST['maxInvoiceNo'];
$customerInvoice = $servicePortal->retrieveInvoice($offset);
$nextOffset = $customerInvoice->nextOffset();

include("invoiceTable.php"); 
?>
