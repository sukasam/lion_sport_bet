<?php

include_once('../_inc/config.php');
include_once("../function/poker_api.php");
include_once("../function/poker_config.php");
error_reporting(0);

$topHand = [];
$RecData = $db->select("SELECT * FROM `top_hand` GROUP BY `player` ORDER BY `id` DESC");
 foreach($RecData as $key => $val){
    $RecData2 = $db->select("SELECT COUNT(*) as count FROM `top_hand` WHERE `player` = '".$val['player']."'");
    array_push($topHand[$val['player']]=$RecData2[0]['count']);
 }
 arsort($topHand);
 
 $numRow = 0;

$db->DeleteAll("`rank_tophand`");

 foreach ($topHand as $player => $point) {
    $insert_arrays = array
      (
        'player' => $player,
        'point' => $point,
      );

      echo $player." => ".$point;

      $Qry = $db->Insert('rank_tophand',$insert_arrays);
      
    // if($numRow == 9){
    //     break;
    // }
    $numRow++;
 }

?>