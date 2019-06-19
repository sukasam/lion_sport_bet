<?php
//print_r($_POST);
//include_once("app_top.php");
session_start();
include_once("app_top1.php");
include_once('poker_api.php');

// Array
// (
//     [amount] => 4000
//     [point_type] => top_win
//     [player] => D_D
//     [dateC] => 2018-12-15
//     [timeC] => 10:05:28
// )
$csrf = new csrf();
 
// Generate Token Id and Valid
$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);
if($csrf->check_valid('post')) {
    if($_POST){

        $Player = $db->CleanDBData($_POST['player']);
        $pointType = $db->CleanDBData($_POST['point_type']);
        $amount = $db->CleanDBData($_POST['amount']);
        $dateC = $db->CleanDBData($_POST['dateC']);
        $timeC = $db->CleanDBData($_POST['timeC']);
    
        $postfields1 = array(
            'player'=> $Player,
            'point' => $amount, 
            'point_type' => $pointType, 
            'date' => $dateC, 
            'time' => $timeC, 
            'logs'=>'checkPoint'
        );
    
        $responseP = curl_post(API_SITE,$postfields1);
    
        if($responseP == "0"){
    
            $postfields = array(
                'player'=> $Player,
                'point' => $amount, 
                'point_type' => $pointType, 
                'date' => $dateC, 
                'time' =>  $timeC, 
                'logs'=>'point_log'
            );
            
            $response = curl_post(API_SITE,$postfields);
    
            $params = array( 
                "Command"  => "AccountsEdit",
                "Player"   => $Player,
                "PRake"    => "0"
            );
    
            $api = Poker_API($params);
    
            $params2 = array(
                "Command"  => "AccountsIncBalance",
                "Player"   => $Player,
                "Amount"   => $amount
            );
            
            $api2 = Poker_API($params2);
            
            if ($api2 -> Result == "Ok"){
    
                $_SESSION['errors_code2'] = "alert-success";
                $_SESSION['errors_msg2'] = "Your point has been exchange to balance.";
                
                echo "1";
               // header("Location:../account.php?action=success");
    
            }else{
                $_SESSION['errors_code2'] = "alert-danger";
                $_SESSION['errors_msg2'] = $api2 -> Error;
        
                echo "2";
               // header("Location:../account.php?action=failed");
            }
        }else{
            echo "2";
            $_SESSION['errors_code2'] = "alert-danger";
            $_SESSION['errors_msg2'] = "The same amount that has been exchanged with the last time. Please try again later.";
        }
    }else{
        echo "2";
    }
}

?>