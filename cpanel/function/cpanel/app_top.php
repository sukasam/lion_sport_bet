<?php
    session_start();

    error_reporting(0);
    include_once("../../_inc/config.php"); 
    include_once("../../function/poker_api.php");

    if(!isset($_SESSION['PlayerAdmin']) && !isset($_SESSION['PlayerAdmin_PW'])){
        header("Location:login.php");
    }
?>