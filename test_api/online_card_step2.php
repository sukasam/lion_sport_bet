<?php

# An HTTP POST request example

# a pass-thru script to call my Play server-side code.
# currently needed in my dev environment because Apache and Play run on
# different ports. (i need to do something like a reverse-proxy from
# Apache to Play.)

# the POST data we receive from Sencha (which is not JSON)

$userAPI ="666548952671307678";
$passAPI = "434378882190463167";
$transection = "641112783973605285";
$card_amount = "1000";
$orderInvoice = "190107073943";

$request = $userAPI."&".$passAPI."&".$transection."&".$orderInvoice."&".$card_amount;

# data needs to be POSTed to the Play url as JSON.
# (some code from http://www.lornajane.net/posts/2011/posting-json-data-with-php-curl)
$data = array("request" => $request);
$data_string = json_encode($data);

print_r($data_string);
// exit();

$ch = curl_init('http://144.76.15.40:12001/api/TransferMoney/CheckResult');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string))
);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

//execute post
$result = curl_exec($ch);

//close connection
curl_close($ch);

echo "<br> URL Call API : http://144.76.15.40:12001/api/TransferMoney/CheckResult";
echo "<br>Return from API : ".$result;

$returnList = explode("&",$result);
                    
echo "<pre>"; 
print_r($returnList);
echo "</pre>";
exit();

// Array
// (
//     [0] => "190115004247
//     [1] => 424193529201676541
//     [2] => 0
//     [3] => 1000
//     [4] => کارت موجود نیست و یا پشتیبانی نمی شود"
// )
// ------------------------------------------------------------------------------


?>