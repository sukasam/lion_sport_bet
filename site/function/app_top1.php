<?php

    session_start();

    include_once('../_inc/config.php'); 
    include_once("poker_api.php");
    include_once('csrf.class.php'); 

    if(!isset($_SESSION['Player']) && !isset($_SESSION['Player_PW'])){
        header("Location:".SiteRootDir."login.php");
    }

    
    if($_GET['lang'] == "en"){
        $_SESSION['Player_Lang'] = "en";
        header("Location:".SiteRootDir."index.php");
    }else if($_GET['lang'] == "ir"){
        $_SESSION['Player_Lang'] = "ir";
        header("Location:".SiteRootDir."index.php");
    }

    if($_SESSION['Player_Lang'] == "en"){
        include_once("function/lang_en.php");
    }else{
        include_once("function/lang_ir.php");
    }


     $csrf = new csrf();
 
    // // Generate Token Id and Valid
    $token_id = $csrf->get_token_id();
    $token_value = $csrf->get_token($token_id);

    $paramsCheck = array("Command"  => "AccountsGet",
    "Player" => $_SESSION['Player']
    );

    $apiUserNote = Poker_API($paramsCheck);
    // if($apiUserNote->Note == ""){
    //     $pageCur = explode('.php',$_SERVER['REQUEST_URI']);
    //     $pageCur = preg_replace('/\//', '', $pageCur[0]);
    //     $checkPage = $pageCur.".php";
    //     if($checkPage != "set_pin.php"){
    //         header("Location:set_pin.php");
    //     }
    // }  
    

    $configDT = $db->select("SELECT * FROM setting WHERE sid ='1' ORDER BY sid DESC"); 

    if($configDT[0]['maintenance'] == 1){
        session_destroy();
        header("Location:".SiteRootDir."maintenance/");
    }

    
    // $RecDataUserBank = $db->select("SELECT * FROM bank_info WHERE player = '".$_SESSION['Player']."'");
    // if($RecDataUserBank[0]['id'] === "" || $RecDataUserBank[0]['bank_card'] === ""){
    //     $pageCur = explode('.php',$_SERVER['REQUEST_URI']);
    //     $pageCur = preg_replace('/\//', '', $pageCur[0]);
    //     $checkPage = $pageCur.".php";
    //     if($checkPage != "account.php"){
    //         header("Location:account.php");
    //     }
    // }

    $RecDataUserBlock = $db->select("SELECT * FROM user_block WHERE Player = '".$_SESSION['Player']."'");
    if($RecDataUserBlock[0]['block'] == 1){
        $pageCur = explode('.php',$_SERVER['REQUEST_URI']);
        $pageCur = preg_replace('/\//', '', $pageCur[0]);
        $checkPage = $pageCur.".php";
        if($checkPage != "block.php"){
            header("Location:block.php");
        }
    }

    // $RecDataUserCheck = $db->select("SELECT * FROM user_pin WHERE Player = '".$_SESSION['Player']."'");
    // if($RecDataUserCheck[0]['pin'] == ""){

    //     $pageCur = explode('.php',$_SERVER['REQUEST_URI']);
    //     $pageCur = preg_replace('/\//', '', $pageCur[0]);
    //     $checkPage = $pageCur.".php";
    //     if($checkPage != "set_pin.php"){
    //         header("Location:set_pin.php");
    //     }
    // }   

?>