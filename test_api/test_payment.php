<?php
 $TOKEN = "a337b40a2e7c83b9d93c2cf545fbffb6ed042f79";
 $data = array(
    "cardnumber" => "5057851016548916",
    "ccv" => "955",
    "expire" => "0004",
    "pass" => "12463",
    "amount" => "1000",
    "pid" => "Unique Key"
  );
  $data_string = json_encode($data);
    // echo $data_string;
//   exit();
 $ch = curl_init("");
  curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
    "Content-Type: application/json",
    "Accept: application/json",
    "Authorization: Token ".$TOKEN,
  ));
  curl_setopt($ch, CURLOPT_POST, 1);  
  curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
  echo $output = curl_exec($ch);
  curl_close( $ch );
 ?>