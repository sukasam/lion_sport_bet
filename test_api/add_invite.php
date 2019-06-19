<?php

include_once("../_inc/config.php");

//$RecDataUser = $db->select("SELECT * FROM user_profile WHERE Player = '".$_SESSION['Player']."'");

// $RecDataUser = $db->select("SELECT Player,Email FROM user_profile");

// foreach($RecDataUser as $key => $value){
//     $array_fields = array(
//     'Email' => $db->CleanDBData(strtolower($value['Email'])),
//     );

//     $array_where = array(    
//     'Player' => $db->CleanDBData($value['Player']),
//     );

//      $Qry = $db->Update('user_profile', $array_fields, $array_where);
// }

// foreach($RecDataDeposit as $key => $value){

//     // $array_fields = array(
//     //     'onlineCard' => $db->CleanDBData('1'),
//     //   );

//     //   $array_where = array(    
//     //     'player' => $db->CleanDBData($value['player']),
//     //   );

//     //   $Qry = $db->Update('user_profile', $array_fields, $array_where);
// }

$strFileName = "email_invite.txt";
$objFopen = fopen($strFileName, 'r');
if ($objFopen) {
    while (!feof($objFopen)) {
        $file = fgets($objFopen, 4096);
        //echo $file."<br>";
        
        $emailList = trim(strtolower($file));
        $sqlEmail = "SELECT Player,Email FROM user_profile WHERE Email LIKE '%".$emailList."%'";
        $RecDataUser = $db->select($sqlEmail);

        
        if($RecDataUser[0]['Email'] != ""){

            $sqlEmailC = "SELECT * FROM affiliate WHERE player LIKE '%darkagent%' AND affiliate LIKE '%".$RecDataUser[0]['Player']."%'";
            $RecDataUseCr = $db->select($sqlEmailC);

            if($RecDataUseCr[0]['id'] == ""){
                $array_fields = array(
                    'player' => $db->CleanDBData('darkagent'),
                    //'player' => $db->CleanDBData('adminT-T'),
                    'affiliate' => $db->CleanDBData($RecDataUser[0]['Player']),
                    'date' => $db->CleanDBData(date("Y-m-d")),
                    'time' => $db->CleanDBData(date("H:i:s")),
                    'action' => $db->CleanDBData('Enable'),
                    'commission' => $db->CleanDBData('0'),
                    'amount' => $db->CleanDBData('0'),
                  );
    
                
                  $Qry = $db->Insert('affiliate', $array_fields);
            }
              
        }
    }
    fclose($objFopen);
}

?>