<?php
    include_once("../function/poker_api.php");

    $params = array("Command"  => "AccountsList",
                    //"Players" => "adminT-T",
                    "Fields" => "Player"
                  );
    $api = Poker_API($params);

    // echo "<pre>";
    //   print_r($api);
    // echo "</pre>";

     for($i=0;$i<$api->Accounts;$i++){

        $params2 = array("Command"  => "AccountsEdit",
        "Player"   => $api->Player[$i],
        "Permissions"    => "");
        
        $api2 = Poker_API($params2);

        echo $api->Player[$i]." = ".$api2->Result."\r\n";
        //  echo "<pre>";
        //   print_r($api2);
        //  echo "</pre>";
        //exit();
     }

    /*if ($api -> Result == "Ok") echo "Account successfully created for $Player";
    else echo "Error: " . $api -> Error . "<br>Click Back Button to correct.";*/
    echo "done";
    exit;
?>