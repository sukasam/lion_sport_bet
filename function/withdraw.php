<?php
    include_once("app_top.php");
    include_once("poker_api.php");

    $csrf = new csrf();

    // Generate Token Id and Valid
    $token_id = $csrf->get_token_id();
    $token_value = $csrf->get_token($token_id);
    if($csrf->check_valid('post')) {
        if($_POST){

            $pkamount = $db->CleanDBData(decode($_POST['amount'],KEY_HASH));
            $pincode = $db->CleanDBData($_POST['pin_code']);
            $withdrwaType = $db->CleanDBData($_POST['withdraw_type']);
    
            if($withdrwaType == 1){
                $callBackW = "withdraw.php";
            }else if($withdrwaType == 2){
                $callBackW = "withdraw2.php";
            }
    
            if($_SESSION['security_code'] === $db->CleanDBData($_POST['withdraw_captcha_code'])) { // Check 
    
                if($db->CleanDBData(decode($_POST['amount'],KEY_HASH)) != "0"){
    
                    $params3 = array("Command"  => "AccountsGet",
                    "Player"   => $_SESSION['Player']);
                    $api3 = Poker_API($params3);
        
    
                    //if($api3->Note == $pincode){
    
                        if($api3 -> Balance >= $pkamount){
    
                            $RecData = $db->select("SELECT * FROM bank_info WHERE player = '".$_SESSION['Player']."' ORDER BY id DESC");
            
                            if($RecData[0]['id'] != ""){   
        
                                $params = array("Command"  => "AccountsDecBalance",
                                    "Player"   => $_SESSION['Player'],
                                    "Amount"  => $pkamount,
                                );
                                $api = Poker_API($params);

                                if($api -> Result == "Ok"){

                                    $postfields = array(
                                        'player'=> $_SESSION['Player'], 
                                        'amount'=> $pkamount, 
                                        'evoucher'=> "", 
                                        'activation_code'=> "", 
                                        'evoucher_amount'=> "0", 
                                        'date'=> date("Y-m-d"),
                                        'time'=> date("H:i:s"),
                                        'withdraw_type' => $withdrwaType,
                                        'status'=> "0",
                                        'logs'=>'withdraw_log',
                                    );
                        
                                    $response = curl_post(API_SITE,$postfields);
                                    
                                    $_SESSION['errors_code'] = "alert-success";
                                    $_SESSION['errors_msg'] = "Your withdrawal is being processed.";
            
                                    header("Location:".SiteRootDir."/".$callBackW."?action=success"); 
                                }else{
                                    $_SESSION['errors_code'] = "alert-danger";
                                    $_SESSION['errors_msg'] = 'Please select the amount you wish to withdraw.';
                                    header("Location:".SiteRootDir."/".$callBackW."?action=failed");
                                }
        
                            }else{
                                $_SESSION['errors_code'] = "alert-danger";
                                $_SESSION['errors_msg'] = TITLE_WITHDRAW_FUN2.'<br><a href="account.php">'.TITLE_WITHDRAW_FUN3.'</a>';
                                header("Location:".SiteRootDir."/".$callBackW."?action=failed");
                            }
                        }else{
        
                            $_SESSION['errors_code'] = "alert-danger";
                            $_SESSION['errors_msg'] = TITLE_WITHDRAW_FUN1;
                            header("Location:".SiteRootDir."/".$callBackW."?action=failed");
                           
                        }
                    // }else{
                    //     $_SESSION['errors_code'] = "alert-danger";
                    //     $_SESSION['errors_msg'] = "Your PIN Code is invalid.";
                    //     header("Location:".SiteRootDir."/".$callBackW."?action=failed");
                    // }
                   
                }else{
                    $_SESSION['errors_code'] = "alert-danger";
                    $_SESSION['errors_msg'] = 'Please select the amount you wish to withdraw.';
                    header("Location:".SiteRootDir."/".$callBackW."?action=failed");
                }
    
                // $_SESSION['errors_code'] = "alert-danger";
                // $_SESSION['errors_msg'] = TITLE_WITHDRAW_CLOSE;
                // header("Location:".SiteRootDir."/".$withdrwaType."?action=failed");
    
            }else{
                $_SESSION['errors_code'] = "alert-danger";
                $_SESSION['errors_msg'] = "Invalid security code.";
            
                header("Location:".SiteRootDir."/".$callBackW."?action=failed");
            }
       }
    }

?>