<?php
    
    include_once("app_top.php");

    $csrf = new csrf();
 
    // Generate Token Id and Valid
    $token_id = $csrf->get_token_id();
    $token_value = $csrf->get_token($token_id);
    if($csrf->check_valid('post')) {
        if($_POST){

            $account_email = $db->CleanDBData($_POST['account_email']);
            $account_phone = $db->CleanDBData($_POST['account_phone']);

			$sqlu = "update user_profile set Email=?,Telephone=? where Player=?";
			$values = array($account_email,$account_phone,$_SESSION['Player']);
			$model->doUpdate($sqlu,$values);
        
            $_SESSION['Player_Email'] = $account_email;
            $_SESSION['Player_Phone'] = $account_phone;
    
            $_SESSION['errors_code'] = "alert-success";
            $_SESSION['errors_msg'] = "Updated account information.";
    
            header("Location:".SiteRootDir."account.php?action=success");
            
        }
    } else {
        echo 'Not Valid';
    }

?>