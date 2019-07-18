<?php

    include_once("app_top.php");
    include_once("poker_api.php");

    $csrf = new csrf();
 
    // Generate Token Id and Valid
    $token_id = $csrf->get_token_id();
    $token_value = $csrf->get_token($token_id);
    if($csrf->check_valid('post')) {
        
        if($_POST){
            // if($_SESSION['security_code'] === $_POST['captcha_accounts_banks']) { // Check 
    
                $cardNumber = array("58598","61043","60379","58921","62738","60376","627412", "627381", "505785", "622106","639194","627884","639347","502229","636214","627353","502908","627648","207177","636949","502938","589463","621986","589210","502806","502910","502238","505416","505801","603769","603770","603799","606373","610433","639607","639346");
    
                $account_bank_name = $db->CleanDBData($_POST['account_bank_name']);
                $account_bank_fullname = $db->CleanDBData($_POST['account_bank_fullname']);
                $account_bank_card = $db->CleanDBData($_POST['account_bank_card']);
                $account_bank_sheba = $db->CleanDBData($_POST['account_bank_sheba']);
    
                //if(in_array(substr($account_bank_card,0,6), $cardNumber)){
                    
                    if(strlen($account_bank_card) != 16){
    
                        $_SESSION['errors_code1'] = "alert-danger";
                        $_SESSION['errors_msg1'] = "Invalid card number.";
    
                        header("Location:".SiteRootDir."account.php?action=failed");   
    
                    }else if(strlen($account_bank_sheba) != 24){
    
                        $_SESSION['errors_code1'] = "alert-danger";
                        $_SESSION['errors_msg1'] = "Invalid sheba number.";
    
                        header("Location:".SiteRootDir."account.php?action=failed");   
    
                    }else{

                        $RecData = $db->select("SELECT * FROM bank_info WHERE player = '".$db->CleanDBData($_SESSION['Player'])."'");
                        
                        if($RecData[0]['player'] == ""){

                            $insert_arrays = array(
                                'player'=> $db->CleanDBData($_SESSION['Player']), 
                                'bank_name'=> $db->CleanDBData($account_bank_name),
                                'fullname'=> $db->CleanDBData($account_bank_fullname),
                                'bank_card'=> $db->CleanDBData($account_bank_card),
                                'bank_sheba'=> $db->CleanDBData($account_bank_sheba),
                                'date'=> $db->CleanDBData(date("Y-m-d")),
                                'time'=> $db->CleanDBData(date("H:i:s")),
                                'action'=> $db->CleanDBData('Enable'),
                            );
                            
                            $q  = $db->insert('bank_info',$insert_arrays);

                        }else{
                            $array_fields = array(
                                'bank_name'=> $db->CleanDBData($_POST['bank_name']),
                                'fullname'=>  $db->CleanDBData($_POST['fullname']),
                                'bank_card'=>  $db->CleanDBData($_POST['bank_card']),
                                'bank_sheba'=>  $db->CleanDBData($_POST['bank_sheba']),
                            );
                        
                            $array_where = array(    
                                'player' => $db->CleanDBData($_POST['player']),  
                            );
                            
                            $q = $db->Update('bank_info', $array_fields, $array_where);
                        }
    
                        $_SESSION['errors_code1'] = "alert-success";
                        $_SESSION['errors_msg1'] = "Updated bank information.";
    
                        header("Location:".SiteRootDir."account.php?action=success");   
    
                    }
                /* }else{
                    $_SESSION['errors_code1'] = "alert-danger";
                    $_SESSION['errors_msg1'] = "The specified bank information is invalid.";
    
                    header("Location:".SiteRootDir."account.php?action=failed");            
                }*/
    
            /*}else{
                $_SESSION['errors_code'] = "150";
                $_SESSION['errors_msg'] = "با عرض پوزش کد امنیتی وارد شده صحیح نمی باشد.";
    
                header("Location:".SiteRootDir."bank_info.php?action=failed");     
            }*/
        }
    }

?>