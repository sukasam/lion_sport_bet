<?php

include_once("app_top.php");

$csrf = new csrf();

// Generate Token Id and Valid
$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);
if ($csrf->check_valid('post')) {

    if ($_POST) {

        $pm_account = $db->CleanDBData($_POST['pm_account']);

        $sql = "SELECT * FROM pm_info WHERE player = ?";
        $values = array($_SESSION['Player']);
        $RecData = $model->doSelect($sql, $values);
        if (empty($RecData[0]['player'])) {
            $sqli = "insert into pm_info (player,pm_account,date,time,action) values (?,?,?,?,?)";
            $values = array($_SESSION['Player'], $pm_account, date("Y-m-d"), date("H:i:s"), 'Enable');
            $model->doinsert($sqli, $values);
        } else {
            $sqlu = "update pm_info set pm_account=? where player=?";
            $values = array($pm_account, $_SESSION['Player']);
            $model->doUpdate($sqlu, $values);
        }

        $_SESSION['errors_code1'] = "alert-success";
        $_SESSION['errors_msg1'] = "Updated Perfect Money account information.";

        header("Location:" . SiteRootDir . "account.php?action=success");

    }
}
