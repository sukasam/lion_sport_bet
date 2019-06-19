<?php
    include_once("_inc/config.php");
    include_once("poker_api.php");
    include_once("csrf.class.php");

    $csrf = new csrf();
 
    // Generate Token Id and Valid
    $token_id = $csrf->get_token_id();
    $token_value = $csrf->get_token($token_id);

    if($csrf->check_valid('post')) {
        //var_dump($_POST[$token_id]);
        if($_POST){

            if($_SESSION['security_code'] === $db->CleanDBData($_POST['login_captcha_code'])) { // Check 
                
                $params = array("Command"  => "AccountsPassword",
                "Player"   => $db->CleanDBData($_POST['username']),
                "PW"       => $db->CleanDBData($_POST['password']));
                $api = Poker_API($params);
    
                if ($api -> Result == "Ok" && $api -> Verified == "Yes"){
        
                    /*$_SESSION['errors_code'] = '';
                    $_SESSION['errors_msg'] = '';*/
        
                    $params2 = array("Command"  => "AccountsGet",
                    "Player"   => $db->CleanDBData($_POST['username']));
        
                    $api2 = Poker_API($params2);
        
                    if ($api2 -> Result == "Ok"){
        
                       /* echo "<pre>";
                        print_r($api2);
                        echo "</pre>";
                        exit();*/
        
                        $_SESSION['Player'] = $api2 -> Player;
                        $_SESSION['Player_PW'] = $db->CleanDBData($_POST['password']);
                        $_SESSION['Player_Email'] = $api2 -> Email;
                        $_SESSION['Player_Phone'] = $api2 -> Custom;
                        $_SESSION['Player_RealName'] = $api2 -> RealName;
                        $_SESSION['Player_Balance'] = $api2 -> Balance;
                        $_SESSION['Player_Lang'] = "ir";
        
                        $postfields = array(
                            'player'=> $db->CleanDBData($_POST['username']), 
                            'domain'=> DOMAIN_SITE,
                            'ip'=> getUserIP(),
                            'date'=> date("Y-m-d"),
                            'time'=> date("H:i:s"),
                            'action'=>'Success',
                            'logs'=>'report_login',
                        );
                        $response = curl_post(API_SITE,$postfields);
            
                        //header("Location:../set_pin.php");
        
                    }else{
                        header("Location:../logout.php");
                    }
        
                }else{
        
                    $postfields = array(
                        'player'=> $db->CleanDBData($_POST['username']), 
                        'domain'=> DOMAIN_SITE,
                        'ip'=> getUserIP(),
                        'date'=> date("Y-m-d"),
                        'time'=> date("H:i:s"),
                        'action'=>'Failed',
                        'logs'=>'report_login',
                    );
        
                    $response = curl_post(API_SITE,$postfields);
        
                    $_SESSION['errors_code'] = "alert-danger";
                    $_SESSION['errors_msg'] = "Username or password is invalid.";
        
                    header("Location:../login.php?action=failed");
                } 
        
            }else{
                $_SESSION['errors_code'] = "alert-danger";
                $_SESSION['errors_msg'] = "Invalid security code.";
        
                header("Location:../login.php?action=failed");
            }
        }
    } else {
        echo 'Not Valid';
    }

?>
