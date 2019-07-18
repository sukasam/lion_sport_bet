<?php
 
  include_once("../../function/cpanel/app_top.php");
  include_once("../../function/poker_config.php");
  include_once("../../function/poker_api.php");


  $RecDataUser = $db->select("SELECT * FROM user_profile");

  foreach ($RecDataUser as $key => $value) {
   // echo $value['Player']."<br>";
  //  $pin = "";
  //  if($value['pin']  == "1"){
  //   $pin = "";
  //  }else{
  //   $pin = $value['pin'];
  //  }
  //  $insert_arrays = array
  //     (
  //       'Player' => $value['Player'],
  //       'block' => "0",
  //     );

  //     echo $value['Player']." => 0\n";

  //     $Qry = $db->Insert('user_block',$insert_arrays);
 }

  /*echo "<pre>";
  print_r($apiUser);
  echo "</pre>";*/

?>