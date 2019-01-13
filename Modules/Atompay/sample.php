<?php
date_default_timezone_set('Asia/Calcutta');
$datenow = date("d/m/Y h:m:s");
$transactionDate = str_replace(" ", "%20", $datenow);

$transactionId = rand(1,1000000);

require_once 'TransactionRequest.php';

$transactionRequest = new TransactionRequest();

//Setting all values here
$transactionRequest->setMode("test");
$transactionRequest->setLogin(197);
$transactionRequest->setPassword("Test@123");
$transactionRequest->setProductId("NSE");
$transactionRequest->setAmount(50);
$transactionRequest->setTransactionCurrency("INR");
$transactionRequest->setTransactionAmount(50);
$transactionRequest->setReturnUrl("http://localhost/~work/Atompay/response.php");
$transactionRequest->setClientCode(123);
$transactionRequest->setTransactionId($transactionId);
$transactionRequest->setTransactionDate($transactionDate);
$transactionRequest->setCustomerName("Test Name");
$transactionRequest->setCustomerEmailId("test@test.com");
$transactionRequest->setCustomerMobile("9999999999");
$transactionRequest->setCustomerBillingAddress("Mumbai");
$transactionRequest->setCustomerAccount("639827");
$transactionRequest->setReqHashKey("KEY123657234");


$url = $transactionRequest->getPGUrl();

header("Location: $url");