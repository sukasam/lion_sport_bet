<?php
    include_once("app_top.php");
    include_once("poker_api.php");

    $csrf = new csrf();
 
    // Generate Token Id and Valid
    $token_id = $csrf->get_token_id();
    $token_value = $csrf->get_token($token_id);
    if($csrf->check_valid('post')) {
        if($_POST){
            if($_SESSION['security_code'] === $db->CleanDBData($_POST['commission_captcha_code'])) { // Check 
    
                
            }else{
    
                 $_SESSION['errors_code'] = "alert-danger";
                 $_SESSION['errors_msg'] = "Invalid security code.";
        
                 header("Location:../invite.php?action=failed");
            }
        }
    }

?>
