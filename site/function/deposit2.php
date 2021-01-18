<?php

include_once "app_top.php";
include_once "poker_config.php";
include_once "poker_api.php";
include_once "vendor/autoload.php";

use CoinbaseCommerce\ApiClient;
use CoinbaseCommerce\Resources\Charge;

// Generate Token Id and Valid
$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);

if ($csrf->check_valid('post')) {
    if ($_POST) {

        $amount = $db->CleanDBData($_POST['amount']);
        $dateLog = date("Y-m-d");
        $timeLog = date("H:i:s");

        if ($amount >= 1) {

            $sqlST = "SELECT * FROM setting WHERE `sid` = ?";
            $valuesST = array('1');
            $RecDataST = $model->doSelect($sqlST, $valuesST);

            $amountConv = round($amount / $RecDataST[0]['currency_cc'], 2);
            
            if ($amountConv >= 5) {

                $sqli = "insert into deposit_history (player,amountU,amountT,amountC,Bonus,deposit_type,date,time,tran_id,currency,status) values (?,?,?,?,?,?,?,?,?,?,?)";
                $values = array($_SESSION['Player'], $amountConv, $amount, '0', '0', "CC", $dateLog, $timeLog, '', $RecDataST[0]['currency_cc'], "0");
                $insertID = $model->doinsert($sqli, $values);

                $apiClientObj = ApiClient::init(COINBASE_API_KEY);

                $chargeData = [
                    'name' => "Player : " . $_SESSION['Player'],
                    'description' => 'Top up money to the digital wallet',
                    'local_price' => [
                        'amount' => $amountConv,
                        'currency' => 'USD',
                    ],
                    'pricing_type' => 'fixed_price',
                    'metadata' => [
                        'customer_id' => $_SESSION['Player_ID'],
                        'customer_name' => $_SESSION['Player'],
                    ],
                    'redirect_url' => SiteRootDir . 'coinbase/success.php',
                    'cancel_url' => SiteRootDir . 'coinbase/cancel.php',
                ];

                $dataCharge = Charge::create($chargeData);

                // echo "<pre>";
                // echo print_r($dataCharge);
                // echo "</pre>";
                //Updated Data Response from coinbase

                $sqliCC = "insert into deposit_crypto (player,pay_id,code) values (?,?,?)";
                $valuesCC = array($_SESSION['Player'], $dataCharge->id, $dataCharge->code);
                $model->doinsert($sqliCC, $valuesCC);

                $sqluPay = "update deposit_history set pay_id=? where id=?";
                $valuesPay = array($dataCharge->id, $insertID);
                $model->doUpdate($sqluPay, $valuesPay);

                header("Location:" . $dataCharge->hosted_url);

            } else {

                $ratAmount = $RecDataST[0]['currency_cc'] * 5;

                $_SESSION['errors_code'] = "alert-danger";
                $_SESSION['errors_msg'] = "حداقل پرداخت برابر 5 دلار می باشد. معادل " . number_format($ratAmount) . " تومان .";

                header("Location:../deposit2.php?action=failed");
            }

        } else {
            $_SESSION['errors_code'] = "alert-danger";
            $_SESSION['errors_msg'] = "Wrong amount";

            header("Location:../deposit2.php?action=failed");
        }

    }
}
