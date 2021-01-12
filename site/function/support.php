<?php

include_once "app_top.php";

$csrf = new csrf();

// Generate Token Id and Valid
$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);
if ($csrf->check_valid('post')) {

    if ($_POST) {

        $s_message = nl2br($db->CleanDBData($_POST['s_message']));

        $sqli = "insert into support (player,s_message,date,time,s_action) values (?,?,?,?,?)";
        $values = array($_SESSION['Player'], $s_message, date("Y-m-d"), date("H:i:s"), 'user');
        $model->doinsert($sqli, $values);

        $_SESSION['errors_code'] = "alert-success";
        $_SESSION['errors_msg'] = "Your message has been sent.";

        header("Location:" . SiteRootDir . "support.php?action=success");

    }
}
