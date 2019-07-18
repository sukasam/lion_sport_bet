<?php

    include_once("app_top.php");

    $csrf = new csrf();
 
    // Generate Token Id and Valid
    $token_id = $csrf->get_token_id();
    $token_value = $csrf->get_token($token_id);
    if($csrf->check_valid('post')) {
        if($_POST){

            $Player = $_SESSION['Player'];
            
            
            if($_GET['ref'] == "1"){
                
                $point = preg_replace('/\//'(',', '', $db->CleanDBData($_POST["point_tophand"]));
    
                $postfields = array(
                    'player'=> $Player,
                    'point' => $point, 
                    'point_type' => "top_hand", 
                    'date' => $db->CleanDBData($_POST['dateC']), 
                    'time' =>  $db->CleanDBData($_POST['timeC']), 
                    'logs'=>'point_log'
                );
                
                $response = curl_post(API_SITE,$postfields);
    
                $postfields1 = array(
                    'player'=> $Player,
                    'point' => $point, 
                    'point_type' => "top_hand", 
                    'date' => $db->CleanDBData($_POST['dateC']), 
                    'time' =>  $db->CleanDBData($_POST['timeC']), 
                    'logs'=>'checkPoint'
                );
    
                $responseP = curl_post(API_SITE,$postfields1);
    
                if($responseP == "1"){
    
                    $params = array("Command"  => "AccountsIncBalance",
                    "Player"   => $Player,
                    "Amount"   => $point);
                    $api = Poker_API($params);
                    
                    if ($api -> Result == "Ok"){
                        
    
                        $_SESSION['errors_code2'] = "alert-success";
                        $_SESSION['errors_msg2'] = "Your point (Top Hand) has been exchange to balance.";
                
                        header("Location:".SiteRootDir."account.php?action=success");
    
                        
                    }else{
                        $_SESSION['errors_code2'] = "alert-danger";
                        $_SESSION['errors_msg2'] = $api -> Error;
                
                        header("Location:".SiteRootDir."account.php?action=failed");
                    }
    
                }else{
                    $_SESSION['errors_code2'] = "alert-success";
                    $_SESSION['errors_msg2'] = "Your point (Top Hand) has been exchange to balance.";
            
                    header("Location:".SiteRootDir."account.php?action=success");
                }
    
            }else if($_GET['ref'] == "2"){
    
                $point = preg_replace('/\//'(',', '', $db->CleanDBData($_POST["point_topwin"]));
    
                $postfields = array(
                    'player'=> $Player,
                    'point' => $point, 
                    'point_type' => "top_win", 
                    'date' => $db->CleanDBData($_POST['dateC']), 
                    'time' =>  $db->CleanDBData($_POST['timeC']), 
                    'logs'=>'point_log'
                );
                
                $response = curl_post(API_SITE,$postfields);
    
                $postfields1 = array(
                    'player'=> $Player,
                    'point' => $point, 
                    'point_type' => "top_win", 
                    'date' => $db->CleanDBData($_POST['dateC']), 
                    'time' =>  $db->CleanDBData($_POST['timeC']), 
                    'logs'=>'checkPoint'
                );
    
                $responseP = curl_post(API_SITE,$postfields1);
    
                if($responseP == "1"){
    
                    $params = array( 
                        "Command"  => "AccountsEdit",
                        "Player"   => $Player,
                        "PRake"    => "0"
                    );
    
                    $api = Poker_API($params);
                    
                    if ($api -> Result == "Ok"){
    
                        $params2 = array("Command"  => "AccountsIncBalance",
                        "Player"   => $Player,
                        "Amount"   => $point);
                        $api2 = Poker_API($params2);
                        
                        if ($api2 -> Result == "Ok"){
    
                            $_SESSION['errors_code2'] = "alert-success";
                            $_SESSION['errors_msg2'] = "Your point (Top Win) has been exchange to balance.";
                    
                            header("Location:".SiteRootDir."account.php?action=success");
    
                        }else{
    
                            $_SESSION['errors_code2'] = "alert-danger";
                            $_SESSION['errors_msg2'] = $api -> Error;
                    
                            header("Location:".SiteRootDir."account.php?action=failed");
                        }
                        
                    }else{
                        $_SESSION['errors_code2'] = "alert-danger";
                        $_SESSION['errors_msg2'] = $api -> Error;
                
                        header("Location:".SiteRootDir."account.php?action=failed");
                    }
                }else{
                    $_SESSION['errors_code2'] = "alert-success";
                    $_SESSION['errors_msg2'] = "Your point (Top Win) has been exchange to balance.";
            
                    header("Location:".SiteRootDir."account.php?action=success");
                }
    
            }else if($_GET['ref'] == "3"){
    
                $point = preg_replace('/\//'(',', '', $db->CleanDBData($_POST["point_toplost"]));
    
                $postfields = array(
                    'player'=> $Player,
                    'point' => $point, 
                    'point_type' => "top_lost", 
                    'date' => $db->CleanDBData($_POST['dateC']), 
                    'time' =>  $db->CleanDBData($_POST['timeC']), 
                    'logs'=>'point_log'
                );
                
                $response = curl_post(API_SITE,$postfields);
    
                $postfields1 = array(
                    'player'=> $Player,
                    'point' => $point, 
                    'point_type' => "top_lost", 
                    'date' => $db->CleanDBData($_POST['dateC']), 
                    'time' =>  $db->CleanDBData($_POST['timeC']), 
                    'logs'=>'checkPoint'
                );
    
                $responseP = curl_post(API_SITE,$postfields1);
    
                if($responseP == "1"){
    
                    $params = array("Command"  => "AccountsIncBalance",
                    "Player"   => $Player,
                    "Amount"   => $point);
                    $api = Poker_API($params);
                    
                    if ($api -> Result == "Ok"){
    
                        $_SESSION['errors_code2'] = "alert-success";
                        $_SESSION['errors_msg2'] = "Your point (Bad Bit) has been exchange to balance.";
                
                        header("Location:".SiteRootDir."account.php?action=success");
                        
                    }else{
                        $_SESSION['errors_code2'] = "alert-danger";
                        $_SESSION['errors_msg2'] = $api -> Error;
                
                        header("Location:".SiteRootDir."account.php?action=failed");
                    }
                }else{
                    $_SESSION['errors_code2'] = "alert-success";
                    $_SESSION['errors_msg2'] = "Your point (Bad Bit) has been exchange to balance.";
            
                    header("Location:".SiteRootDir."account.php?action=success");
                }
                
            }else{
    
                $_SESSION['errors_code2'] = "alert-danger";
                $_SESSION['errors_msg2'] = "There are some errors. Please try again.";
        
                header("Location:".SiteRootDir."account.php?action=failed");
            }
        }      
    }

?>