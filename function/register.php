<?php
    include_once("_inc/config.php");
    include_once("poker_api.php");

    include_once("csrf.class.php");

    $csrf = new csrf();
 
    // Generate Token Id and Valid
    $token_id = $csrf->get_token_id();
    $token_value = $csrf->get_token($token_id);

    if($csrf->check_valid('post')) {
        if($_POST){
            if($_SESSION['security_code'] === $db->CleanDBData($_POST['register_captcha_code'])) { // Check 
    
                $Player = $db->CleanDBData($_POST["user_username"]);
                $Password = $db->CleanDBData($_POST["user_password"]);
                $Email = $db->CleanDBData($_POST["user_email"]);
                $Location = $db->CleanDBData($_POST["user_location"]);
                $affiliate = decode($_SESSION['affiliate'],KEY_HASH);
                $Phone = $db->CleanDBData($_POST['user_phone']);
        
                if($affiliate != ""){
                    $noteAPI = "Affiliate by ".$affiliate; 
                }else{
                    $noteAPI = ""; 
                }
        
                $params = array("Command"  => "AccountsAdd",
                "Player"   => $Player,
                "PW"       => $Password,
                "Location" => $Location,
                "Email"    => $Email,
                "Custom"   => $Phone,
                "Chat"     => "Yes",
                "Note"     => $noteAPI);
        
                $api = Poker_API($params);
                if ($api -> Result == "Ok"){
        
                    $_SESSION['errors_code'] = "alert-success";
                    $_SESSION['errors_msg'] = 'حساب کاربری با موفقیت ایجاد شد '.$Player.' برای نام کاربری. <a href="login.php"> (برای ورود اینجا کلیک کنید) </a>';
                    
                    if($affiliate != ""){
                        $postfields = array(
                            'player'=> $affiliate,
                            'affiliate'=> $Player,
                            'date'=> date("Y-m-d"),
                            'time'=> date("H:i:s"),
                            'action'=>'Enable',
                            'commission'=>'0',
                            'amount'=>'0',
                            'logs'=>'affiliate_log',
                        );
                            $response = curl_post(API_SITE,$postfields);
                    }
        
                    $_SESSION['affiliate'] = "";
                    unset($_SESSION['affiliate']);
                    $affiliate = "";
        
                    unset($_SESSION['Player']);
                    unset($_SESSION['Player_PW']);
        
                    header("Location:../register.php?action=success");
        
        
                }else{
                    $_SESSION['errors_code'] = "alert-danger";
                    
                    $errorsMSG = $api -> Error;
    
                    switch ($errorsMSG) {
                        case "Account already exists":
                            $_SESSION['errors_msg'] = "نام کاربری استفاده شده است";
                            break;
                        case "Email address already used by another player":
                            $_SESSION['errors_msg'] = "آدرس ایمیل توسط کاربر دیگری ثبت شده است";
                            break;
                        case "Player name must from 3 to 12 characters in length":
                            $_SESSION['errors_msg'] = "نام کاربری باید بین ۳ تا ۱۲ کاراکتر باشد";
                            break;
                        default:
                            $_SESSION['errors_msg'] = $api -> Error;
                    }
                   
        
                    header("Location:../register.php?action=failed");
                }
        
            }else{
                 $_SESSION['errors_code'] = "alert-danger";
                 $_SESSION['errors_msg'] = "Invalid security code.";
        
                 header("Location:../register.php?action=failed");
            }
        }
    } else {
        echo 'Not Valid';
    }

?>
