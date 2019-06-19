<?php
    include_once("../function/poker_api.php");

    $params = array("Command"  => "AccountsPermission",
                    "Player"   => "adminT-T",
                    "Action"   => "Add",
                    //"Action"   => "Remove",
                    //"Action" => "Query",
                    "Permission" => "admin",
                  );
    $api = Poker_API($params);

    echo "<pre>";
      print_r($api);
    echo "</pre>";

    /*if ($api -> Result == "Ok") echo "Account successfully created for $Player";
    else echo "Error: " . $api -> Error . "<br>Click Back Button to correct.";*/
    exit;
?>