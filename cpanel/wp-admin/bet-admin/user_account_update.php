<?php  
    include_once("../../function/cpanel/app_top.php");

    $params = array("Command"  => "AccountsList",
                    "Fields" => "Player,RealName,Email,Custom,Balance"
                  );

      $apiUser = Poker_API($params);
    
      if ($apiUser -> Result == "Ok"){
        for($i=0;$i<$apiUser -> Accounts;$i++){

          $RecDataUser = $db->select("SELECT * FROM user_profile WHERE Player = '".$apiUser -> Player[$i]."'");
    
          if($RecDataUser[0]['Player']){

            echo $apiUser -> Player[$i]."\n<br/>"; 
            echo $apiUser -> RealName[$i]."\n<br/>";
            echo $apiUser -> Email[$i]."\n<br/>";
            echo $apiUser -> Custom[$i]."\n<br/>";
            echo $apiUser -> Balance[$i]."\n";
            echo "Update -> ".$apiUser -> Player[$i]."\n<br/>";
            
          }else{

            $insert_arrays = array(
              'Player'=> $apiUser -> Player[$i],
              'RealName'=> $apiUser -> RealName[$i],
              'Email'=> $apiUser -> Email[$i],
              'Telephone'=> $apiUser -> Custom[$i],
              'Balance'=> $apiUser -> Balance[$i],
              'onlineCard'=> 0,
              'inviteUser'=> 0
            );
            $q  = $db->insert('user_profile',$insert_arrays);

            echo "Insert -> ".$apiUser -> Player[$i]."\n<br/>";
          }

          //exit();

        }
    }
    
?>