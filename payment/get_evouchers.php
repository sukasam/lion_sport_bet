<?php

/*

This script demonstrates getting complete listing 
of all e-Vouchers created by the Perfect Money user.

*/

// trying to open URL
$f=fopen('https://perfectmoney.is/acct/evcsv.asp?AccountID=1762128&PassPhrase=Mkung160230', 'rb');

if($f===false){
   echo 'error openning url';
}

// getting data to array (line per item)
$lines=array();
while(!feof($f)) array_push($lines, trim(fgets($f)));

fclose($f);

// try parsing data to array
if($lines[0]!='Created,e-Voucher number,Activation code,Currency,Batch,Payer Account,Payee Account,Activated,Amount'){

   // print error message
   echo $lines[0];

}else{

   // do parsing
   $ar=array();
   $n=count($lines);
   for($i=1; $i<$n; $i++){

      $item=explode(",", $lines[$i], 9);
      if(count($item)!=9) continue; // line is invalid - pass to next one
      $item_named['Created']=$item[0];
      $item_named['Number']=$item[1];
      $item_named['Code']=$item[2];
      $item_named['Currency']=$item[3];
      $item_named['Batch']=$item[4];
      $item_named['Payer Account']=$item[5];
      $item_named['Payee Account']=$item[6];
      $item_named['Activated']=$item[7];
      $item_named['Amount']=$item[8];
      array_push($ar, $item_named);
   }

}

echo '<pre>';
print_r($ar);
echo '</pre>';

?>