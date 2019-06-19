<?php

session_start();
include_once('../_inc/config.php'); 
include_once("../function/poker_api.php");

//if($_POST){

    $myfile = fopen("callback3.txt", "a") or die("Unable to open file!");
    // foreach(as $key => $value){
    
        $json_string = json_encode($_POST);
        $txt = date('Y-m-d H:i:s')." => ".$json_string.PHP_EOL;
        fwrite($myfile, $txt);
    
    // }
        fclose($myfile);

        //echo $json_string;

        // echo $_POST['invoice_key'];
        // exit();

        function siteeee_verify($api_key, $inv_key, $amount){
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'http://panel.novinshoop.com/webservice/paymentVerify.php');
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type' => 'application/json'));
            curl_setopt($curl, CURLOPT_POSTFIELDS, "MerchantID={$api_key}&Amount={$amount}&Authority={$inv_key}");
            curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $curl_exec = curl_exec($curl);
            curl_close($curl);
            return $curl_exec;
        }

    
        // $postfields = array(
        //     'api_key'=> APIKEY_EASYPAY90,
        // );

        // ///$urlCheck = "http://easypay90.me/invoice/check/".$_POST['invoice_key'];
        // $urlCheck = "http://panel.novinshoop.com/invoice/check/".$_POST['invoice_key'];

        // $response = curl_post_outsite($urlCheck,$postfields);

        // $jsonBank = json_decode($response); 

        
        if($_POST['invoice_key'] == ""){
            $_POST['invoice_key'] = $_GET['Authority'];
        }

        echo "POST invoice_key=> ".$_POST['invoice_key']."<br>";

        $QrySelect = $db->Select( "SELECT * FROM deposit_history WHERE tran_id='".$_POST['invoice_key']."'"); 

        echo APIKEY_NOVINSHOOP.", ".$QrySelect[0]['tran_id'].", ".$QrySelect[0]['amount']."<br>";

        $result = siteeee_verify(APIKEY_NOVINSHOOP, $QrySelect[0]['tran_id'], $QrySelect[0]['amount']);

        echo "Return Bank => ".$result."<br>";

    exit();

        if(!empty($result)){

            $result = json_decode($result,1);

            //if($result['Status'] == 100) {
                    // $output[status] = 1;
                    // $output[res_num] = NULL;
                    // $output[ref_num] = $result['RefID'];
                    // $output[payment_id] = $payment[payment_id];
            //}

            if($result['Status'] == 100 && $QrySelect[0]['status'] == 2){
           
                //$amountRC = substr($jsonBank->amount,0, -1);
    
                $params = array("Command"  => "AccountsIncBalance",
                    "Player"   => $QrySelect[0]['player'],
                    "Amount"  => $_POST['Price'],
                    "Negative"  => "Allow",
                );
                $api = Poker_API($params);
    
                $postfields = array(
    
                    'player'=> $QrySelect[0]['player'],
                    'amount'=> $_POST['Price'],
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
                'tran_id' => $_POST['invoice_key'],
                'status' => "2", 
                'logs'=>'deposit_history_log'
    
            );
            
            $response = curl_post(API_SITE,$postfields);
    
            $_SESSION['errors_code1'] = "alert-danger";
            $_SESSION['errors_msg1'] = 'Your payment failed. Please try again.';
    
            $_SESSION['BANK_AMOUNT'] = "";
                
            header("Location:../deposit2.php?action=failed");
    
            }
        }else{
            $delay = 5; //Where 0 is an example of time Delay you can use 5 for 5 seconds for example !
            @header("Refresh: $delay;"); 
        }


//}
?>