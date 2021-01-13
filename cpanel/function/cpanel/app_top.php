<?php
    session_start();
    date_default_timezone_set("Asia/Tehran");
    include_once("../../_inc/config.php"); 
    include_once("../../_inc/model.php"); 
    include_once("../../function/poker_api.php");
    include_once("../../function/csrf.class.php");

    if(!isset($_SESSION['PlayerAdmin']) && !isset($_SESSION['PlayerAdmin_PW'])){
        header("Location:login.php");
    }

    $csrf = new csrf();
    $model = new Model();
?>