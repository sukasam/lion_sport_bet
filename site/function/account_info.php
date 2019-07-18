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

            $update_arrays = array(
                'RealName' => $account_fname." ".$account_lname,
                'Email'=> $account_email, 
                'Telephone'=> $account_phone, 
                'onlineCard'=> 0, 
                'inviteUser'=> 0, 
            );
            $where_arrays = array(
                'Player' => $_SESSION['Player'],
            );
            //if ran successfully it will reture last insert id, else 0 for error
            $q2  = $db->Update('user_profile',$update_arrays,$where_arrays);
        
            if ($q2 == 1){
        
                $_SESSION['Player_Email'] = $account_email;
                $_SESSION['Player_Phone'] = $account_phone;
                $_SESSION['Player_RealName'] = $account_fname." ".$account_lname;
        
                $_SESSION['errors_code'] = "alert-success";
                $_SESSION['errors_msg'] = "Updated account information.";
        
                header("Location:".SiteRootDir."account.php?action=success");
        
            }else{
                $_SESSION['errors_code'] = "alert-danger";
                $_SESSION['errors_msg'] = $api -> Error;
        
                header("Location:".SiteRootDir."account.php?action=failed");
            }
            
        }
    } else {
        echo 'Not Valid';
    }

?>