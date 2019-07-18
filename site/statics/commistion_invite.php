<?php
include_once('../_inc/config.php');
include_once("../function/poker_api.php");
include_once("../function/poker_config.php");
error_reporting(0);

$RecData = $db->select("SELECT * FROM affiliate ORDER BY id DESC");
$configDT = $db->select("SELECT * FROM setting WHERE sid ='1' ORDER BY sid DESC"); 

//$db->DeleteAll("commission_invite");

foreach ($RecData as $key => $value) {
    set_time_limit(0);
    $params = array("Command"  => "AccountsList",
                    "Players" => $value['affiliate'],
                    "Fields" => "Player,ERake"
                );
    $api = Poker_API($params);
    // echo "<pre>";
    // echo  print_r($api);
    // echo "</pre>";
  
    if($api->ERake[0] != 0){
        $comRate = ($api->ERake[0] * ($configDT[0]['commission'] / 100));
        $committion = $comRate;
        // array_push($affiliate,$value['affiliate']);
        // array_push($inCom,number_format($comRate));
    }else{
        $committion = 0;
    }

    // echo $value['player']."<br>";

    // echo $value['affiliate']."<br>";

    // echo $value['date']."<br>";

    // echo $value['time']."<br>";

    // echo $committion."<br>";

    $ReCheckInvite = $db->select("SELECT * FROM commission_invite WHERE player = '".$value['player']."' AND affiliate = '".$value['affiliate']."'");
    if($ReCheckInvite[0]['id'] != ""){

      $update_arraysP = array(
        'commistion' => $committion,
      );
      $where_arraysP = array(
        'id' => $ReCheckInvite[0]['id'],
        
      );

      echo "Update => ".$value['affiliate']." => ".$committion."\r\n";
    
      //if ran successfully it will reture last insert id, else 0 for error
      $Qry = $db->Update('commission_invite',$update_arraysP,$where_arraysP);

    }else{
      $insert_arrays = array
      (
        'player' => $value['player'],
        'affiliate' => $value['affiliate'],
        'date' => $value['date'],
        'time' => $value['time'],
        'commistion' => $committion,
      );

      echo "Insert => ".$value['affiliate']." => ".$committion."\r\n";

      $Qry = $db->Insert('commission_invite',$insert_arrays);
    }

    
}

?>