<?php
    include_once("app_top.php");
    include_once("poker_api.php");

    $csrf = new csrf();

    // Generate Token Id and Valid
    $token_id = $csrf->get_token_id();
    $token_value = $csrf->get_token($token_id);
    if($csrf->check_valid('post')) {
        if($_POST){
            //if($_SESSION['security_code'] === $db->CleanDBData($_POST['tickets_captcha_code'])) { // Check 
            
                $tkid = 'TK'.date('ymdHis').sprintf("%02d", mt_rand(1, 99));
            
                $postfields = array(
                    'tkid'=> $tkid, 
                    'player'=> $_SESSION['Player'], 
                    'subject'=> addslashes($db->CleanDBData($_POST['tickets_subject'])),
                    'detail'=> addslashes($db->CleanDBData($_POST['tickets_description'])),
                    'date'=> date("Y-m-d"),
                    'time'=> date("H:i:s"),
                    'action'=>'0',
                    'logs'=>'tickers_log'
                );
                $response = curl_post(API_SITE,$postfields);
            
                $_SESSION['errors_code'] = "200";
                $_SESSION['errors_msg'] = "Created tickets.";
            
                header("Location:../tickets.php?action=success");
            
            /*}else{
                $_SESSION['errors_code'] = "150";
                $_SESSION['errors_msg'] = "با عرض پوزش کد امنیتی وارد شده صحیح نمی باشد.";
            }*/
                }
            
                if($_POST){
                    $postfields = array(
                        'tid'=> $db->CleanDBData($_POST['tid']), 
                        'player'=> $_SESSION['Player'],
                        'detail'=> addslashes($db->CleanDBData($_POST['tickets_description'])),
                        'date'=> date("Y-m-d"),
                        'time'=> date("H:i:s"),
                        'action'=> "0",
                        'logs'=>'tickets_detail'
                    );
            
                   $response = curl_post(API_SITE,$postfields);
                
                    $_SESSION['errors_code'] = "alert-success";
                    $_SESSION['errors_msg'] = "Ticket details are already saved.";
                
                    header("Location:../tickets_detail.php?id=".$db->CleanDBData($_POST['tid'])."&action=success");   
                }
    }

?>