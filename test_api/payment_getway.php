<?php
include_once("../function/poker_api.php");

//Create Transaction.
// $postfields = array(
//     'amount'=> "100", 
//     'pin'=> "55CF6F67DCBA214383B0",
//     'callback'=> "http://mkung.unicity-easynet.com/payment/callback.php",
//     'bank'=> "parsian",
//     'description'=>'Test Payment',
// );

// // echo "<pre>";
// // print_r($postfields);
// // echo "</pre>";

// echo $response = curl_post("https://panel.kalashopy.com/api/create/",$postfields);

// echo "URL API : https://panel.kalashopy.com/api/create/<br><br>";
// echo "Return : ".$response;


/*switch ($response) {
    case "-1":
        echo "amount نمیتواند خالی باشد";
        break;
    case "-2":
        echo "کد پین درگاه نمیتواند خالی باشد";
        break;
    case "-3":
        echo "callback نمیتواند خالی باشد";
        break;
    case "-4":
        echo "amount باید عددی باشد";
        break;
    case "-5":
        echo "amount باید بزرگتر از ۰۱۱ باشد";
        break;
    case "-6":
        echo "کد پین درگاه اشتباه هست";
        break;
    case "-7":
        echo "ایپی سرور با ایپی درگاه مطابقت ندارد";
        break;
    case "-8":
        echo "transid نمیتواند خالی باشد";
        break;
    case "-9":
        echo "تراکنش مورد نظر وجود ندارد";
        break;
    case "-10":
        echo "کد پین درگاه با درگاه تراکنش مطابقت ندارد";
        break;
    case "-11":
        echo "مبلغ با مبلغ تراکنش مطابقت ندارد";
        break;
    case "-12":
        echo "بانک وارد شده اشتباه میباشد";
        break;
}*/

// //Status Transaction.
// $TRANSID = "5BF800B243622";
// echo $response = curl_get("https://panel.kalashopy.com/startpay/".$TRANSID);


// //Verify Transaction.
// $postfields = array(
//     'amount'=> "2000", 
//     'pin'=> "55CF6F67DCBA214383B0",
//     'transid'=> "5BF800B243622",
// );
// echo $response = curl_post("https://panel.kalashopy.com/api/verify/",$postfields);



// $postfields = array(
//     'api_key'=> APIKEY_RENTHOSTING,
//     'amount'=> 1000,
//     'return_url'=> DOMAIN_SITE."/payment/callback3.php",
// );

// print_r($postfields);

// echo $url = "<br>URL to Call Bank.=> http://renthosting.ir/invoice/request/";

// echo $responseBank = curl_post_outsite("http://renthosting.ir/invoice/request/",$postfields);

// //header("Location:http://renthosting.ir/invoice/pay/".$responseBank);


$MerchantID 			= "3bfa6efbcccba7298f6cb13e08e31414";
$Amount 				= 1000;
$InvoiceNumber 			= 10;
$Description 			= "تراکنش شماره {$InvoiceNumber}";
$CallbackURL 			= DOMAIN_SITE."/payment/callback3.php";
$CardNumber 			= "";

// $curl = curl_init();
// curl_setopt($curl, CURLOPT_URL, 'http://panel.novinshoop.com/webservice/paymentRequest.php');
// curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type' => 'application/json'));
// curl_setopt($curl, CURLOPT_POSTFIELDS, "MerchantID={$MerchantID}&Amount={$Amount}&Description={$Description}&InvoiceNumber={$InvoiceNumber}&CardNumber={$CardNumber}&CallbackURL=". urlencode($CallbackURL));
// curl_setopt($curl, CURLOPT_TIMEOUT, 30);
// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// $curl_exec = curl_exec($curl);
// curl_close($curl);

// $result = json_decode($curl_exec);

// echo $curl_exec;
// exit();

// $postfields = array(
//     'MerchantID'=> APIKEY_RENTHOSTING,
//     'Amount'=> 1000,
//     'InvoiceNumber' => $InvoiceNumber,
//     'Description' => $Description,
//     'CallbackURL'=> DOMAIN_SITE."/payment/callback3.php",
//     'CardNumber'=> "",
// );

// $responseBank = curl_post_outsite("http://panel.novinshoop.com/webservice/paymentRequest.php",$postfields);

// $result = json_decode($responseBank);

// if (isset($result->Status) && $result->Status == 100)
// {
// 	header("Location: http://panel.novinshoop.com/startPay/{$result->Authority}");
// } else {
// 	echo (isset($result->Status) && $result->Status != "") ? $result->Status : "-13";
// }



function siteeee_pay($api_key, $amount, $redirect){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'http://panel.novinshoop.com/webservice/paymentRequest.php');
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type' => 'application/json'));
    curl_setopt($curl, CURLOPT_POSTFIELDS, "MerchantID={$api_key}&Amount={$amount}&Description=payment&InvoiceNumber=1&CallbackURL=". urlencode($redirect));
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $curl_exec = curl_exec($curl);
    curl_close($curl);
    return $curl_exec;
}


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

$api_key = "3bfa6efbcccba7298f6cb13e08e31414";
$amount = "1000";
$redirect = DOMAIN_SITE."/payment/callback3.php";

$returnBank = siteeee_pay($api_key,$amount,$redirect);

    $result = json_decode($returnBank,1);

    if($result['Status'] == 100) {
        //$update[payment_rand] = $result['Authority'];
        // $sql = $db->queryUpdate('payment', $update, 'WHERE `payment_rand` = "'.$factorNumber.'" LIMIT 1;');
        // $db->execute($sql);
        $go = "http://panel.novinshoop.com/startPay/".$result['Authority'];
        header("Location: $go");
        exit;
    } else {
        //-- نمایش خطا
        // $data[title] = 'خطای سیستم';
        // $data[message] = '<font color="red">در ارتباط با درگاه مشکلی به وجود آمده است.</font> شماره خطا: '.'<br />'.'متن خطا: '.'<br />'. '<a href="index.php" class="button">بازگشت</a>';
        // $smarty->assign('data', $data);
        // $smarty->display('message.tpl');
        echo "Errors";
        exit;
    }

exit();


?>