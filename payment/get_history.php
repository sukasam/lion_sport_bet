<?php

/*

This script demonstrates querying account history
using PerfectMoney API interface.

*/

// trying to open URL
$f=fopen('https://perfectmoney.is/acct/historycsv.asp?startmonth=1&startday=1&startyear=2007&endmonth=1&endday=27&endyear=2008&AccountID=10000&PassPhrase=111111', 'rb');

if($f===false){
   echo 'error openning url';
}

// getting data to array (line per item)
$lines=array();
while(!feof($f)) array_push($lines, trim(fgets($f)));

fclose($f);

// try parsing data to array
if($lines[0]!='Time,Type,Batch,Currency,Amount,Fee,Payer Account,Payee Account,Memo'){

   // print error message
   echo $lines[0];

}else{

   // do parsing
   $ar=array();
   $n=count($lines);
   for($i=1; $i<$n; $i++){

      $item=explode(",", $lines[$i], 9);
      if(count($item)!=9) continue; // line is invalid - pass to next one
      $item_named['Time']=$item[0];
      $item_named['Type']=$item[1];
      $item_named['Batch']=$item[2];
      $item_named['Currency']=$item[3];
      $item_named['Amount']=$item[4];
      $item_named['Fee']=$item[5];
      $item_named['Payer Account']=$item[6];
      $item_named['Payee Account']=$item[7];
      $item_named['Memo']=$item[8];
      array_push($ar, $item_named);
   }

}

echo '<pre>';
print_r($ar);
echo '</pre>';

?>