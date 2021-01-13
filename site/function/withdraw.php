<?php
include_once "app_top.php";

$csrf = new csrf();

// Generate Token Id and Valid
$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);
if ($csrf->check_valid('post')) {
    if ($_POST) {

        //283944
        $pkamount = $db->CleanDBData($_POST['amount']);
        $second_password = $db->CleanDBData($_POST['second_password']);

        $callBackW = "withdraw.php";

        $sqlSCPSQL = "SELECT * FROM secpw WHERE player = ? AND swp = ? AND `action`=? ORDER BY id DESC";
        $valuesSCPSQL = array($_SESSION['Player'], encode($second_password, KEY_HASH), '0');
        $RecDataSCP = $model->doSelect($sqlSCPSQL, $valuesSCPSQL);

        if (!empty($RecDataSCP)) {

            $date = $RecDataSCP[0]['date'];
            $time = $RecDataSCP[0]['time'];

            $timestamp = strtotime($date . " " . $time); //1373673600

            if ($timestamp < time() + 86400) {

                $sql = "SELECT * FROM user_profile WHERE Player = ?";
                $values = array($_SESSION['Player']);
                $RecData = $model->doSelect($sql, $values);

                if ($pkamount <= $RecData[0]['CBalance']) {

                    $sqlST = "SELECT * FROM setting WHERE `sid` = ?";
                    $valuesST = array('1');
                    $RecDataST = $model->doSelect($sqlST, $valuesST);

                    $sqli = "insert into withdraw_history (player,amount,evoucher,activation_code,evoucher_amount,currency,date,time,withdraw_type,status,auto_withdraw) values (?,?,?,?,?,?,?,?,?,?,?)";
                    $values = array($_SESSION['Player'], $pkamount,'','','',$RecDataST[0]['currency'], date("Y-m-d"), date("H:i:s"),'1','0','0');
                    $model->doinsert($sqli, $values);

                    //Updated SCP
                    // $sqlUpDSCP = "update secpw set action=? where player=?";
                    // $valuesUpDSCP = array('1', $_SESSION['Player']);
                    // $model->doUpdate($sqlUpDSCP, $valuesUpDSCP);

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
            } else {
                $_SESSION['errors_code'] = "alert-danger";
                $_SESSION['errors_msg'] = "The second password has expired. Please request the second password again.";
                header("Location:" . SiteRootDir . "" . $callBackW . "?action=failed");
            }
        } else {
            $_SESSION['errors_code'] = "alert-danger";
            $_SESSION['errors_msg'] = "The second password is not valid.";

            header("Location:" . SiteRootDir . "" . $callBackW . "?action=failed");
        }

        // if($_SESSION['security_code'] === $db->CleanDBData($_POST['withdraw_captcha_code'])) { // Check

        //     if($db->CleanDBData(decode($_POST['amount'],KEY_HASH)) != "0"){

        //         $params3 = array("Command"  => "AccountsGet",
        //         "Player"   => $_SESSION['Player']);
        //         $api3 = Poker_API($params3);

        //         //if($api3->Note == $pincode){

        //             if($api3 -> Balance >= $pkamount){

        //                 $RecData = $db->select("SELECT * FROM bank_info WHERE player = '".$_SESSION['Player']."' ORDER BY id DESC");

        //                 if($RecData[0]['id'] != ""){

        //                     $params = array("Command"  => "AccountsDecBalance",
        //                         "Player"   => $_SESSION['Player'],
        //                         "Amount"  => $pkamount,
        //                     );
        //                     $api = Poker_API($params);

        //                     if($api -> Result == "Ok"){

        //                         $postfields = array(
        //                             'player'=> $_SESSION['Player'],
        //                             'amount'=> $pkamount,
        //                             'evoucher'=> "",
        //                             'activation_code'=> "",
        //                             'evoucher_amount'=> "0",
        //                             'date'=> date("Y-m-d"),
        //                             'time'=> date("H:i:s"),
        //                             'withdraw_type' => $withdrwaType,
        //                             'status'=> "0",
        //                             'logs'=>'withdraw_log',
        //                         );

        //                         $response = curl_post(API_SITE,$postfields);

        //                         $_SESSION['errors_code'] = "alert-success";
        //                         $_SESSION['errors_msg'] = "Your withdrawal is being processed.";

        //                         header("Location:".SiteRootDir."".$callBackW."?action=success");
        //                     }else{
        //                         $_SESSION['errors_code'] = "alert-danger";
        //                         $_SESSION['errors_msg'] = 'Please select the amount you wish to withdraw.';
        //                         header("Location:".SiteRootDir."".$callBackW."?action=failed");
        //                     }

        //                 }else{
        //                     $_SESSION['errors_code'] = "alert-danger";
        //                     $_SESSION['errors_msg'] = TITLE_WITHDRAW_FUN2.'<br><a href="account.php">'.TITLE_WITHDRAW_FUN3.'</a>';
        //                     header("Location:".SiteRootDir."".$callBackW."?action=failed");
        //                 }
        //             }else{

        //                 $_SESSION['errors_code'] = "alert-danger";
        //                 $_SESSION['errors_msg'] = TITLE_WITHDRAW_FUN1;
        //                 header("Location:".SiteRootDir."".$callBackW."?action=failed");

        //             }
        //         // }else{
        //         //     $_SESSION['errors_code'] = "alert-danger";
        //         //     $_SESSION['errors_msg'] = "Your PIN Code is invalid.";
        //         //     header("Location:".SiteRootDir."".$callBackW."?action=failed");
        //         // }

        //     }else{
        //         $_SESSION['errors_code'] = "alert-danger";
        //         $_SESSION['errors_msg'] = 'Please select the amount you wish to withdraw.';
        //         header("Location:".SiteRootDir."".$callBackW."?action=failed");
        //     }

        //     // $_SESSION['errors_code'] = "alert-danger";
        //     // $_SESSION['errors_msg'] = TITLE_WITHDRAW_CLOSE;
        //     // header("Location:".SiteRootDir."".$withdrwaType."?action=failed");

        // }else{
        //     $_SESSION['errors_code'] = "alert-danger";
        //     $_SESSION['errors_msg'] = "Invalid security code.";

        //     header("Location:".SiteRootDir."".$callBackW."?action=failed");
        // }
    }
}
