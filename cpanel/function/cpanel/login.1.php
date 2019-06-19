<?php

  include_once("../../function/poker_api.php");

  if($_POST){

    $params = array("Command"  => "AccountsPassword",
    "Player"   => $_POST['username'],
    "PW"       => $_POST['password']);
    $api = Poker_API($params);
  
    if ($api -> Result == "Ok" && $api -> Verified == "Yes"){
  
        $params = array("Command"  => "AccountsGet",
                    "Player"   => $_POST['username']
                  );
        $apiRe = Poker_API($params);
  
       if($apiRe -> Permissions == 'admin'  || $apiRe -> Permissions == 'staff'){
  
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
