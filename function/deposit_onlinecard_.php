<?php
    include_once("app_top.php");

    $csrf = new csrf();
 
    // Generate Token Id and Valid
    $token_id = $csrf->get_token_id();
    $token_value = $csrf->get_token($token_id);
    if($csrf->check_valid('post')) {
        if($_POST){
       
            //if($_SESSION['security_code'] === $_POST['deposit2_captcha_code']) { // Check 
    
                //if($_POST['card_number'] != ""){
    
                    if($db->CleanDBData($_POST['amount']) > 0){
    
                        /*$postfields = array(
                            'player'=> $_SESSION['Player'],
                            'amount'=> $_POST['amount'],
                            'cardnumber'=> $_POST['card_number'],
                            'pin2'=> $_POST['deposit_card_pin'],
                            'm_exp'=> $_POST['deposit_card_mexp'],
                            'y_exp'=> $_POST['deposit_card_yexp'],
                            'ccv'=> $_POST['deposit_card_ccv2'],
                            'date' => date("Y-m-d"), 
                            'time' => date("H:i:s"), 
                            'logs'=>'deposit_cardonline_log'
                        );
                        
                        $response = curl_post(API_SITE,$postfields);*/
    
                        $_SESSION['BANK_AMOUNT'] = $db->CleanDBData($_POST['amount']);
    
                        if($db->CleanDBData($_POST['paymentLevel']) == "D1" || $db->CleanDBData($_POST['paymentLevel']) == ""){
    
                            $postfields = array(
                                'amount'=> $db->CleanDBData($_POST['amount']),
                                'pin'=> PIN_MIHANKHARID24,
                                'callback'=> DOMAIN_SITE."/payment/callback5.php",
                                //'bank' => $_POST['deposit_bankname'], 
                                'bank' => "Melat", 
                                'description' => "Deposit of Player".$_SESSION['Player'], 
                            );
                        
                            $responseBank = curl_post_outsite("http://pwg.mihankharid24.com/api/create/",$postfields);                 
    
                            $postfields2 = array(
    
                                'player'=> $_SESSION['Player'],
                                'amount'=> $db->CleanDBData($_POST['amount']),
                                'deposit_type'=> "Online Card",
                                'date' => date("Y-m-d"), 
                                'time' => date("H:i:s"), 
                                'tran_id' => $responseBank,
                                'status' => "2", 
                                'logs'=>'deposit_history_log'
                    
                            );
                            
                            $response = curl_post(API_SITE,$postfields2);
                            
                            header("Location:http://pwg.mihankharid24.com/startpay/".$responseBank);
    
                            // $postfields = array(
                            //     'amount'=> $_POST['amount'],
                            //     'pin'=> PIN_NOVINSHOP,
                            //     'callback'=> DOMAIN_SITE."/payment/callback4.php",
                            //     //'bank' => $_POST['deposit_bankname'], 
                            //     'bank' => "Pasargard", 
                            //     'description' => "Deposit of Player".$_SESSION['Player'], 
                            // );
                        
                            // $responseBank = curl_post_outsite("http://pay.novinshoop.com/api/create/",$postfields);                 
    
                            // $postfields2 = array(
    
                            //     'player'=> $_SESSION['Player'],
                            //     'amount'=> $_POST['amount'],
                            //     'deposit_type'=> "Online Card",
                            //     'date' => date("Y-m-d"), 
                            //     'time' => date("H:i:s"), 
                            //     'tran_id' => $responseBank,
                            //     'status' => "2", 
                            //     'logs'=>'deposit_history_log'
                    
                            // );
                            
                            // $response = curl_post(API_SITE,$postfields2);
                            
                            // header("Location:http://pay.novinshoop.com/startpay/".$responseBank);
    
                        }else{
    
                            // $amount = $_POST['amount']."0";
    
                            // $postfields = array(
                            //     'api_key'=> APIKEY_NOVINSHOOP,
                            //     'amount'=> $amount,
                            //     'return_url'=> DOMAIN_SITE."/payment/callback2.php",
                            // );
    
                            // // print_r($postfields);
                            // // exit();
                        
                            // //$responseBank = curl_post_outsite("http://easypay90.me/invoice/request/",$postfields);
                            // $responseBank = curl_post_outsite("http://panel.novinshoop.com/invoice/request/",$postfields);
                            
                            
    
                            // $jsonBank = json_decode($responseBank); 
    
    
                            // $postfields2 = array(
    
                            //     'player'=> $_SESSION['Player'],
                            //     'amount'=> $_POST['amount'],
                            //     'deposit_type'=> "Online Card",
                            //     'date' => date("Y-m-d"), 
                            //     'time' => date("H:i:s"), 
                            //     'tran_id' => $jsonBank->invoice_key,
                            //     'status' => "2", 
                            //     'logs'=>'deposit_history_log'
                    
                            // );
                            
                            
                            // $response = curl_post(API_SITE,$postfields2);
    
                            // //header("Location:http://easypay90.me/invoice/pay/".$jsonBank->invoice_key);
                            // header("Location:http://panel.novinshoop.com/invoice/pay/".$jsonBank->invoice_key);
    
                            function siteeee_pay($api_key, $amount, $redirect){
                                $curl = curl_init();
                                curl_setopt($curl, CURLOPT_URL, 'http://panel.novinshoop.com/webservice/paymentRequest.php');
                                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type' => 'application/json'));
                                curl_setopt($curl, CURLOPT_POSTFIELDS, "MerchantID={$api_key}&Amount={$amount}&Description=payment&InvoiceNumber=1&CallbackURL=". urlencode($redirect));
                                curl_setopt($curl, CURLOPT_TIMEOUT, 30);
                                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                $curl_exec = curl_exec($curl);
                                curl_close($curl);
                                return $curl_exec;
                            }
    
                            
    
                            $api_key = APIKEY_NOVINSHOOP;
                            $amount = $db->CleanDBData($_POST['amount']);
                            $redirect = DOMAIN_SITE."/payment/callback3.php";
    
                            $returnBank = siteeee_pay($api_key,$amount,$redirect);
    
                                $result = json_decode($returnBank,1);
    
                                if($result['Status'] == 100) {
    
                                    $postfields2 = array(
    
                                        'player'=> $_SESSION['Player'],
                                        'amount'=> $db->CleanDBData($_POST['amount']),
                                        'deposit_type'=> "Online Card",
                                        'date' => date("Y-m-d"), 
                                        'time' => date("H:i:s"), 
                                        'tran_id' => $result['Authority'],
                                        'status' => "2", 
                                        'logs'=>'deposit_history_log'
                            
                                    );
                                    
                                    
                                    $response = curl_post(API_SITE,$postfields2);
    
                                    //$update[payment_rand] = $result['Authority'];
                                    // $sql = $db->queryUpdate('payment', $update, 'WHERE `payment_rand` = "'.$factorNumber.'" LIMIT 1;');
                                    // $db->execute($sql);
                                    $go = "http://panel.novinshoop.com/startPay/".$result['Authority'];
                                    header("Location: $go");
    
                                    exit;
                                } else {
                                    //-- نمایش خطا
                                    // $data[title] = 'خطای سیستم';
                                    // $data[message] = '<font color="red">در ارتباط با درگاه مشکلی به وجود آمده است.</font> شماره خطا: '.'<br />'.'متن خطا: '.'<br />'. '<a href="index.php" class="button">بازگشت</a>';
                                    // $smarty->assign('data', $data);
                                    // $smarty->display('message.tpl');
                                   // echo "Errors";
                                    $_SESSION['errors_code1'] = "alert-danger";
                                    $_SESSION['errors_msg1'] = "Online card is not yet available. And we'll let you know when the system is ready.";
                            
                                    header("Location:../deposit2.php?action=failed");
                                    exit;
                                }
    
                        }
                    
    
                        // $postfields = array(
                        //     'player'=> $_SESSION['Player'],
                        //     'amount'=> $_POST['amount'],
                        //     'deposit_type'=> "Online Card",
                        //     'date' => date("Y-m-d"), 
                        //     'time' => date("H:i:s"), 
                        //     'tran_id' => $responseBank,
                        //     'status' => "0", 
                        //     'logs'=>'deposit_history_log'
                        // );
                        
                        // $response = curl_post(API_SITE,$postfields);
                        
        
                        /*$_SESSION['errors_code1'] = "alert-success";
                        $_SESSION['errors_msg1'] = "Deposit has been processing";
                
                        header("Location:../deposit2.php?action=success");*/
    
                        // $_SESSION['errors_code1'] = "alert-danger";
                        // $_SESSION['errors_msg1'] = "Online card is not yet available. And we'll let you know when the system is ready.";
                
                        // header("Location:../deposit2.php?action=failed");
    
                    }else{
        
                        $_SESSION['errors_code1'] = "alert-danger";
                        $_SESSION['errors_msg1'] = 'Please select the amount you wish to deposit.';
                
                        header("Location:../deposit2.php?action=failed");
                    }
                   
               /* }else{
                    $_SESSION['errors_code1'] = "alert-danger";
                    $_SESSION['errors_msg1'] = 'Please complete the bank information before you withdraw.<br><a href="account.php">Go to your account</a>';
            
                    header("Location:../deposit2.php?action=failed");
                }*/
    
            // }else{
    
            //     $_SESSION['errors_code1'] = "alert-danger";
            //     $_SESSION['errors_msg1'] = "Invalid security code.";
        
            //     header("Location:../deposit2.php?action=failed");
            // }
        }
    }

?>