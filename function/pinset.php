<?php
    include_once("app_top.php");

    $csrf = new csrf();

    // Generate Token Id and Valid
    $token_id = $csrf->get_token_id();
    $token_value = $csrf->get_token($token_id);
    if($csrf->check_valid('post')) {
        if($_POST){

            $Player = $_SESSION['Player'];
            $pins = $db->CleanDBData($_POST['pincode']);

            if($pins != ""){

                $paramsUpdateN = array("Command"  => "AccountsEdit",
                "Player"   => $_SESSION['Player'],
                "Note"   => $pins,
                );

                $apiUpdateNote = Poker_API($paramsUpdateN);
                // $postfields = array(
                //     'player'=> $_SESSION['Player'],
                //     'pins'=> $pins, 
                //     'logs'=>'pins_log'
                // );
                // $response = curl_post(API_SITE,$postfields);
    
                $_SESSION['errors_code'] = "alert-success";
                $_SESSION['errors_msg'] = 'Your PIN was successfully registered. Please do not forget it at all<br><br>Your PIN is '.$pin.'<br><br><a href="index.php">Please click here to continue</a>';
    
                //header("Location:../set_pin.php?action=success");
            }else{
                $_SESSION['errors_code'] = "alert-danger";
                $_SESSION['errors_msg'] = "Please re-enter your pin code.";
        
                //header("Location:../set_pin.php?action=failed");
            }
            
            // $params = array("Command"  => "AccountsEdit",
            // "Player"   => $Player,
            // "Level"   => $pin);

            // $api = Poker_API($params);
            
            // if ($api -> Result == "Ok"){

            //     $_SESSION['errors_code'] = "alert-success";
            //     $_SESSION['errors_msg'] = 'Your PIN was successfully registered. Please do not forget it at all<br><br>Your PIN is '.$pin.'<br><br><a href="index.php">Please click here to continue</a>';

            //     header("Location:../set_pin.php?action=success");
            // }else{
            //     $_SESSION['errors_code'] = "alert-danger";
            //     $_SESSION['errors_msg'] = $api -> Error;
        
            //     header("Location:../set_pin.php?action=failed");
            // }
        }
    }
?>