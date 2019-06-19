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
        $totalC = preg_match(',', '', $db->CleanDBData($_POST["totalC"]));
    
        $postfields1 = array(
            'player'=> $_SESSION['Player'],
            'date' => $db->CleanDBData($_POST['dateC']), 
            'time' =>  $db->CleanDBData($_POST['timeC']), 
            'amount'=> $totalC,
            'logs'=>'checkCommistion'
        );
    
        $responseC = curl_post(API_SITE,$postfields1);
    
        if($responseC == "0"){
    
            $postfields = array(
                'player'=> $_SESSION['Player'],
                'date' => $db->CleanDBData($_POST['dateC']), 
                'time' =>  $db->CleanDBData($_POST['timeC']), 
                'amount'=> $totalC,
                'logs'=>'commission_history_log'
            );
            
            $response = curl_post(API_SITE,$postfields);
    
            // Update to database
            foreach ($_POST['affiliate'] as $key => $value) {

                set_time_limit(0);
                //echo  $value."<br>";
                $params2 = array("Command"  => "AccountsEdit",
                "Player"   => $value,
                "ERake"   => "0");
                $api2 = Poker_API($params2);
                
               // print_r($api2);
                
    
            }

            $params = array("Command"  => "AccountsIncBalance",
            "Player"   => $Player,
            "Amount"   => $totalC);
            $api = Poker_API($params);

            // print_r($api);
            // exit();
            
            if ($api -> Result == "Ok"){
    
                $_SESSION['errors_code'] = "alert-success";
                $_SESSION['errors_msg'] = "Your commission has been withdrawn.";
    
                echo "0";
                //header("Location:../invite.php?action=success"); 
    
            }else{
                $_SESSION['errors_code'] = "alert-danger";
                $_SESSION['errors_msg'] = $api -> Error;
    
                echo "1";
        
                // header("Location:../invite.php?action=failed");
            }
        }else{
            // $_SESSION['errors_code'] = "alert-danger";
            // $_SESSION['errors_msg'] = "Withdrawing your commissions has a problem. Please try again.";
            $_SESSION['errors_code'] = "alert-success";
            $_SESSION['errors_msg'] = "Your commission has been withdrawn.";
    
            echo "2";
    
            // header("Location:../invite.php?action=success"); 
        }
    }else{
        echo "2";
    }   
}else{
    //echo "Fuck";
}

?>