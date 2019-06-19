<?php

    //include_once("_inc/config.php");
    // include_once("poker_api.php");
    // include_once("csrf.class.php");

    $_SESSION['errors_code'] = '';
    $_SESSION['errors_msg'] = '';

    if($csrf->check_valid('post')) {
        //var_dump($_POST[$token_id]);

        if($_POST){

            if($_SESSION['security_code'] === $db->CleanDBData($_POST['login_captcha_code'])) { // Check 

                $passUser = encode(KEY_HASH,$_POST['password']);

                $RecDataLoginUserCheck = $db->select("SELECT * FROM `user_profile` WHERE `Player` = '".$_POST['username']."' AND `password` = '".$passUser."'");

                if($RecDataLoginUserCheck[0]['Player'] != ""){

                    $_SESSION['Player'] = $RecDataLoginUserCheck[0]['Player'];
                    $_SESSION['Player_PW'] = $RecDataLoginUserCheck[0]['password'];
                    $_SESSION['Player_Email'] = $RecDataLoginUserCheck[0]['Email'];
                    $_SESSION['Player_Phone'] = $RecDataLoginUserCheck[0]['Telephone'];
                    $_SESSION['Player_RealName'] = $RecDataLoginUserCheck[0]['RealName'];
                    $_SESSION['Player_Balance'] = $RecDataLoginUserCheck[0]['Balance'];
                    $_SESSION['Player_Lang'] = "en";

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

                    header("Location:".SiteRootDir."/index.php");

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
        
                    header("Location:".SiteRootDir."/login.php?action=failed");
                } 
        
            }else{
                $_SESSION['errors_code'] = "alert-danger";
                $_SESSION['errors_msg'] = "Invalid security code.";
        
                header("Location:".SiteRootDir."/login.php?action=failed");
            }
        }
    } else {

        $_SESSION['errors_code'] = "alert-danger";
        $_SESSION['errors_msg'] = "Invalid security code.";
        
        header("Location:".SiteRootDir."/login.php?action=failed");
        //echo 'Not Valid';
    }

?>
