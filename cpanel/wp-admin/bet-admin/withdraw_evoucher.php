<?php
    include_once("../../function/cpanel/app_top.php");
    include_once("../../function/poker_config.php");
    include_once("../../function/poker_api.php");

    if($_POST){

        $configConvert = $db->select("SELECT * FROM setting WHERE sid ='1' ORDER BY sid DESC");  

        $amount = number_format($_POST['amount'] / $configConvert[0]['currency_withdraw'],2);
        $payAmount = eregi_replace(',', '', $amount);
        $player = $_POST['player'];
        $id = $_POST['id'];
        //echo $amount." USD";
        //exit();

        $postfields = array(
            'AccountID'=> PERFECT_ACCOUNTID,
            'PassPhrase'=> PERFECT_PASSPHRASE,
            'Payer_Account' => PERFECT_PAYEE_ACCOUNT,
            'Amount' => $payAmount,
        );
        
        $response = curl_post_outsite("https://perfectmoney.is/acct/ev_create.asp",$postfields);
        
        //print_r($response);
        
         // searching for hidden fields
         if(!preg_match_all("/<input name='(.*)' type='hidden' value='(.*)'>/", $response, $result, PREG_SET_ORDER)){
            echo 'Ivalid output';
            exit;
         }
         
        
        $ar="";
        foreach($result as $item){
        $key=$item[1];
        $ar[$key]=$item[2];
        }

        /*echo '<pre>';
        print_r($ar);
        echo '</pre>';*/

        //echo $ar['ERROR'];

        if($ar['ERROR'] == ""){

            $array_fields = array(
                'evoucher' => $ar['VOUCHER_NUM'],
                'activation_code' => $ar['VOUCHER_CODE'],
                'evoucher_amount' => $ar['VOUCHER_AMOUNT'],
                );
            
                $array_where = array(    
                'id' => $id,
                );
            
            $q = $db->Update('withdraw_history', $array_fields, $array_where);


            $dateLog = date("Y-m-d");
            $timeLog = date("H:i:s");

            $postfields = array(
                'player'=> $player, 
                'Payer_Account' => $ar['Payer_Account'],
                'PAYMENT_AMOUNT' => $ar['PAYMENT_AMOUNT'],
                'PAYMENT_BATCH_NUM' => $ar['PAYMENT_BATCH_NUM'],
                'VOUCHER_NUM' => $ar['VOUCHER_NUM'],
                'VOUCHER_CODE' => $ar['VOUCHER_CODE'],
                'VOUCHER_AMOUNT' => $ar['VOUCHER_AMOUNT'],
                'date'=> $dateLog,
                'time'=> $timeLog,
                'logs'=>'withdraw_ev',
            );

            $response = curl_post(API_SITE,$postfields);
        
            header("Location:withdraw.php?action=success&msg=done&evoucher=".$ar['VOUCHER_NUM']."&activation_code=".$ar['VOUCHER_CODE']."&amount=".$ar['VOUCHER_AMOUNT']);

        }else{

            header("Location:withdraw.php?action=failed&msg=".$ar['ERROR']);
            /*echo $ar -> ERROR;*/
        }
    }else{
        header("Location:withdraw.php");
    }

    /*
   Array
(
    [Payer_Account] => U17828646
    [PAYMENT_AMOUNT] => 1.01
    [PAYMENT_BATCH_NUM] => 237431045
    [VOUCHER_NUM] => 2291790289
    [VOUCHER_CODE] => 0192973766031063
    [VOUCHER_AMOUNT] => 1
)*/

?>