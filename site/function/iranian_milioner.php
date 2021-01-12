<?php

    include_once("app_top.php");
    include_once("poker_api.php");


    if($csrf->check_valid('post')) {
        
        if($_POST){
            // if($_SESSION['security_code'] === $_POST['captcha_accounts_banks']) { // Check 
            $game_close = explode(" ",$configDT[0]['game_close']);
            $game_close = explode("/",$game_close[0]);
            $around = $game_close[2]."-".$game_close[0]."-".$game_close[1];

        
            if(intval($_SESSION['Player_DBalance']) >= intval($_POST['totalPrice'])){

                function checkL($numB){
                    if(strlen($numB) <= 1){
                        return sprintf('%02d', $numB);
                    }else{
                        return $numB;
                    }
                }
                
                if($db->CleanDBData($_POST['number1'][0]) != ""){

                    $ballNumber = checkL($_POST['number1'][0])."-".checkL($_POST['number2'][0])."-".checkL($_POST['number3'][0])."-".checkL($_POST['number4'][0])."-".checkL($_POST['number5'][0]);
                    $luckyNumber = checkL($_POST['number6'][0])."-".checkL($_POST['number7'][0]);

                    $insert_arrays = array(
                        'player'=> $_SESSION['Player'],
                        'ball_numbers'=> $ballNumber,
                        'lucky_stars'=> $luckyNumber,
                        'date'=> date("Y-m-d"),
                        'time'=> date("H:i:s"),
                        'status'=> 1,
                        'around'=> $around,
                    );
                                        
                    //if ran successfully it will reture last insert id, else 0 for error
                    $q  = $db->insert('iranian_milioner_play',$insert_arrays);

  
                }

                if($db->CleanDBData($_POST['number1'][1]) != ""){
                    $ballNumber = checkL($_POST['number1'][1])."-".checkL($_POST['number2'][1])."-".checkL($_POST['number3'][1])."-".checkL($_POST['number4'][1])."-".checkL($_POST['number5'][1]);
                    $luckyNumber = checkL($_POST['number6'][1])."-".checkL($_POST['number7'][1]);

                    $insert_arrays = array(
                        'player'=> $_SESSION['Player'],
                        'ball_numbers'=> $ballNumber,
                        'lucky_stars'=> $luckyNumber,
                        'date'=> date("Y-m-d"),
                        'time'=> date("H:i:s"),
                        'status'=> 1,
                        'around'=> $around,
                    );
                                        
                    //if ran successfully it will reture last insert id, else 0 for error
                    $q  = $db->insert('iranian_milioner_play',$insert_arrays);


                }

                if($db->CleanDBData($_POST['number1'][2]) != ""){
                    $ballNumber = checkL($_POST['number1'][2])."-".checkL($_POST['number2'][2])."-".checkL($_POST['number3'][2])."-".checkL($_POST['number4'][2])."-".checkL($_POST['number5'][2]);
                    $luckyNumber = checkL($_POST['number6'][2])."-".checkL($_POST['number7'][2]);

                    $insert_arrays = array(
                        'player'=> $_SESSION['Player'],
                        'ball_numbers'=> $ballNumber,
                        'lucky_stars'=> $luckyNumber,
                        'date'=> date("Y-m-d"),
                        'time'=> date("H:i:s"),
                        'status'=> 1,
                        'around'=> $around,
                    );
                                        
                    //if ran successfully it will reture last insert id, else 0 for error
                    $q  = $db->insert('iranian_milioner_play',$insert_arrays);

                    
                }

                if($db->CleanDBData($_POST['number1'][3]) != ""){
                    $ballNumber = checkL($_POST['number1'][3])."-".checkL($_POST['number2'][3])."-".checkL($_POST['number3'][3])."-".checkL($_POST['number4'][3])."-".checkL($_POST['number5'][3]);
                    $luckyNumber = checkL($_POST['number6'][3])."-".checkL($_POST['number7'][3]);

                    $insert_arrays = array(
                        'player'=> $_SESSION['Player'],
                        'ball_numbers'=> $ballNumber,
                        'lucky_stars'=> $luckyNumber,
                        'date'=> date("Y-m-d"),
                        'time'=> date("H:i:s"),
                        'status'=> 1,
                        'around'=> $around,
                    );
                                        
                    //if ran successfully it will reture last insert id, else 0 for error
                    $q  = $db->insert('iranian_milioner_play',$insert_arrays);

                }

                $updateBalance = $_SESSION['Player_DBalance']-$_POST['totalPrice'];

                $array_fields = array(
                    'Balance' => $updateBalance,
                );
                
                $array_where = array(    
                    'Player' => $_SESSION['Player'],
                );
            
                $q = $db->Update('user_profile', $array_fields, $array_where);

                $_SESSION['errors_code1'] = "alert-success";
                $_SESSION['errors_msg1'] = "You have played Iranian Milioner with us.<br>
                Wish you good luck with your number";

                header("Location:".SiteRootDir."iranian_milioner.php?action=success");   

            }else{

                $_SESSION['errors_code1'] = "alert-danger";
                $_SESSION['errors_msg1'] = "Your credit is not enough. Please add credit.";
        
                header("Location:".SiteRootDir."iranian_milioner.php?action=failed");
            }
    
            /*}else{
                $_SESSION['errors_code'] = "150";
                $_SESSION['errors_msg'] = "با عرض پوزش کد امنیتی وارد شده صحیح نمی باشد.";
    
                header("Location:".SiteRootDir."bank_info.php?action=failed");     
            }*/
        }
    }

?>