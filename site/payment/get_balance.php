<?php


include_once("../function/poker_api.php");
include_once("../function/poker_config.php");

$postfields = array(
    'AccountID'=> PERFECT_ACCOUNTID,
    'PassPhrase'=> PERFECT_PASSPHRASE,

);

$response = curl_post_outsite("https://perfectmoney.is/acct/balance.asp",$postfields);

//print_r($response);
 

// searching for hidden fields
if(!preg_match_all("/<input name='(.*)' type='hidden' value='(.*)'>/", $response, $result, PREG_SET_ORDER)){
   echo 'Ivalid output';
   exit;
}

// putting data to array
$ar="";
foreach($result as $item){
   $key=$item[1];
   $ar[$key]=$item[2];
}

echo '<pre>';
print_r($ar);
echo '</pre>';

?>