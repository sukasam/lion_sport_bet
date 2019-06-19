<?php
    
    include_once("app_top.php");

    $csrf = new csrf();
 
    // Generate Token Id and Valid
    $token_id = $csrf->get_token_id();
    $token_value = $csrf->get_token($token_id);
    if($csrf->check_valid('post')) {
        if($_POST){

            $account_fname = $db->CleanDBData($_POST['account_fname']);
            $account_lname = $db->CleanDBData($_POST['account_lname']);
            $account_email = $db->CleanDBData($_POST['account_email']);
            $account_phone = $db->CleanDBData($_POST['account_phone']);
        
            $params = array("Command"  => "AccountsEdit",
            "Player"   => $_SESSION['Player'],
            "RealName" => $account_fname." ".$account_lname,
            "Email" => $account_email,
            "Custom" => $account_phone);
        
            $api = Poker_API($params);
        
            if ($api -> Result == "Ok"){
        
                $_SESSION['Player_Email'] = $account_email;
                $_SESSION['Player_Phone'] = $account_phone;
                $_SESSION['Player_RealName'] = $account_fname." ".$account_lname;
        
                $_SESSION['errors_code'] = "alert-success";
                $_SESSION['errors_msg'] = "Updated account information.";
        
                header("Location:../account.php?action=success");
        
            }else{
                $_SESSION['errors_code'] = "alert-danger";
                $_SESSION['errors_msg'] = $api -> Error;
        
                header("Location:../account.php?action=failed");
            }
            
        }
    } else {
        echo 'Not Valid';
    }

?>