<?php

  include_once("../../function/poker_api.php");
  include_once("../../_inc/config.php");
  if($_POST){
  
    $passUser = encode($_POST['password'],KEY_HASH);

    $RecDataLoginUserCheck = $db->select("SELECT * FROM `user_profile` WHERE `Player` = '".$_POST['username']."' AND `password` = '".$passUser."' AND `permission` = 'admin'");

    if($RecDataLoginUserCheck[0]['Player'] != ""){
  
      $_SESSION['PlayerAdmin'] = $_POST['username'];
      $_SESSION['PlayerAdmin_PW'] = $_POST['password'];
      header("Location:index.php");
  
    }else{
  
    } 
  }

?>
