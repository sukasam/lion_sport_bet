<?php

include_once "app_top.php";
include_once "poker_config.php";
include_once "poker_api.php";

// Generate Token Id and Valid
$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);

if ($csrf->check_valid('post')) {
    if ($_POST) {

        $iramount = $db->CleanDBData($_POST['amount']);
        $tab = $db->CleanDBData($_POST['tab']);
        $dateLog = date("Y-m-d");
        $timeLog = date("H:i:s");

        if ($iramount >= 1) {

            $sqlST = "SELECT * FROM setting WHERE `sid` = ?";
            $valuesST = array('1');
            $RecDataST = $model->doSelect($sqlST, $valuesST);

            $amountConv = round($iramount / $RecDataST[0]['currency_cc'], 4);

            if ($amountConv >= 5) {

                $apikey = COINBASE_API_KEY;
                $version = COINBASE_VERSION;
                $id = "id-" . time() . "-" . (rand(100000, 999999));
                $player = $_SESSION['Player'];
                $amountD = round(($iramount / $RecDataST[0]['currency_cc']), 4);
                $amount = $amountD;
                $currency = $RecDataST[0]['currency_cc'];
                $hashValueCa = $player . "-" . $amount . "-" . $id . "cancel";
                $tokenid_cancel = hash('sha256', $hashValueCa);
                $hashValueCo = $player . "-" . $amountD . "-" . $id . "complete";
                $tokenid_complete = hash('sha256', $hashValueCo);
                $data = array(
                    'name' => $player,
                    'description' => 'Lion Royal Sport Betting',
                    'local_price' => array(
                        'amount' => $amount,
                        'currency' => 'USD',
                    ),
                    'pricing_type' => 'fixed_price',
                    'metadata' => array(
                        'customer_id' => $id,
                        'customer_name' => $player,
                    ),
                    'redirect_url' => SiteRootDir . 'deposit_cry.php?tab=cry&action=complete&token=' . $tokenid_complete,
                    'cancel_url' => SiteRootDir . 'deposit_cry.php?tab=cry&action=cancel&token=' . $tokenid_cancel,
                );
                $reqBody = json_encode($data);
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    //curl_setopt($curl, CURLOPT_CAINFO, dirname(__FILE__) . "/cacert.pem"),
                    CURLOPT_URL => "https://api.commerce.coinbase.com/charges",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => $reqBody,
                    CURLOPT_HTTPHEADER => array(
                        "cache-control: no-cache",
                        "content-type: application/json",
                        "x-cc-api-key: " . $apikey,
                        "x-cc-version: " . $version,
                    ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                    $_SESSION['errors_code'] = "alert-danger";
                    $_SESSION['errors_msg'] = "مشکلی ایجاد ارتباط با COINBASE به وجود آمده است لطفاً دوباره لاش کنید.";

                    header("Location:../deposit_cry.php?tab=cry&action=failed");
                } else {

                    $response = json_decode($response, true);
                    $total = intval($amountD) * intval($currency);
                    $trans_code = $response['data']['code'];
                    $trans_id = $response['data']['id'];
                    $hosted_url = $response['data']['hosted_url'];

                    $sqli = "insert into deposit_history (player,amountU,amountT,amountC,Bonus,deposit_type,date,time,tran_id,currency,status,pay_id,token_ca, token_co) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                    $values = array($player, $amountD, $iramount, '0', '0', "CC", $dateLog, $timeLog, $trans_code, $RecDataST[0]['currency_cc'], "0", $trans_id, $tokenid_cancel, $tokenid_complete);
                    $insertID = $model->doinsert($sqli, $values);

                    $sqliCC = "insert into deposit_crypto (player,pay_id,code) values (?,?,?)";
                    $valuesCC = array($player, $trans_id, $trans_code);
                    $model->doinsert($sqliCC, $valuesCC);

                    header("Location:" . $hosted_url);
                }

            } else {

                $ratAmount = $RecDataST[0]['currency_cc'] * 5;

                $_SESSION['errors_code'] = "alert-danger";
                $_SESSION['errors_msg'] = "حداقل پرداخت برابر 5 دلار می باشد. معادل " . number_format($ratAmount) . " تومان .";

                header("Location:../deposit_cry.php?tab=cry&action=failed");
            }

        } else {
            $_SESSION['errors_code'] = "alert-danger";
            $_SESSION['errors_msg'] = "Wrong amount";

            header("Location:../deposit_cry.php?tab=cry&action=failed");
        }

    }
}
