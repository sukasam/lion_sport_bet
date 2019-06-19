<?php
    include_once("app_top.php");
    include_once("poker_config.php");
    include_once("poker_api.php");

    $csrf = new csrf();
 
    // Generate Token Id and Valid
    $token_id = $csrf->get_token_id();
    $token_value = $csrf->get_token($token_id);
    if($csrf->check_valid('post')) {
        if($_POST){
            if($_SESSION['security_code'] === $db->CleanDBData($_POST['deposit_captcha_code'])) { // Check 
    
                $e_voucher = $db->CleanDBData($_POST['e_voucher']);
                $activation_code = $db->CleanDBData($_POST['activation_code']);
    
                $postfields = array(
                    'AccountID'=> PERFECT_ACCOUNTID,
                    'PassPhrase'=> PERFECT_PASSPHRASE,
                    'Payee_Account' => PERFECT_PAYEE_ACCOUNT,
                    'ev_number' => $e_voucher,
                    'ev_code' => $activation_code,
                );
                
                $response = curl_post_outsite("https://perfectmoney.is/acct/ev_activate.asp",$postfields);
                
                //print_r($response);
                 
                
                 // searching for hidden fields
                 if(!preg_match_all("/<input name='(.*)' type='hidden' value='(.*)'>/", $response, $result, PREG_SET_ORDER)){
                    echo 'Ivalid output';
                    exit;
                 }
                 
                 $ar="";
                 foreach($result as $item){
                    $key=$item[1];
                    $ar[$key]=$item[2];
                 }
    
                $dateLog = date("Y-m-d");
                $timeLog = date("H:i:s");
        
        
                if(empty($ar['ERROR'])){
    
                    
        
                    $postfields = array(
                        'player'=> $_SESSION['Player'], 
                        'VOUCHER_NUM' => $ar['VOUCHER_NUM'],
                        'VOUCHER_ACTIVE' => $activation_code,
                        'VOUCHER_AMOUNT' => $ar['VOUCHER_AMOUNT'],
                        'VOUCHER_AMOUNT_CURRENCY' => $ar['VOUCHER_AMOUNT_CURRENCY'],
                        'Payee_Account' => $ar['Payee_Account'],
                        'PAYMENT_BATCH_NUM' => $ar['PAYMENT_BATCH_NUM'],
                        'date'=> $dateLog,
                        'time'=> $timeLog,
                        'logs'=>'deposit_ev',
                    );
        
                    $response = curl_post(API_SITE,$postfields);
    
                    $postfields = array(
                        'player'=> $_SESSION['Player'],
                        'amount'=> $ar['VOUCHER_AMOUNT'],
                        'deposit_type'=> "E-Voucher",
                        'date'=> $dateLog,
                        'time'=> $timeLog,
                        'tran_id' => $ar['PAYMENT_BATCH_NUM'], 
                        'currency'=> $configDT[0]['currency'],
                        'status' => "1",
                        'logs'=>'deposit_history_log'
                    );
                    
                    $response = curl_post(API_SITE,$postfields);
    
                    $totalConvert = floor($ar['VOUCHER_AMOUNT'] * $configDT[0]['currency']);
    
                    $params = array(
                        "Command"  => "AccountsIncBalance",
                        "Player"   => $_SESSION['Player'],
                        "Amount"   => $totalConvert,
                    );
                    
                    $api = Poker_API($params);
                    
                    if ($api -> Result == "Ok"){
                        $_SESSION['errors_code'] = "alert-success";
                        $_SESSION['errors_msg'] = "E-voucher # ".$ar['VOUCHER_NUM'].".<br>
                        Your account has been successfully deposited.";
            
                        header("Location:../deposit.php?action=success");
                    }else{
    
                        $_SESSION['errors_code'] = "alert-danger";
                        $_SESSION['errors_msg'] = $api -> Error." => Please contact support immediately.";
                
                        header("Location:../deposit.php?action=failed");
                    }
        
                }else{
    
                    $postfields = array(
                        'player'=> $_SESSION['Player'],
                        'amount'=> "0",
                        'deposit_type'=> "E-Voucher",
                        'date'=> $dateLog,
                        'time'=> $timeLog,
                        'tran_id' => "Failed (".$timeLog.")", 
                        'currency'=> $configDT[0]['currency'],
                        'status' => "2",
                        'logs'=>'deposit_history_log'
                    );
    
                    $response = curl_post(API_SITE,$postfields);
    
                    $_SESSION['errors_code'] = "alert-danger";
                    $_SESSION['errors_msg'] = $ar['ERROR'];
        
                    header("Location:../deposit.php?action=failed");
                }
        
            }else{
                $_SESSION['errors_code'] = "alert-danger";
                $_SESSION['errors_msg'] = "Invalid security code.";
        
                header("Location:../deposit.php?action=failed");
            }
        }
    }


?>