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
                
                $RecDataUserBan = $db->select("SELECT * FROM `user_ban` WHERE `player` = '".$_POST['username']."'");

                if($RecDataUserBan[0]['count'] <= 2 || $RecDataUserBan[0]['count'] == ""){
                    $checkbanPassed = "Yes";
                }else{
                    // echo strtotime($RecDataUserBan[0]['datetime'])."<br/>";
                    // echo strtotime("-10 minutes");
                    if(strtotime($RecDataUserBan[0]['datetime']) < strtotime("-10 minutes")){
                        
                        $update_arrays = array(
                            'count' => 0,
                            'datetime'=> date("Y-m-d H:i:s"), 
                        );
                        $where_arrays = array(
                            'player' => $_POST['username'],
                        );
                        //if ran successfully it will reture last insert id, else 0 for error
                        $q2  = $db->Update('user_ban',$update_arrays,$where_arrays);

                        $checkbanPassed = "Yes";

                        $RecDataUserBan[0]['count'] = 0;
                        

                    }else{
                        $checkbanPassed = "No";
                    }
                }


                if($checkbanPassed === "Yes"){

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
    
                        header("Location:".SiteRootDir."index.php");
            
                    }else{

                        $_SESSION['errors_code'] = "alert-danger";
                        $_SESSION['errors_msg'] = "Username or password is invalid.";
            
                        header("Location:".SiteRootDir."login.php?action=failed");
                    } 
                }else{
                    $_SESSION['errors_code'] = "alert-danger";
                    $_SESSION['errors_msg'] = "Invalid security code.";
            
                    header("Location:".SiteRootDir."login.php?action=failed");
                }

        
            }else{
                $_SESSION['errors_code'] = "alert-danger";
                $_SESSION['errors_msg'] = "Invalid security code.";
        
                header("Location:".SiteRootDir."login.php?action=failed");
            }
        }
    } else {
        echo 'Not Valid';
    }

?>
