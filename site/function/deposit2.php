<?php

include_once "app_top.php";
include_once "poker_config.php";
include_once "poker_api.php";

// Generate Token Id and Valid
$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);

if ($csrf->check_valid('post')) {
    if ($_POST) {

        $amount = $db->CleanDBData($_POST['amount']);

        $_SESSION['errors_code'] = "alert-danger";
        $_SESSION['errors_msg'] = "Wrong amount";

        header("Location:../deposit2.php?action=failed");

    }
}
