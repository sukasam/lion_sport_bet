<?php

include_once("../function/poker_api.php");
include_once("../function/poker_config.php");

$postfields = array(
    'AccountID'=> PERFECT_ACCOUNTID,
    'PassPhrase'=> PERFECT_PASSPHRASE,
    'Payer_Account' => PERFECT_PAYEE_ACCOUNT,
    'Amount' => 1,
);

$response = curl_post("https://perfectmoney.is/acct/ev_create.asp",$postfields);

//print_r($response);
 

 // searching for hidden fields
 if(!preg_match_all("/<input name='(.*)' type='hidden' value='(.*)'>/", $response, $result, PREG_SET_ORDER)){
    echo 'Ivalid output';
    exit;
 }
 
 $ar="";
 foreach($result as $item){
    $key=$item[1];
    $ar[$key]=$item[2];
 }
 
 echo '<pre>';
 print_r($ar);
 echo '</pre>';

exit();


/*
Array
(
    [Payer_Account] => U18118429
    [PAYMENT_AMOUNT] => 1.01
    [PAYMENT_BATCH_NUM] => 238701251
    [VOUCHER_NUM] => 3803709503
    [VOUCHER_CODE] => 1761456085971430
    [VOUCHER_AMOUNT] => 1
)
Array
(
    [Payer_Account] => U17828646
    [PAYMENT_AMOUNT] => 1.01
    [PAYMENT_BATCH_NUM] => 234847179
    [VOUCHER_NUM] => 8549282104
    [VOUCHER_CODE] => 1051654410901820
    [VOUCHER_AMOUNT] => 1
)

Array
(
    [Payer_Account] => U17828646
    [PAYMENT_AMOUNT] => 1.01
    [PAYMENT_BATCH_NUM] => 234848509
    [VOUCHER_NUM] => 9070384274
    [VOUCHER_CODE] => 2404367390400596
    [VOUCHER_AMOUNT] => 1
)

Array
(
    [Payer_Account] => U17828646
    [PAYMENT_AMOUNT] => 1.01
    [PAYMENT_BATCH_NUM] => 234852469
    [VOUCHER_NUM] => 2290082955
    [VOUCHER_CODE] => 1718118557482146
    [VOUCHER_AMOUNT] => 1
)
Array
(
    [Payer_Account] => U17828646
    [PAYMENT_AMOUNT] => 1.01
    [PAYMENT_BATCH_NUM] => 234852927
    [VOUCHER_NUM] => 2360252344
    [VOUCHER_CODE] => 8211002826154293
    [VOUCHER_AMOUNT] => 1
)
Array
(
    [Payer_Account] => U17828646
    [PAYMENT_AMOUNT] => 1.01
    [PAYMENT_BATCH_NUM] => 234853458
    [VOUCHER_NUM] => 5628433227
    [VOUCHER_CODE] => 5077012777497556
    [VOUCHER_AMOUNT] => 1
)
Array
(
    [Payer_Account] => U17828646
    [PAYMENT_AMOUNT] => 1.01
    [PAYMENT_BATCH_NUM] => 237192334
    [VOUCHER_NUM] => 8870392627
    [VOUCHER_CODE] => 1762350111910731
    [VOUCHER_AMOUNT] => 1
)

Array
(
    [Payer_Account] => U17828646
    [PAYMENT_AMOUNT] => 1.01
    [PAYMENT_BATCH_NUM] => 237192422
    [VOUCHER_NUM] => 4737210290
    [VOUCHER_CODE] => 7510670761897211
    [VOUCHER_AMOUNT] => 1
)

Array
(
    [Payer_Account] => U17828646
    [PAYMENT_AMOUNT] => 1.01
    [PAYMENT_BATCH_NUM] => 237192658
    [VOUCHER_NUM] => 4145068414
    [VOUCHER_CODE] => 4426317519144455
    [VOUCHER_AMOUNT] => 1
)
*/


?>