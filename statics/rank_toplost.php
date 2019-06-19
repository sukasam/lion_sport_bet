<?php

include_once('../_inc/config.php');
include_once("../function/poker_api.php");
include_once("../function/poker_config.php");
error_reporting(0);

$topLost = [];
$RecData = $db->select("SELECT * FROM `top_lost` GROUP BY `player` ORDER BY `id` DESC");
  foreach($RecData as $key => $val){
    $RecData2 = $db->select("SELECT SUM(point) AS point FROM `top_lost` WHERE `player` = '".$val['player']."'");
    array_push($topLost[$val['player']]=$RecData2[0]['point']);
  }
  arsort($topLost);
 
 $numRow = 0;

$db->DeleteAll("`rank_topLost`");

 foreach ($topLost as $player => $point) {
    $insert_arrays = array
      (
        'player' => $player,
        'point' => $point,
      );

      echo $player." => ".$point;

      $Qry = $db->Insert('rank_toplost',$insert_arrays);
      
    // if($numRow == 9){
    //     break;
    // }
    $numRow++;
 }

?>