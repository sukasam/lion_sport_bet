<?php
include_once('../_inc/config.php');
include_once("../function/poker_api.php");
include_once("../function/poker_config.php");
error_reporting(0);

$params = array("Command"  => "AccountsList",
        "Fields" => "Player,PRake"
    );
    $api = Poker_API($params);

    $topWin = [];

    foreach ($api->Player as $key => $value) {
        $countPRake = floor($api->PRake[$key]*0.01);
        if($countPRake >= 1){
            array_push($topWin[$value]=$countPRake);
        }
    }

    arsort($topWin);
 
 $numRow = 0;

$db->DeleteAll("`rank_topwin`");

foreach ($topWin as $player => $point) {
    $insert_arrays = array
      (
        'player' => $player,
        'point' => $point,
      );

      echo $player." => ".$point;

      $Qry = $db->Insert('rank_topwin',$insert_arrays);
      
    // if($numRow == 9){
    //     break;
    // }
    $numRow++;
 }

?>