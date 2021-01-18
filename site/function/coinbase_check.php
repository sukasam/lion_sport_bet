<?php
include_once "../_inc/model.php";
include_once "../vendor/autoload.php";
include_once "../function/poker_config.php";

use CoinbaseCommerce\ApiClient;
use CoinbaseCommerce\Resources\Charge;

if (isset($_SESSION['Player']) && $_SESSION['Player'] !== "") {

    ApiClient::init(COINBASE_API_KEY);

    $model = new Model();

    $sql = "SELECT * FROM deposit_history WHERE player = ? AND deposit_type=? AND `status`=? ORDER BY id DESC";
    $values = array($_SESSION['Player'], 'CC', "0");
    $RecData = $model->doSelect($sql, $values);

    if (!empty($RecData)) {

        foreach ($RecData as $key => $value) {

            if (!empty($value['pay_id'])) {

                $chargeObj = Charge::retrieve($value['pay_id']);
                // echo "<pre>";
                // print_r($chargeObj);
                // echo "</pre>";

                $countTimeline = count($chargeObj->timeline);

                // echo "Status:".$chargeObj->timeline[$countTimeline-1]['status'];
                // echo "<br>Date Time :".$chargeObj->timeline[$countTimeline-1]['time'];
                // echo "Crypto:".$chargeObj->timeline[$countTimeline-1]['payment']['network'];
                // echo "<br>Amount:".$chargeObj->timeline[$countTimeline-1]['payment']['value']['amount'];
                // echo "<br>Currency:".$chargeObj->timeline[$countTimeline-1]['payment']['value']['currency'];

                //NEW, PENDING, COMPLETED, EXPIRED, UNRESOLVED, RESOLVED, CANCELED, REFUND PENDING, REFUNDED

                if ($chargeObj->timeline[$countTimeline - 1]['status'] === "COMPLETED") {

                    $sqlProfileSQL = "SELECT * FROM user_profile WHERE `Player` = ?";
                    $valuesST2 = array($_SESSION['Player']);
                    $RecProfileC = $model->doSelect($sqlProfileSQL, $valuesST2);

                    $totalAmount = $value['amountT'] + $RecProfileC[0]['DBalance'];

                    $UBalanceSQL = "update user_profile set DBalance=? where Player=?";
                    $valuesBL = array($totalAmount, $_SESSION['Player']);
                    $model->doUpdate($UBalanceSQL, $valuesBL);

                    $cryptoAmount = $chargeObj->timeline[$countTimeline-1]['payment']['value']['amount'];
                    $crypto = $chargeObj->timeline[$countTimeline-1]['payment']['network'];
                    $dateTimeDone = $chargeObj->timeline[$countTimeline-1]['time'];

                    $sqlu = "update deposit_history set status=?,update_done=?,amountC=?,Crypto=? where id=?";
                    $values = array('1',$dateTimeDone,$cryptoAmount,$crypto, $value['id']);
                    $model->doUpdate($sqlu, $values);

                }else if($chargeObj->timeline[$countTimeline - 1]['status'] === "EXPIRED" || $chargeObj->timeline[$countTimeline - 1]['status'] === "CANCELED"){
                    $sqlu = "update deposit_history set status=?,update_done=? where id=?";
                    $values = array('2', $chargeObj->timeline[$countTimeline-1]['time'], $value['id']);
                    $model->doUpdate($sqlu, $values);
                }

            } else {
                $sqlu = "update deposit_history set status=?,update_done=? where id=?";
                $values = array('2', date("Y-m-d H:i:s"), $value['id']);
                $model->doUpdate($sqlu, $values);
            }

        }

        header("Location:../deposit2_history.php");

    } else {
        header("Location:../deposit2_history.php");
    }
}
