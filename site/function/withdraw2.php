<?php
include_once "app_top.php";

$csrf = new csrf();

// Generate Token Id and Valid
$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);
if ($csrf->check_valid('post')) {
    if ($_POST) {

        $pkamount = $db->CleanDBData($_POST['amount']);

        $callBackW = "withdraw2.php";

        $sql = "SELECT * FROM user_profile WHERE Player = ?";
        $values = array($_SESSION['Player']);
        $RecData = $model->doSelect($sql, $values);

        if ($pkamount <= $RecData[0]['CBalance']) {

            $sqli = "insert into withdraw_history (player,amount,evoucher,activation_code,evoucher_amount,date,time,withdraw_type,status,auto_withdraw) values (?,?,?,?,?,?,?,?,?,?)";
            $values = array($_SESSION['Player'], $pkamount, '', '', '', date("Y-m-d"), date("H:i:s"), '2', '0', '0');
            $model->doinsert($sqli, $values);

            //Updated CBalance
            $CBalance = $RecData[0]['CBalance'] - $pkamount;
            $sqlu = "update user_profile set CBalance=? where Player=?";
            $values = array($CBalance, $_SESSION['Player']);
            $model->doUpdate($sqlu, $values);

            $_SESSION['errors_code'] = "alert-success";
            $_SESSION['errors_msg'] = "Your withdrawal is being processed.";
            header("Location:" . SiteRootDir . "" . $callBackW . "?action=success");

        } else {
            $_SESSION['errors_code'] = "alert-danger";
            $_SESSION['errors_msg'] = TITLE_WITHDRAW_FUN1;
            header("Location:" . SiteRootDir . "" . $callBackW . "?action=failed");
        }
    }
}
