<?php

    include_once("app_top.php");
    include_once("poker_api.php");


    if($csrf->check_valid('post')) {
        
        if($_POST){
            // if($_SESSION['security_code'] === $_POST['captcha_accounts_banks']) { // Check 

            $game_close = date_create($configDT[0]['lotorry_close']);
            $around = date_format($game_close,"Y-m-d");

            $RecDataDrawHistory2 = $db->select("SELECT * FROM bet_lotorry_history WHERE bet_lotorry_date = '".$around."'");
            $RecDataDrawResults2 = $db->select("SELECT * FROM bet_lotorry_results WHERE id = '".$RecDataDrawHistory2[0]['id']."'");
            
            if(intval($_SESSION['Player_DBalance']) >= intval($configDT[0]['lotorry_per_play'])){
                
                $insert_arrays = array(
                    'player'=> $_SESSION['Player'],
                    'jackpot'=> $configDT[0]['lotorry_per_jackpot'],
                    'date'=> date("Y-m-d"),
                    'time'=> date("H:i:s"),
                    'status'=> 1,
                    'around'=> $around,
                );
                                    
                //if ran successfully it will reture last insert id, else 0 for error
                $qNum  = $db->insert('bet_lotorry_play',$insert_arrays);

                foreach ($RecDataDrawResults2 as $key => $vals) { 
                   // $_POST['betresults'][$key];
                   $insert_arrays = array(
                    'id'=> $qNum, 
                    'home'=> $vals['home'], 
                    'results'=> $_POST['betresults'][$key], 
                    'away'=> $vals['away'], 
                  );
                
                  $q = $db->insert('bet_lotorry_play_results', $insert_arrays);
                }

                $updateBalance = $_SESSION['Player_DBalance']-$configDT[0]['lotorry_per_play'];

                $array_fields = array(
                    'Balance' => $updateBalance,
                );
                
                $array_where = array(    
                    'Player' => $_SESSION['Player'],
                );
            
                $q = $db->Update('user_profile', $array_fields, $array_where);

                $_SESSION['errors_code1'] = "alert-success";
                $_SESSION['errors_msg1'] = "You have played bet Lotorry with us.<br>
                Wish you good luck with your teams";

                header("Location:".SiteRootDir."bet_lotorry.php?action=success");   

            }else{

                $_SESSION['errors_code1'] = "alert-danger";
                $_SESSION['errors_msg1'] = "Your credit is not enough. Please add credit.";
        
                header("Location:".SiteRootDir."bet_lotorry.php?action=failed");
            }
    
            /*}else{
                $_SESSION['errors_code'] = "150";
                $_SESSION['errors_msg'] = "با عرض پوزش کد امنیتی وارد شده صحیح نمی باشد.";
    
                header("Location:".SiteRootDir."bank_info.php?action=failed");     
            }*/
        }
    }

?>