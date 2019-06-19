<?php
include_once("../function/poker_api.php");

$handle = fopen("rake.csv", "r");
for ($i = 0; $row = fgetcsv($handle ); ++$i) {
    // Do something will $row array
//  echo "<pre>";
//  print_r($row);
//  echo "</pre>";
 //echo $row[0].",".$row[3]."<br>";
 $rake = str_replace(',', '', $row[3]);
      $params = array(
        "Command"  => "AccountsEdit",
         "Player" => $row[0],
         "PRake" => $rake,
      );
      $apiUser = Poker_API($params);
}
fclose($handle);

/*if ($api -> Result == "Ok") echo "Account successfully created for $Player";
else echo "Error: " . $api -> Error . "<br>Click Back Button to correct.";*/
exit;
?>