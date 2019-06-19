<?php
    include_once("_inc/config.php");
    include_once("poker_config.php");
    include_once("poker_api.php");
    include_once("csrf.class.php");

    $csrf = new csrf();
 
    // Generate Token Id and Valid
    $token_id = $csrf->get_token_id();
    $token_value = $csrf->get_token($token_id);

    if($csrf->check_valid('post')) {
        if($_POST){
            if($_SESSION['security_code'] === $db->CleanDBData($_POST['forgot_captcha_code'])) { // Check 
            
                $params = array("Command"  => "AccountsGet",
                "Player"   => $db->CleanDBData($_POST['user_username']));
                $api = Poker_API($params);
        
                if ($api -> Result == "Ok"){
                    
                    if($api -> Email == $db->CleanDBData($_POST['user_email'])){
    
        
                        $pwd = bin2hex(openssl_random_pseudo_bytes(4));
        
                        $params2 = array("Command"  => "AccountsEdit",
                        "Player"   => $db->CleanDBData($_POST['user_username']),
                        "PW"    => $pwd);
                        $api2 = Poker_API($params2);
        
                        if ($api2 -> Result == "Ok"){
    
                            $_SESSION['errors_code'] = "alert-success";
                            $_SESSION['errors_msg'] = 'Your password has been reset and sent to your email. Please check your (( Inbox )) and (( Spam )) folder';
                            
                            // Send email forgot Password.
    
                            $strSubject = "Your new password";
                            $strMessage =   '<h3>Lion Royal Online Sports Betting</h3>
                                            Please be careful about keeping the password.<br>
                                            User: '.$db->CleanDBData($_POST['user_username']).'<br>
                                            New password: '.$pwd.'<br>
                                            <a href="'.DOMAIN_SITE.'">'.DOMAIN_SITE.'</a><br><br>
                                            Thanks<br>
                                            Lion Royal Online Sports Betting<br>
                                            Telegram Channel: <a href="https://t.me/lionroyalsup">https://t.me/lionroyalsup</a>';
                            
                            $strTo = $db->CleanDBData($_POST['user_email']);
    
                            $from = "Lion Royal Online Sports Betting <no-reply@lionroyalcasino.com>";
    
                            $strTo = $strTo;
                            $strSubject = $strSubject;
                            $strHeader = "Content-type: text/html; charset=UTF-8\r\n"; // or UTF-8 //
                            $strHeader .= "From: ".$from;
                            $strMessage = $strMessage;
    
                            $flgSend = @mail($strTo,$strSubject,$strMessage,$strHeader);  // @ = No Show Error /
        
                            header("Location:../forgot_password.php?action=success");
        
                        }else{
                            $_SESSION['errors_code'] = "alert-success";
                            $_SESSION['errors_msg'] = $api2 -> Error;
        
                            header("Location:../forgot_password.php?action=failed");
                        }
        
                    }else{
                        $_SESSION['errors_code'] = "alert-danger";
                        $_SESSION['errors_msg'] = 'Username Or Email are Invalid.';
        
                        header("Location:../forgot_password.php?action=failed");
                    }
                    
                }else{
                    $_SESSION['errors_code'] = "alert-danger";
                    $_SESSION['errors_msg'] = $api -> Error;
        
                    header("Location:../forgot_password.php?action=failed");
                }
        
                /*$params = array("Command"  => "AccountsPassword",
                "Player"   => $db->CleanDBData($_POST['username']),
                "PW"       => $db->CleanDBData($_POST['password']);
                $api = Poker_API($params);
                
                if ($api -> Result == "Ok" && $api -> Verified == "Yes"){
                    $_SESSION['errors_code'] = '';
                    $_SESSION['errors_msg'] = '';
                    $_SESSION['Player'] = $db->CleanDBData($_POST['username']);
                    $_SESSION['Player_PW'] = $db->CleanDBData($_POST['password']);
                    header("Location:../dashboard.php");
        
                    Confirmation <br>Activation link has been sent Successfully.<br><br>Please check your Email Inbox/Spam Box.
        
                    Confirmation <br>Dear dumrus<br><br>New password has been sent Successfully.<br><br><b>New Password:</b> 25785471
        
                }else{
                    $_SESSION['errors_code'] = "120";
                    $_SESSION['errors_msg'] = "با عرض پوزش نام کاربری / رمز عبور وارد شده صحیح نمی باشد.";
                }*/
        
            }else{
                $_SESSION['errors_code'] = "alert-danger";
                $_SESSION['errors_msg'] = "Invalid security code.";
        
                header("Location:../forgot_password.php?action=failed");
            }
        }
    } else {
        echo 'Not Valid';
    }
    

?>
