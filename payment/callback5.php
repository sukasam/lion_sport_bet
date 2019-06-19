<?php

session_start();
include_once('../_inc/config.php'); 
include_once("../function/poker_api.php");


if($_POST){

    $myfile = fopen("callback.txt", "a") or die("Unable to open file!");
    // foreach(as $key => $value){
    
        $json_string = json_encode($_POST);
        $txt = date('Y-m-d H:i:s')." => ".$json_string.PHP_EOL;
        fwrite($myfile, $txt);
    
    // }
        fclose($myfile);
    
        $postfields = array(
            'amount'=> $_SESSION['BANK_AMOUNT'],
            'transid'=> $_POST['transid'],
            'pin'=> "69CB2AECFD570A548047",
        );

        // $postfields = array(
        //     'amount'=> "2000",
        //     'transid'=> "5C0D14CD20C97",
        //     'pin'=> "28AADA2519E5AC63322E",
        // );
        
        $response = curl_post_outsite("http://pwg.mihankharid24.com/api/verify/",$postfields);

        $QrySelect = $db->Select( "SELECT * FROM deposit_history WHERE tran_id='".$_POST['transid']."'"); 

        if(($response == 1 || $response == 2) && $QrySelect[0]['status'] == 2){

            $params = array("Command"  => "AccountsIncBalance",
                "Player"   => $_SESSION['Player'],
                "Amount"  => $_SESSION['BANK_AMOUNT'],
                "Negative"  => "Allow",
            );
            $api = Poker_API($params);

            $postfields = array(

                'player'=> $_SESSION['Player'],
                'amount'=> $_SESSION['BANK_AMOUNT'],
                'deposit_type'=> "Online Card",
                'date' => date("Y-m-d"), 
                'time' => date("H:i:s"), 
                'tran_id' => $_POST['transid'],
                'status' => "1", 
                'logs'=>'deposit_history_log'
    
            );
            
            $response = curl_post(API_SITE,$postfields);

            $_SESSION['errors_code1'] = "alert-success";
            $_SESSION['errors_msg1'] = "Deposit has been completed";
            
            header("Location:../deposit2.php?action=success");

        }else{

        $postfields = array(

            'player'=> $_SESSION['Player'],
            'amount'=> $_SESSION['BANK_AMOUNT'],
            'deposit_type'=> "Online Card",
            'date' => date("Y-m-d"), 
            'time' => date("H:i:s"), 
            'tran_id' => $_POST['transid'],
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