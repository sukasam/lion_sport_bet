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
        
                $PasswordOld = encode($db->CleanDBData($_POST["old_password"]),KEY_HASH);
                $Password1 = encode($db->CleanDBData($_POST["new_password"]),KEY_HASH);
                $Password2 = encode($db->CleanDBData($_POST["retype_new_password"]),KEY_HASH);
    
            if($PasswordOld === $_SESSION['Player_PW']){
                if ($Password1 === $Password2){
    
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
    
                        header("Location:".SiteRootDir."change_password.php?action=success");
    
                    }else{
                        $_SESSION['errors_code'] = "alert-danger";
                        $_SESSION['errors_msg'] = $api -> Error;
    
                        header("Location:".SiteRootDir."change_password.php?action=failed");
                    }
                }else{
                    $_SESSION['errors_code'] = "alert-danger";
                    $_SESSION['errors_msg'] = "Current password is incorrect.";
        
                    header("Location:".SiteRootDir."change_password.php?action=failed");
                }
            }
    
        }
        
    }
    
    
?>
