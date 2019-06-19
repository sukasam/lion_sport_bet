<?php

session_start();
include_once('../_inc/config.php'); 
include_once("../function/poker_api.php");

if($_POST){

    $myfile = fopen("callback2.txt", "a") or die("Unable to open file!");
    // foreach(as $key => $value){
    
        $json_string = json_encode($_POST);
        $txt = date('Y-m-d H:i:s')." => ".$json_string.PHP_EOL;
        fwrite($myfile, $txt);
    
    // }
        fclose($myfile);

    
        $postfields = array(
            // 'api_key'=> APIKEY_EASYPAY90,
            'api_key'=> APIKEY_NOVINSHOOP,
        );

        ///$urlCheck = "http://easypay90.me/invoice/check/".$_POST['invoice_key'];
        $urlCheck = "http://panel.novinshoop.com/invoice/check/".$_POST['invoice_key'];

        $response = curl_post_outsite($urlCheck,$postfields);

        $jsonBank = json_decode($response); 

        //$jsonBank->status

        $QrySelect = $db->Select( "SELECT * FROM deposit_history WHERE tran_id='".$_POST['invoice_key']."'"); 

        if($jsonBank->status == 1 && $QrySelect[0]['status'] == 2){
           
            $amountRC = substr($jsonBank->amount,0, -1);

            $params = array("Command"  => "AccountsIncBalance",
                "Player"   => $QrySelect[0]['player'],
                "Amount"  => $amountRC,
                "Negative"  => "Allow",
            );
            $api = Poker_API($params);

            $postfields = array(

                'player'=> $QrySelect[0]['player'],
                'amount'=> $amountRC,
                'deposit_type'=> "Online Card",
                'date' => date("Y-m-d"), 
                'time' => date("H:i:s"), 
                'tran_id' => $_POST['invoice_key'],
                'status' => "1", 
                'logs'=>'deposit_history_log'
    
            );

            $response = curl_post(API_SITE,$postfields);

            // print_r($postfields);
            // exit();

            $_SESSION['errors_code1'] = "alert-success";
            $_SESSION['errors_msg1'] = "Deposit has been completed";
            
            header("Location:../deposit2.php?action=success");

        }else{

        $postfields = array(

            'player'=> $QrySelect[0]['player'],
            'amount'=> $QrySelect[0]['amount'],
            'deposit_type'=> "Online Card",
            'date' => date("Y-m-d"), 
            'time' => date("H:i:s"), 
            'tran_id' => $jsonBank->invoice_key,
            'status' => "2", 
            'logs'=>'deposit_history_log'

        );
        
        $response = curl_post(API_SITE,$postfields);

        $_SESSION['errors_code1'] = "alert-danger";
        $_SESSION['errors_msg1'] = 'Your payment failed. Please try again.';

        $_SESSION['BANK_AMOUNT'] = "";
            
        header("Location:../deposit2.php?action=failed");

        }
}
?>