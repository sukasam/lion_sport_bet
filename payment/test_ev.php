<?php

/*

This script demonstrates querying account balance
using PerfectMoney API interface.

*/

// trying to open URL to process PerfectMoney Spend request
$f=fopen('https://perfectmoney.is/acct/ev_activate.asp?AccountID=1762128&PassPhrase=Mkung160230&Payee_Account=U17828646&ev_number=111111&ev_code=111111', 'rb');

if($f===false){
   echo 'error openning url';
}

// getting data
$out=array(); $out="";
while(!feof($f)) $out.=fgets($f);

fclose($f);

// searching for hidden fields
if(!preg_match_all("/<input name='(.*)' type='hidden' value='(.*)'>/", $out, $result, PREG_SET_ORDER)){
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