<?php

session_start();

include_once '_inc/config.php';
include_once "_inc/model.php";
include_once 'function/csrf.class.php';
include_once 'function/function.php';
include_once 'function/poker_config.php';
include_once 'function/poker_api.php';

if (!isset($_SESSION['Player']) && !isset($_SESSION['Player_PW'])) {

    $checkMain = explode("?", substr($_SERVER['REQUEST_URI'], 1));
    if ($checkMain[0] !== "main.php" && $checkMain[0] !== "guide.php") {
        header("Location:" . SiteRootDir . "main.php");
    }
    if ($checkMain[0] === "guide.php") {
        $RecDataGuideCheck = $db->select("SELECT * FROM guide WHERE `status` = '0' ORDER BY id ASC");
        if (!isset($_GET['id'])) {
            header("Location:guide.php?id=" . $RecDataGuideCheck[0]['id']);
        }
    }
} else {

    if (isset($_GET['lang']) && $_GET['lang'] == "en") {
        $_SESSION['Player_Lang'] = "en";
        header("Location:" . SiteRootDir . "index.php");
    } else if (isset($_GET['lang']) && $_GET['lang'] == "ir") {
        $_SESSION['Player_Lang'] = "ir";
        header("Location:" . SiteRootDir . "index.php");
    }

    // if ($_SESSION['Player_Lang'] == "en") {
    //     include_once "function/lang_en.php";
    // } else {
    //     include_once "function/lang_ir.php";
    // }

    include_once "function/lang_ir.php";

    $csrf = new csrf();
    $model = new Model();

    // $sql="SELECT * FROM bank_info WHERE player = ? ORDER BY id DESC";
    // $values=array($_SESSION['Player']);
    // $RecData = $model->doSelect($sql,$values);

    // Generate Token Id and Valid
    $token_id = $csrf->get_token_id();
    $token_value = $csrf->get_token($token_id);

    $configDTSQL = "SELECT * FROM setting WHERE sid = ? ORDER BY sid DESC";
    $values = array('1');
    $configDT = $model->doSelect($configDTSQL, $values);

    // echo "<pre>";
    // var_dump($configDT);
    // echo "</pre>";

    if ($configDT[0]['maintenance'] == 1) {
        session_destroy();
        header("Location:" . SiteRootDir . "maintenance");
    }

    $RecDataUserProfileSQL = "SELECT * FROM user_profile WHERE Player = ?";
    $values = array($_SESSION['Player']);
    $RecDataUserProfile = $model->doSelect($RecDataUserProfileSQL, $values);

    // $RecDataUserBankSQL = "SELECT * FROM bank_info WHERE Player = ?";
    // $values=array($_SESSION['Player']);
    // $RecDataUserBank = $model->doSelect($RecDataUserBankSQL,$values);

    // if($RecDataUserProfile[0]['RealName'] == "" || $RecDataUserProfile[0]['RealName'] === NULL){

    //     $update_arrays = array(
    //         'uactive'=> "1",
    //     );
    //     $where_arrays = array(
    //         'Player' => $_SESSION['Player'],
    //     );
    //     //if ran successfully it will reture last insert id, else 0 for error
    //     $qUactive  = $db->Update('user_profile',$update_arrays,$where_arrays);

    //     $pageCur = explode('.php',$_SERVER['REQUEST_URI']);
    //     $pageCur = preg_replace('/\//', '', $pageCur[0]);
    //     $checkPage = $pageCur.".php";
    //     if($checkPage != "account.php"){
    //         header("Location:".SiteRootDir."account.php");
    //     }
    // }else if($RecDataUserBank[0]['id'] == ""){

    //         $update_arrays = array(
    //             'uactive'=> "1",
    //         );
    //         $where_arrays = array(
    //             'Player' => $_SESSION['Player'],
    //         );
    //         //if ran successfully it will reture last insert id, else 0 for error
    //         $qUactive  = $db->Update('user_profile',$update_arrays,$where_arrays);
    //         $pageCur = explode('.php',$_SERVER['REQUEST_URI']);
    //         $pageCur = preg_replace('/\//', '', $pageCur[0]);
    //         $checkPage = $pageCur.".php";
    //         if($checkPage != "account.php"){
    //             header("Location:".SiteRootDir."account.php");
    //         }

    // }else if($RecDataUserProfile[0]['onlineCard'] == "0"){

    //     $update_arrays = array(
    //         'uactive'=> "1",
    //     );
    //     $where_arrays = array(
    //         'Player' => $_SESSION['Player'],
    //     );
    //     //if ran successfully it will reture last insert id, else 0 for error
    //     $qUactive  = $db->Update('user_profile',$update_arrays,$where_arrays);

    //     $pageCur = explode('.php',$_SERVER['REQUEST_URI']);
    //     $pageCur = preg_replace('/\//', '', $pageCur[0]);
    //     $checkPage = $pageCur.".php";
    //     if($checkPage != "tickets.php"){
    //         header("Location:".SiteRootDir."tickets.php");
    //     }

    // }else{
    //     if($RecDataUserProfile[0]['uactive'] === "1" || $RecDataUserProfile[0]['uactive'] == 1){
    //         $pageCur = explode('.php',$_SERVER['REQUEST_URI']);
    //         $pageCur = preg_replace('/\//', '', $pageCur[0]);
    //         $checkPage = $pageCur.".php";
    //         if($checkPage != "tickets.php"){
    //             header("Location:".SiteRootDir."tickets.php");
    //         }
    //     }
    // }

    $RecDataUserBlockSQL = "SELECT * FROM user_block WHERE Player = ?";
    $values = array($_SESSION['Player']);
    $RecDataUserBlock = $model->doSelect($RecDataUserBlockSQL, $values);

    if (!empty($RecDataUserBlock[0]['block']) && $RecDataUserBlock[0]['block'] == 1) {
        $pageCur = explode('.php', $_SERVER['REQUEST_URI']);
        $pageCur = preg_replace('/\//', '', $pageCur[0]);
        $checkPage = $pageCur . ".php";
        if ($checkPage != "block.php") {
            header("Location:" . SiteRootDir . "block.php");
        }
    }
}
