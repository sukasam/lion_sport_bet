<?php
     include_once("app_top.php");
    include_once("poker_api.php");

    $csrf = new csrf();
 
    // Generate Token Id and Valid
    $token_id = $csrf->get_token_id();
    $token_value = $csrf->get_token($token_id);
    if($csrf->check_valid('post')) {
        if($_POST){
            //if($_SESSION['security_code'] === $_POST['captcha_change_password']) { // Check 
        
            $PasswordOld = encode(KEY_HASH,$db->CleanDBData($_POST["old_password"]));
            $Password1 = encode(KEY_HASH,$db->CleanDBData($_POST["new_password"]));
            $Password2 = encode(KEY_HASH,$db->CleanDBData($_POST["retype_new_password"]));
    
            if($PasswordOld === $_SESSION['Player_PW']){
                if ($Password1 === $Password2){
    
                    // $params = array("Command"  => "AccountsEdit",
                    // "Player"   => $_SESSION['Player'],
                    // "PW"       => $Password1);
                    // $api = Poker_API($params);

                    $array_fields = array(
                        'password'=> $Password1,
                      );
                
                    $array_where = array(    
                    'Player' => $_SESSION['Player'],  
                    );
                    
                    $qPassUpdate = $db->Update('user_profile', $array_fields, $array_where);
    
                    if ($qPassUpdate){
                        $_SESSION['Player_PW'] = $Password1;
                        $_SESSION['errors_code'] = "alert-success";
                        $_SESSION['errors_msg'] = 'Password changed successfully.';
    
                        header("Location:".SiteRootDir."/change_password.php?action=success");
    
                    }else{
                        $_SESSION['errors_code'] = "alert-danger";
                        $_SESSION['errors_msg'] = $api -> Error;
    
                        header("Location:".SiteRootDir."/change_password.php?action=failed");
                    }
    
                }else{
                    $_SESSION['errors_code'] = "alert-danger";
                    $_SESSION['errors_msg'] = "New passwords do not match";
    
                    header("Location:".SiteRootDir."/change_password.php?action=failed");
                }
            }else{
                $_SESSION['errors_code'] = "alert-danger";
                $_SESSION['errors_msg'] = "Current password is incorrect.";
    
                header("Location:".SiteRootDir."/change_password.php?action=failed");
            }
    
        /*}else{
            $_SESSION['errors_code'] = "150";
            $_SESSION['errors_msg'] = "با عرض پوزش کد امنیتی وارد شده صحیح نمی باشد.";
        }*/
        }
        
    }
    
    
?>