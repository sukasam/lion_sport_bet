<?php

 include_once("../../_inc/config.php"); 
 include_once("../../function/poker_config.php");
 include_once("../../function/poker_api.php");

 $params = array("Command"  => "AccountsList",
    "Fields" => "Player,RealName,Email,Custom,Balance"
  );

  $apiUser = Poker_API($params);

  if ($apiUser -> Result == "Ok"){
    for($i=0;$i<$apiUser -> Accounts;$i++){
        // echo $apiUser -> Email[$i];
        // exit();
        $RecData = $db->select("SELECT * FROM user_profile WHERE Player = '".$apiUser -> Player[$i]."'");
        if($RecData[0]['id'] != ""){
            
            $array_fields = array(
            'RealName' => $apiUser -> RealName[$i],
            'Email' => $apiUser -> Email[$i],
            'Telephone' => $apiUser -> Custom[$i],
            'Balance' => $apiUser -> Balance[$i],
            );
          
            $array_where = array(    
            'Player' => $apiUser -> Player[$i],
            );
          
            $q = $db->Update('user_profile', $array_fields, $array_where);

        }else{

           $array_fields = array(
            'Player' => $apiUser -> Player[$i],
            'RealName' => $apiUser -> RealName[$i],
            'Email' => $apiUser -> Email[$i],
            'Telephone' => $apiUser -> Custom[$i],
            'Balance' => $apiUser -> Balance[$i],
            );

            $q = $db->Insert('user_profile', $array_fields);

          //INSERT INTO `user_profile` (`id`, `Player`, `RealName`, `Email`, `Telephone`) VALUES (NULL, 'adminT-T', 'Sukasam', 'admin@lionroyal.com', '0000000000');
        }
    }
  }


?>