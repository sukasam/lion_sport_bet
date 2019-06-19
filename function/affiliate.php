<?php

    include_once("function/poker_api.php");

    $userRefer = decode($_GET['affiliate'],KEY_HASH);

    $_SESSION['affiliate'] = $userRefer;
?>