<?php

  include_once("../../function/poker_api.php");
  include_once("../../_inc/config.php");
  if($_POST){

    // $params = array("Command"  => "AccountsPassword",
    // "Player"   => $_POST['username'],
    // "PW"       => $_POST['password']);
    // $api = Poker_API($params);
    $passUser = encode(KEY_HASH,$_POST['password']);

    $RecDataLoginUserCheck = $db->select("SELECT * FROM `user_profile` WHERE `Player` = '".$_POST['username']."' AND `password` = '".$passUser."'");
  
    if($RecDataLoginUserCheck[0]['Player'] != ""){
  
      $_SESSION['PlayerAdmin'] = $_POST['username'];
      $_SESSION['PlayerAdmin_PW'] = $_POST['password'];
      
      $postfields = array(
          'player'=> $_POST['username'], 
          'ip'=> getUserIP(),
          'date'=> date("Y-m-d"),
          'time'=> date("H:i:s"),
          'action'=>'Success',
          'logs'=>'report_login',
      );
      $response = curl_post(API_SITE,$postfields);

      header("Location:index.php");
  
    }else{
  
        $postfields = array(
            'player'=> $_POST['username'], 
            'ip'=> getUserIP(),
            'date'=> date("Y-m-d"),
            'time'=> date("H:i:s"),
            'action'=>'Failed',
            'logs'=>'report_login',
        );
  
        $response = curl_post(API_SITE,$postfields);
    } 
  }

?>
