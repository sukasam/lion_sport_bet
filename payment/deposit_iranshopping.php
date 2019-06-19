<?php

include_once("../function/poker_api.php");
include_once("../function/poker_config.php");


$postfields = array(
    'amount'=> '1000',
    'pin'=> '67CE4EB2650720147C45',
    'callback'=> DOMAIN_SITE."/payment/callback.php",
    'bank' => "Parsian", 
    'description' => "Deposit of Player adminT-T", 
);

echo "<pre>";
print_r($postfields);
echo "</pre>";

echo "Call API to http://panel.iranshoping.info/api/create/<br>";

$response = curl_post_outsite("http://panel.iranshoping.info/api/create/",$postfields);

echo "Error :".$response;


// $response = curl_get_outsite("http://panel.iranshoping.info/startpay/5C0D06A5D5A6D");

// echo "<pre>";
// print_r($response);
// echo "</pre>";


/*$postfields = array(
    'amount'=> "100",
    'transid'=> "5C0D14CD20C97",
    'pin'=> "28AADA2519E5AC63322E",
);

$response = curl_post_outsite("http://panel.iranshoping.info/api/verify/",$postfields);

echo "<pre>";
print_r($response);
echo "</pre>";*/


?>