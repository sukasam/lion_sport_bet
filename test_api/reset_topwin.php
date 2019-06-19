<?php
include_once("../function/poker_api.php");

$params = array(
    "Command"  => "AccountsList",
     "Fields" => "Player,PRake"
  );

  $apiUser = Poker_API($params);


  if ($apiUser -> Result == "Ok"){

     for($i=0;$i<$apiUser->Accounts;$i++){
       set_time_limit(0);
      echo $apiUser -> Player[$i]." ".$apiUser -> PRake[$i]."<br>";
      $params2 = array(
        "Command"  => "AccountsEdit",
         "Player" => $apiUser -> Player[$i],
         "PRake" => "0",
      );
      $apiUser2 = Poker_API($params2);

    }

  }

//  echo "<pre>";
//  print_r($api);
// echo "</pre>";

/*if ($api -> Result == "Ok") echo "Account successfully created for $Player";
else echo "Error: " . $api -> Error . "<br>Click Back Button to correct.";*/
exit;
?>