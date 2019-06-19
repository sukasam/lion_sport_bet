<?php
include_once("../function/poker_api.php");
 $params = array("Command"  => "AccountsEdit",
 "Player"   => "adminT-T",
 "AdminProfile"       => "");
 
 $api = Poker_API($params);

 echo "<pre>";
 print_r($api);
echo "</pre>";

/*if ($api -> Result == "Ok") echo "Account successfully created for $Player";
else echo "Error: " . $api -> Error . "<br>Click Back Button to correct.";*/
exit;
?>