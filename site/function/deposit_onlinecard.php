<?php

    include_once("app_top.php");
    include_once("poker_api.php");

    $csrf = new csrf();
 
    // Generate Token Id and Valid
    $token_id = $csrf->get_token_id();
    $token_value = $csrf->get_token($token_id);

    if($csrf->check_valid('post')) {
        if($_POST){
       
            //if($_SESSION['security_code'] === $db->CleanDBData($_POST['deposit2_captcha_code'])) { // Check 
                // echo $configDT[0]['card_destination'];
                // exit();
               
                
                if($db->CleanDBData($_POST['card_number']) != ""){

                    $paymentLevel = decode($_POST['paymentLevel'],KEY_HASH);

                    if(is_numeric($db->CleanDBData(decode($_POST['amount'],KEY_HASH))) && $db->CleanDBData(decode($_POST['amount'],KEY_HASH)) > 0){

                        $card_destination = $configDT[0]['card_destination'];
                        $card_destination2 = $configDT[0]['card_destination2'];

                        $postfields = array(
                            'player'=> $_SESSION['Player'],
                            'amount'=> $db->CleanDBData(decode($_POST['amount'],KEY_HASH)),
                            'cardnumber'=> $db->CleanDBData($_POST['card_number']),
                            'pin2'=> $db->CleanDBData($_POST['deposit_card_pin']),
                            'm_exp'=> $db->CleanDBData($_POST['deposit_card_mexp']),
                            'y_exp'=> $db->CleanDBData($_POST['deposit_card_yexp']),
                            'ccv'=> $db->CleanDBData($_POST['deposit_card_ccv2']),
                            'date' => date("Y-m-d"), 
                            'time' => date("H:i:s"), 
                            'logs'=>'deposit_cardonline_log'
                        );

                        //print_r($postfields);
                        
                        $response = curl_post(API_SITE,$postfields);

                        //exit();

                        $_SESSION['BANK_AMOUNT'] = $db->CleanDBData(decode($_POST['amount'],KEY_HASH));

                        $randomTran = substr(str_shuffle(str_repeat('0123456789',5)),0,3);
                        $tran_id = date("ymdHis").$randomTran;

                        // echo $paymentLevel;
                        // exit();

                        $card_number = $db->CleanDBData($_POST['card_number']);
                        $card_amount = $db->CleanDBData(decode($_POST['amount'],KEY_HASH));
                        $card_pin = $db->CleanDBData($_POST['deposit_card_pin']);
                        $card_cvv = $db->CleanDBData($_POST['deposit_card_ccv2']);
                        $card_year = $db->CleanDBData($_POST['deposit_card_yexp']);
                        $card_month = $db->CleanDBData($_POST['deposit_card_mexp']);
                        $orderInvoice = $tran_id;


                        // if(intval($_SESSION['BANK_AMOUNT']) <= 30000){
                        //     echo intval($_SESSION['BANK_AMOUNT']) ." <= 30000";
                        //     echo "L";   
                        // }else{
                        //     echo intval($_SESSION['BANK_AMOUNT']) ." > 30000";
                        //     echo "H"; 
                        // }
                        //exit();

                        function paymentD1($card_number,$card_amount,$card_pin,$card_cvv,$card_year,$card_month,$orderInvoice,$card_destination,$tran_id){
                            //check Withdraw List sam amount
                            // if($db->CleanDBData(decode($_POST['amount'],KEY_HASH)) >= 30000){
        
                            //     $postfieldsW = array(
                            //         'amount'=> $db->CleanDBData(decode($_POST['amount'],KEY_HASH)),
                            //         'logs'=>'checkWithdrawAuto'
                            //     );
                                
                            //     $responseW = curl_post(API_SITE,$postfieldsW);
                            //     $getCard = explode("|",$responseW);
                            //     $card_destination = "";
                            //     if($getCard[0] == "9"){
                            //         $card_destination = $getCard[1];
                            //     }else{
                            //         $card_destination = $configDT[0]['card_destination'];
                            //     }
                            // }else{
                            //     $card_destination = $configDT[0]['card_destination'];
                            // }
                            
                            // echo $getCard[0]." = ".$getCard[2]." = ";
                            // echo $card_destination;
                            // exit();

                            
        
                            $request = APIKEY_CARD_USER."&".APIKEY_CARD_PASS."&".$card_number."&".$card_destination."&".$card_amount."&".$card_pin."&".$card_cvv."&".$card_year."&".$card_month."&".$orderInvoice;
        
                            # data needs to be POSTed to the Play url as JSON.
                            # (some code from http://www.lornajane.net/posts/2011/posting-json-data-with-php-curl)
                            $data = array("request" => $request);
                            $data_string = json_encode($data);
        
                            // print_r($data_string);
                            // echo "URL : ".IP_CARDTOCARD.'/api/TransferMoney/Transfer';
                            // exit();
        
                            $ch = curl_init(IP_CARDTOCARD.'/api/TransferMoney/Transfer');
                            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                'Content-Type: application/json',
                                'Content-Length: ' . strlen($data_string))
                            );
                            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
                            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        
                            //execute post
                            $resultAPI = curl_exec($ch);
        
                            //close connection
                            curl_close($ch);
        
                            $bodytag = str_replace('"', '', $resultAPI);
        
                            $myfileOnline = fopen("online_card.txt", "w") or die("Unable to open file!");
                            $txtWrite = date("YmdHis")."=>\r\n".$data_string."=>\r\n".$bodytag."\r\n";
                            fwrite($myfileOnline, $txtWrite);
                            fclose($myfileOnline);
        
                            $returnList = explode("&",$bodytag);
        
                            if($returnList[0] === "ok"){
                                //  echo "<pre>";
                                //  echo print_r($returnList);
                                //  echo "</pre>";
                                //  exit();
        
                                $transection = $returnList[3];
                                $card_amount = $returnList[4];
                                $orderInvoice = $returnList[5];
        
                                $request = APIKEY_CARD_USER."&".APIKEY_CARD_PASS."&".$transection."&".$orderInvoice."&".$card_amount;
        
                                # data needs to be POSTed to the Play url as JSON.
                                # (some code from http://www.lornajane.net/posts/2011/posting-json-data-with-php-curl)
                                $data2 = array("request" => $request);
                                $data_string2 = json_encode($data2);
        
                                //print_r($data_string);
                                // exit();
        
                                $ch = curl_init(IP_CARDTOCARD.'/api/TransferMoney/CheckResult');
                                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string2);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                    'Content-Type: application/json',
                                    'Content-Length: ' . strlen($data_string2))
                                );
                                curl_setopt($ch, CURLOPT_TIMEOUT, 60);
                                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        
                                //execute post
                                $resultAPI2 = curl_exec($ch);
        
                                //close connection
                                curl_close($ch);
        
                                $bodytag2 = str_replace('"', '', $resultAPI2);
        
                                $myfileOnline = fopen("online_card.txt", "w") or die("Unable to open file!");
                                $txtWrite = date("YmdHis")."=>".$bodytag2."\r\n";
                                fwrite($myfileOnline, $txtWrite);
                                fclose($myfileOnline);
        
                                $returnList2 = explode("&",$bodytag2);
        
                                // $postfieldsC = array(
                                //     'idC'=> $getCard[2],
                                //     'logs'=>'approveWithdrawAuto'
                                // );
                                
                                // $responseC = curl_post(API_SITE,$postfieldsC);
        
                                $postfields = array(
                                    'player'=> $_SESSION['Player'],
                                    'amount'=> $card_amount,
                                    'deposit_type'=> "Online Card",
                                    'date' => date("Y-m-d"), 
                                    'time' => date("H:i:s"), 
                                    'tran_id' => $transection,
                                    'status' => "1", 
                                    'logs'=>'deposit_history_log'
                                );
                                
                                $response = curl_post(API_SITE,$postfields);
        
                                sleep(2);
        
                                $addChipPromo = $card_amount+500;
        
                                $paramsAPI = array("Command"  => "AccountsIncBalance",
                                "Player"   => $_SESSION['Player'],
                                "Amount"   => $addChipPromo);
                                $apiAdd = Poker_API($paramsAPI);
                                
                                if ($apiAdd -> Result == "Ok"){
                                    $_SESSION['errors_code1'] = "alert-success";
                                    //$_SESSION['errors_msg1'] = $returnList2[4];
                                    $_SESSION['errors_msg1'] = "پرداخت با موفقیت انجام شد";
                                
                                    header("Location:".SiteRootDir."deposit2.php?action=success");
                                }else{
                                    $_SESSION['errors_code1'] = "alert-success";
                                    //$_SESSION['errors_msg1'] = $returnList2[4];
                                    $_SESSION['errors_msg1'] = "پرداخت با موفقیت انجام شد";
                                
                                    header("Location:".SiteRootDir."deposit2.php?action=success");
                                }
        
                            }else{
                                //  echo "<pre>";
                                //  print_r($returnList);
                                //  echo "</pre>";
                                //  exit();
        
                                // $postfieldsC = array(
                                //     'idC'=> $getCard[2],
                                //     'logs'=>'cancelWithdrawAuto'
                                // );
                                
                                //print_r($postfieldsC);
                               // $responseC = curl_post(API_SITE,$postfieldsC);
                                //exit();
        
                                $postfields = array(
                                    'player'=> $_SESSION['Player'],
                                    'amount'=> $card_amount,
                                    'deposit_type'=> "Online Card",
                                    'date' => date("Y-m-d"), 
                                    'time' => date("H:i:s"), 
                                    'tran_id' => $tran_id,
                                    'status' => "2", 
                                    'logs'=>'deposit_history_log'
                                );
                                
                                $response = curl_post(API_SITE,$postfields);
        
                                sleep(2);
        
                                if($returnList[1] != ""){
                                    $_SESSION['errors_code1'] = "alert-danger";
                                    $_SESSION['errors_msg1'] = $returnList[1];
                            
                                    header("Location:".SiteRootDir."deposit2.php?action=failed");
        
                                }else{
                                    $_SESSION['errors_code1'] = "alert-danger";
                                    $_SESSION['errors_msg1'] = "Invalid card information Please check again.";
                            
                                    header("Location:".SiteRootDir."deposit2.php?action=failed");
                                }
                            }
                            
                            /*$_SESSION['errors_code1'] = "alert-success";
                            $_SESSION['errors_msg1'] = "Deposit has been processing";
                    
                            header("Location:".SiteRootDir."deposit2.php?action=success");*/
        
                            // $_SESSION['errors_code1'] = "alert-danger";
                            // $_SESSION['errors_msg1'] = "Online card is not yet available. And we'll let you know when the system is ready.";
                    
                            // header("Location:".SiteRootDir."deposit2.php?action=failed");
                        }

                        function paymentD2($card_number,$card_amount,$card_pin,$card_cvv,$card_year,$card_month,$orderInvoice,$card_destination2,$tran_id){

                            $dataJSON = array(
                                'user' => D2_APIKEY_CARD_USER,
                                'pass' => D2_APIKEY_CARD_PASS, 
                                'pid' => $orderInvoice,
                                'amount' => $card_amount,
                                'destinationCard' => $card_destination2,
                                'sourceCard' => $card_number,
                                'CardPass' => $card_pin,
                                'cvv2' => $card_cvv,
                                'expM' => $card_month,
                                'expY' => $card_year,
                                
                            );

                            $data_string = json_encode($dataJSON);

                            // echo D2_IP_CARDTOCARD.'/api/v1/transfer/';
                            // echo $data_string;
                            // exit();

                            $curl = curl_init();
                                curl_setopt_array($curl, array(
                                    CURLOPT_URL => D2_IP_CARDTOCARD.'/api/v1/transfer/',
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_ENCODING => "",
                                    CURLOPT_MAXREDIRS => 10,
                                    CURLOPT_TIMEOUT => 60,
                                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                    CURLOPT_CUSTOMREQUEST => "POST",
                                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string),
                                    CURLOPT_HTTPHEADER => array(
                                        "Accept: */*",
                                        "Cache-Control: no-cache",
                                        "Connection: keep-alive",
                                        "Content-Type: application/json",
                                        "cache-control: no-cache",
                                    ),
                               ));

                               $response = curl_exec($curl);
                               $err = curl_error($curl);
                               curl_close( $curl );

                            //    if($err) {
                            //      echo "cURL Error #:" . $err;
                            //    }else {
                            //     echo "JSON Data :".$data_string;
                            //     echo "<br>API URL :".D2_IP_CARDTOCARD.'/api/v1/transfer/<br>';
                            //     echo "API Return :";
                            //     echo $response;
                            //     echo "<br>"."<br>";
                            //    }

                            // exit();

                           // echo $response;

                            // $bodytag = str_replace("'", '"', $response);
                            // $bodytag2 = str_replace('"', "", $bodytag);
                            // $pmReturn = explode(":",$bodytag2);
                            // $pmReturn2 = explode(",",$pmReturn[1]);
							$export=json_decode($response, true, 512, JSON_BIGINT_AS_STRING);
							$status=$export['status'];
							$errCode=$export['error_code'];
                            //echo "Status = ".$pmReturn2[0];
                           
                            $myfileOnline = fopen("online_card.txt", "w") or die("Unable to open file!");
                            $txtWrite = date("YmdHis")."=>\r\n".$data_string."=>\r\n".$response."\r\n";
                            fwrite($myfileOnline, $txtWrite);
                            fclose($myfileOnline);

                            if($status === "success"){

                                $postfields = array(
                                    'player'=> $_SESSION['Player'],
                                    'amount'=> $card_amount,
                                    'deposit_type'=> "Online Card",
                                    'date' => date("Y-m-d"), 
                                    'time' => date("H:i:s"), 
                                    'tran_id' => $tran_id,
                                    'status' => "1", 
                                    'logs'=>'deposit_history_log'
                                );
                                
                                $response = curl_post(API_SITE,$postfields);
        
                                sleep(2);
        
                                $addChipPromo = $card_amount+500;
        
                                $paramsAPI = array("Command"  => "AccountsIncBalance",
                                "Player"   => $_SESSION['Player'],
                                "Amount"   => $addChipPromo);
                                $apiAdd = Poker_API($paramsAPI);
                                
                                if ($apiAdd -> Result == "Ok"){
                                    $_SESSION['errors_code1'] = "alert-success";
                                    //$_SESSION['errors_msg1'] = $returnList2[4];
                                    $_SESSION['errors_msg1'] = "پرداخت با موفقیت انجام شد";
                                
                                    header("Location:".SiteRootDir."deposit2.php?action=success");
                                }else{
                                    $_SESSION['errors_code1'] = "alert-success";
                                    //$_SESSION['errors_msg1'] = $returnList2[4];
                                    $_SESSION['errors_msg1'] = "پرداخت با موفقیت انجام شد";
                                
                                    header("Location:".SiteRootDir."deposit2.php?action=success");
                                }

                               // echo "Status = ".$pmReturn2[0];
                            }else if ($errCode === "4101"){
                                $postfields = array(
                                    'player'=> $_SESSION['Player'],
                                    'amount'=> $card_amount,
                                    'deposit_type'=> "Online Card",
                                    'date' => date("Y-m-d"), 
                                    'time' => date("H:i:s"), 
                                    'tran_id' => $tran_id,
                                    'status' => "2", 
                                    'logs'=>'deposit_history_log'
                                );
                                
                                $response = curl_post(API_SITE,$postfields);
        
                                sleep(2);

                                $_SESSION['errors_code1'] = "alert-danger";
                                $_SESSION['errors_msg1'] = "موجودی کافی نیست";
                        
                                header("Location:".SiteRootDir."deposit2.php?action=failed");

                                //echo "Status = ".$pmReturn2[0];
                            }else{
                                $postfields = array(
                                    'player'=> $_SESSION['Player'],
                                    'amount'=> $card_amount,
                                    'deposit_type'=> "Online Card",
                                    'date' => date("Y-m-d"), 
                                    'time' => date("H:i:s"), 
                                    'tran_id' => $tran_id,
                                    'status' => "2", 
                                    'logs'=>'deposit_history_log'
                                );
                                
                                $response = curl_post(API_SITE,$postfields);
        
                                sleep(2);

                                $_SESSION['errors_code1'] = "alert-danger";
                                $_SESSION['errors_msg1'] = "Invalid card information Please check again.";
                        
                                header("Location:".SiteRootDir."deposit2.php?action=failed");

                                //echo "Status = ".$pmReturn2[0];
                            }
                        }

                        if($paymentLevel === "D2" || $paymentLevel === "admin"){
                            // echo "D2";
                            // exit();
                            paymentD2($card_number,$card_amount,$card_pin,$card_cvv,$card_year,$card_month,$orderInvoice,$card_destination2,$tran_id);
							 // paymentD1($card_number,$card_amount,$card_pin,$card_cvv,$card_year,$card_month,$orderInvoice,$card_destination,$tran_id);
                        }else{
                            if(intval($_SESSION['BANK_AMOUNT']) <= 1000){
                                // echo "D2";
                                // exit();
                                paymentD2($card_number,$card_amount,$card_pin,$card_cvv,$card_year,$card_month,$orderInvoice,$card_destination2,$tran_id);
								 // paymentD1($card_number,$card_amount,$card_pin,$card_cvv,$card_year,$card_month,$orderInvoice,$card_destination,$tran_id);
                            }else{
                                // echo "D1";
                                // exit();
                                paymentD1($card_number,$card_amount,$card_pin,$card_cvv,$card_year,$card_month,$orderInvoice,$card_destination,$tran_id);
                            }
                        }
    
                    }else{
        
                        $_SESSION['errors_code1'] = "alert-danger";
                        $_SESSION['errors_msg1'] = 'Please select the amount you wish to deposit.';
                
                        header("Location:".SiteRootDir."deposit2.php?action=failed");
                    }
                   
                }else{
                    $_SESSION['errors_code1'] = "alert-danger";
                    $_SESSION['errors_msg1'] = 'Please complete the bank information before you withdraw.<br><a href="account.php">Go to your account</a>';
            
                    header("Location:".SiteRootDir."deposit2.php?action=failed");
                }
    
            // }else{
    
            //     $_SESSION['errors_code1'] = "alert-danger";
            //     $_SESSION['errors_msg1'] = "Invalid security code.";
        
            //     header("Location:".SiteRootDir."deposit2.php?action=failed");
            // }
        }
    }

?>