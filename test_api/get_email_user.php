<?php
    include_once("../function/poker_api.php");
    include_once("../_inc/config.php");

    ini_set('max_execution_time', 0);

    $RecUserProfile = $db->select("SELECT telephone FROM user_profile WHERE telephone != '' AND telephone != '1234'");


    set_time_limit(0);

    foreach ($RecUserProfile as $key => $value) {

        set_time_limit(0);

        echo $value['telephone']."<br>";

        // // echo  $value['username']." ".$value['email']." ".$value['telephone'];
        // // exit();

        // $params = array("Command"  => "AccountsAdd",
        //             "Player"   => $value['username'],
        //             "PW"       => $value['email'],
        //             "Location" => "Lion game",
        //             "Email"    => $value['email'],
        //             "Custom"   => $value['telephone'],
        //         );
        // $api = Poker_API($params);

        // if ($api -> Result == "Ok") {
        //     echo "Account successfully created for ".$value['username']."<br>";}
        // else {
        //     echo "Error: " . $api -> Error." for ".$value['username']."<br>";
        // }
    }
    
?>