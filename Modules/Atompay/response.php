<?php

require_once 'TransactionResponse.php';
$transactionResponse = new TransactionResponse();
$transactionResponse->setRespHashKey("KEYRESP123657234");

if($transactionResponse->validateResponse($_POST)){
    echo "Transaction Processed <br/>";
    print_r($_POST);
} else {
    echo "Invalid Signature";
}


//print_r($_POST);
