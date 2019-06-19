<?php

include_once("../function/poker_config.php");
include_once("../_inc/config.php");

$password = $passwordCallback;  // put your callback password here
if ($_POST["Password"] != $password) exit;
$f = fopen("Callback.txt","a");
$event = $_POST["Event"];
switch ($event)
{
  // case "Timer":
  //   fwrite($f,"Event = " .   $event . "\n");
  //   fwrite($f,"Time = " .    $_POST["Time"] . "\n");
  //   fwrite($f,"\n");
  //   break;
  case "NewAccount":
    fwrite($f,"Event = " .   $event . "\n");
    fwrite($f,"Player = " .  $_POST["Player"] . "\n");
    fwrite($f,"Source = " .  $_POST["Source"] . "\n");
    fwrite($f,"Time = " .    $_POST["Time"] . "\n");
    fwrite($f,"\n");

    $insert_arrays = array(
      'player' => $_POST["Player"],
      'Balance' => "0",
      'onlineCard' => 0,
      'inviteUser' => 0,
    );
  
    //if ran successfully it will reture last insert id, else 0 for error
    $q  = $db->insert('user_profile',$insert_arrays);

    $insert_arrays2 = array(
      'Player' => $_POST["Player"],
      'pin' => "",
    );
  
    //if ran successfully it will reture last insert id, else 0 for error
    $q2  = $db->insert('user_pin',$insert_arrays2);

    $insert_arrays3 = array(
      'Player' => $_POST["Player"],
      'block' => "0",
    );
  
    //if ran successfully it will reture last insert id, else 0 for error
    $q3  = $db->insert('user_block',$insert_arrays3);

    break;
  // case "Balance":
  //   fwrite($f,"Event = " .   $event . "\n");
  //   fwrite($f,"Player = " .  $_POST["Player"] . "\n");
  //   fwrite($f,"Change = " .  $_POST["Change"] . "\n");
  //   fwrite($f,"Balance = " . $_POST["Balance"] . "\n");
  //   fwrite($f,"Source = " .  $_POST["Source"] . "\n");
  //   fwrite($f,"Time = " .    $_POST["Time"] . "\n");
  //   fwrite($f,"\n");
  //   break;
  // case "Login":
  //   fwrite($f,"Event = " .     $event . "\n");
  //   fwrite($f,"Player = " .    $_POST["Player"] . "\n");
  //   fwrite($f,"SessionID = " . $_POST["SessionID"] . "\n");
  //   fwrite($f,"Time = " .      $_POST["Time"] . "\n");
  //   fwrite($f,"\n");
  //   break;
  // case "Logout":
  //   fwrite($f,"Event = " .  $event . "\n");
  //   fwrite($f,"Player = " . $_POST["Player"] . "\n");
  //   fwrite($f,"Time = " .   $_POST["Time"] . "\n");
  //   fwrite($f,"\n");
  //   break;
  // case "RingGameJoin":
  //   fwrite($f,"Event = " .  $event . "\n");
  //   fwrite($f,"Name = " .   $_POST["Name"] . "\n");
  //   fwrite($f,"Player = " . $_POST["Player"] . "\n");
  //   fwrite($f,"Amount = " . $_POST["Amount"] . "\n");
  //   fwrite($f,"Time = " .   $_POST["Time"] . "\n");
  //   fwrite($f,"\n");
  //   break;
  // case "RingGameLeave":
  //   fwrite($f,"Event = " .   $event . "\n");
  //   fwrite($f,"Name = " .    $_POST["Name"] . "\n");
  //   fwrite($f,"Player = " .  $_POST["Player"] . "\n");
  //   fwrite($f,"Amount = " .  $_POST["Amount"] . "\n");
  //   fwrite($f,"Net = " .     $_POST["Net"] . "\n");
  //   fwrite($f,"Expired = " . $_POST["Expired"] . "\n");
  //   fwrite($f,"Time = " .    $_POST["Time"] . "\n");
  //   fwrite($f,"\n");
  //   break;
  // case "RingGameStart":
  //   fwrite($f,"Event = " .  $event . "\n");
  //   fwrite($f,"Name = " .   $_POST["Name"] . "\n");
  //   fwrite($f,"Time = " .   $_POST["Time"] . "\n");
  //   fwrite($f,"\n");
  //   break;
  // case "RingGameStop":
  //   fwrite($f,"Event = " .  $event . "\n");
  //   fwrite($f,"Name = " .   $_POST["Name"] . "\n");
  //   fwrite($f,"Time = " .   $_POST["Time"] . "\n");
  //   fwrite($f,"\n");
  //   break;
  // case "RingGameError":
  //   fwrite($f,"Event = " . $event . "\n");
  //   fwrite($f,"Name = " .  $_POST["Name"] . "\n");
  //   fwrite($f,"Error = " . $_POST["Error"] . "\n");
  //   fwrite($f,"Time = " .  $_POST["Time"] . "\n");
  //   fwrite($f,"\n");
  //   break;
  // case "TourneyRegister":
  //   fwrite($f,"Event = " .  $event . "\n");
  //   fwrite($f,"Name = "  .  $_POST["Name"] . "\n");
  //   fwrite($f,"Player = " . $_POST["Player"] . "\n");
  //   fwrite($f,"Time = " .   $_POST["Time"] . "\n");
  //   fwrite($f,"\n");
  //   break;
  // case "TourneyUnregister":
  //   fwrite($f,"Event = " .  $event . "\n");
  //   fwrite($f,"Name = "  .  $_POST["Name"] . "\n");
  //   fwrite($f,"Player = " . $_POST["Player"] . "\n");
  //   fwrite($f,"Time = " .   $_POST["Time"] . "\n");
  //   fwrite($f,"\n");
  //   break;
  // case "TourneyStart":
  //   fwrite($f,"Event = " .  $event . "\n");
  //   fwrite($f,"Name = "  .  $_POST["Name"] . "\n");
  //   fwrite($f,"Number = " . $_POST["Number"] . "\n");
  //   fwrite($f,"Time = " .   $_POST["Time"] . "\n");
  //   fwrite($f,"\n");
  //   break;
  // case "TourneyCancel":
  //   fwrite($f,"Event = " .   $event . "\n");
  //   fwrite($f,"Name = "  .   $_POST["Name"] . "\n");
  //   fwrite($f,"Players = " . $_POST["Players"] . "\n");
  //   fwrite($f,"Time = " .    $_POST["Time"] . "\n");
  //   fwrite($f,"\n");
  //   break;
  // case "TourneyFinish":
  //   fwrite($f,"Event = " .  $event . "\n");
  //   fwrite($f,"Name = "  .  $_POST["Name"] . "\n");
  //   fwrite($f,"Number = " . $_POST["Number"] . "\n");
  //   fwrite($f,"Time = " .   $_POST["Time"] . "\n");
  //   fwrite($f,"\n");
  //   break;
  // case "TourneyTimer":
  //   fwrite($f,"Event = " .  $event . "\n");
  //   fwrite($f,"Name = "  .  $_POST["Name"] . "\n");
  //   fwrite($f,"Number = " . $_POST["Number"] . "\n");
  //   fwrite($f,"Timer = " .  $_POST["Timer"] . "\n");
  //   fwrite($f,"Count = " .  $_POST["Count"] . "\n");
  //   fwrite($f,"Time = " .   $_POST["Time"] . "\n");
  //   fwrite($f,"\n");
  //   break;
  // case "TourneyKnockout":
  //   fwrite($f,"Event = " .  $event . "\n");
  //   fwrite($f,"Name = "  .  $_POST["Name"] . "\n");
  //   fwrite($f,"Table = " .  $_POST["Table"] . "\n");
  //   fwrite($f,"Player = " . $_POST["Player"] . "\n");
  //   fwrite($f,"Bounty = " . $_POST["Bounty"] . "\n");
  //   fwrite($f,"Hand = " .   $_POST["Hand"] . "\n");
  //   fwrite($f,"Time = " .   $_POST["Time"] . "\n");
  //   fwrite($f,"\n");
  //   break;
  // case "TourneyError":
  //   fwrite($f,"Event = " . $event . "\n");
  //   fwrite($f,"Name = " .  $_POST["Name"] . "\n");
  //   fwrite($f,"Error = " . $_POST["Error"] . "\n");
  //   fwrite($f,"Time = " .  $_POST["Time"] . "\n");
  //   fwrite($f,"\n");
  //   break;
  // case "Hand":
  //   fwrite($f,"Event = " . $event . "\n");
  //   fwrite($f,"Hand = " .  $_POST["Hand"] . "\n");
  //   fwrite($f,"Type = " .  $_POST["Type"] . "\n");
  //   fwrite($f,"Name = " .  $_POST["Name"] . "\n");
  //   fwrite($f,"Table = " . $_POST["Table"] . "\n");
  //   fwrite($f,"Time = " .  $_POST["Time"] . "\n");
  //   fwrite($f,"\n");
  //   break;
  // case "LobbyChat":
  //   fwrite($f,"Event = " .  $event . "\n");
  //   fwrite($f,"Player = " . $_POST["Player"] . "\n");
  //   fwrite($f,"Title = " .  $_POST["Title"] . "\n");
  //   fwrite($f,"Chat = " .   $_POST["Chat"] . "\n");
  //   fwrite($f,"Time = " .   $_POST["Time"] . "\n");
  //   fwrite($f,"\n");
  //   break;
  // default:
  //   fwrite($f,"Unknown event: " . $event . "\n");
  //   fwrite($f,"\n");
  //   break;
}
fclose($f);
?>