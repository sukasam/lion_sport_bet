<?php

include_once("../_inc/config.php");

//$RecDataUser = $db->select("SELECT * FROM user_profile WHERE Player = '".$_SESSION['Player']."'");

$RecDataDeposit = $db->select("SELECT * FROM deposit_history WHERE status = '1' GROUP BY player");

foreach($RecDataDeposit as $key => $value){

    $array_fields = array(
        'onlineCard' => $db->CleanDBData('1'),
      );

      $array_where = array(    
        'player' => $db->CleanDBData($value['player']),
      );

      $Qry = $db->Update('user_profile', $array_fields, $array_where);
}

?>