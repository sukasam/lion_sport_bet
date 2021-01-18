<?php

include_once "app_top.php";
include_once "poker_config.php";
include_once "poker_api.php";

// Generate Token Id and Valid
$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);

if ($csrf->check_valid('post')) {
    if ($_POST) {

        if ($_SESSION['security_code'] === $db->CleanDBData($_POST['deposit_captcha_code'])) { // Check

            $e_voucher = $db->CleanDBData($_POST['e_voucher']);
            $activation_code = $db->CleanDBData($_POST['activation_code']);

            $dateLog = date("Y-m-d");
            $timeLog = date("H:i:s");

            $sqli = "insert into deposit_history (player,amountU,amountT,deposit_type,date,time,tran_id,currency,status) values (?,?,?,?,?,?,?,?,?)";
            $values = array($_SESSION['Player'], '0', '0', "PM", $dateLog, $timeLog, '', $configDT[0]['currency'], "0");
            $insertID = $model->doinsert($sqli, $values);

            $postfields = array(
                'AccountID' => PERFECT_ACCOUNTID,
                'PassPhrase' => PERFECT_PASSPHRASE,
                'Payee_Account' => PERFECT_PAYEE_ACCOUNT,
                'ev_number' => $e_voucher,
                'ev_code' => $activation_code,
            );

            $response = curl_post_outsite("https://perfectmoney.is/acct/ev_activate.asp", $postfields);

            // searching for hidden fields
            if (!preg_match_all("/<input name='(.*)' type='hidden' value='(.*)'>/", $response, $result, PREG_SET_ORDER)) {
                echo 'Ivalid output';
                exit;
            }

            $ar = array();
            foreach ($result as $item) {
                $key = $item[1];
                $ar[$key] = $item[2];
            }

            if (empty($ar['ERROR'])) {

                $sqli = "insert into deposit_evoucher (player,VOUCHER_NUM,VOUCHER_ACTIVE,VOUCHER_AMOUNT,VOUCHER_AMOUNT_CURRENCY,Payee_Account,PAYMENT_BATCH_NUM,date,time) values (?,?,?,?,?,?,?,?,?)";
                $values = array($_SESSION['Player'], $ar['VOUCHER_NUM'], $activation_code, $ar['VOUCHER_AMOUNT'], $ar['VOUCHER_AMOUNT_CURRENCY'], $ar['Payee_Account'], $ar['PAYMENT_BATCH_NUM'], $dateLog, $timeLog);
                $model->doinsert($sqli, $values);

                $amountT = ($ar['VOUCHER_AMOUNT'] * $configDT[0]['currency']);

                $sqlu = "update deposit_history set amountU=?,amountT=?, status=?, tran_id=? where id=?";
                $values = array($ar['VOUCHER_AMOUNT'], $amountT, "1", $ar['PAYMENT_BATCH_NUM'], $insertID);
                $model->doUpdate($sqlu, $values);

                $sqlST = "SELECT * FROM setting WHERE `sid` = ?";
                $valuesST = array('1');
                $RecDataST = $model->doSelect($sqlST, $valuesST);

                $sqlProfileSQL = "SELECT * FROM user_profile WHERE `Player` = ?";
                $valuesST2 = array($_SESSION['Player']);
                $RecProfileC = $model->doSelect($sqlProfileSQL, $valuesST2);

                $totalConvert = round($ar['VOUCHER_AMOUNT'] * $RecDataST[0]['currency'], 2) + $RecProfileC[0]['DBalance'];

                $UBalanceSQL = "update user_profile set DBalance=? where Player=?";
                $valuesBL = array($totalConvert, $_SESSION['Player']);
                $model->doUpdate($UBalanceSQL, $valuesBL);

                $_SESSION['errors_code'] = "alert-success";
                $_SESSION['errors_msg'] = "E-voucher # " . $ar['VOUCHER_NUM'] . ".<br>Your account has been successfully deposited.";

                header("Location:../deposit.php?action=success");
            } else {

                $sqlu = "update deposit_history set status=?, tran_id=? where id=?";
                $values = array("2", $ar['PAYMENT_BATCH_NUM'],$insertID);
                $model->doUpdate($sqlu, $values);

                $_SESSION['errors_code'] = "alert-danger";
                $_SESSION['errors_msg'] = $ar['ERROR'];

                header("Location:../deposit.php?action=failed");
            }
        } else {
            $_SESSION['errors_code'] = "alert-danger";
            $_SESSION['errors_msg'] = "Invalid security code.";

            header("Location:../deposit.php?action=failed");
        }
    }
}
