<?php include_once "function/app_top.php";
if (!isset($_GET['tab']) || $_GET['tab'] == "") {
    header("Location:deposit_pm.php?tab=pm");
}

if (isset($_GET['action']) && $_GET['action'] === 'cryptocurrency') {
    $_SESSION['errors_code'] = "";
    include_once "function/deposit2.php";
} else if (isset($_GET['action']) && $_GET['action'] === 'complete') {

    if (isset($_GET['token'])) {

        $token = $_GET['token'];
        $sql = "SELECT `amountT`,`tran_id`,`status` From `deposit_history` WHERE `token_co`=? and `player`=?";
        $values = array($token, $_SESSION['Player']);
        $result = $model->doSelect($sql, $values);
        $totalConvert = $result[0]['amountT'];
        $dbStatus = $result[0]['status'];

        if ($result) {

            if ($dbStatus == 0 || $dbStatus === '0') {

                //////////////////////////////////
                $show = $result[0]['tran_id'];
                $apikey = COINBASE_API_KEY;
                $version = COINBASE_VERSION;
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    //curl_setopt($curl, CURLOPT_CAINFO, dirname(__FILE__) . "/cacert.pem"),
                    CURLOPT_URL => "https://api.commerce.coinbase.com/charges/" . $show,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "cache-control: no-cache",
                        "x-cc-api-key: " . $apikey,
                        "x-cc-version: " . $version,
                    ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                // echo "<pre>";
                // print_r($response);
                // echo "</pre>";
                // exit();

                if ($err) {
                    // echo "cURL Error #:" . $err;
                    $_SESSION['errors_code'] = "alert-danger";
                    $_SESSION['errors_msg'] = "خطایی رخ داده است، لطفاً صبر کنید";

                    header("Location:../deposit_cry.php?tab=cry&action=failed");
                } else {
                    // echo $response;
                    $response = json_decode($response, true);
                    $timeline = count($response['data']['timeline']);
                    $paymentStatus = $response['data']['timeline'][$timeline - 1]['status'];
                    $paymentTime = $response['data']['timeline'][$timeline - 1]['time'];
                    $paymentAmount = $response['data']['timeline'][$timeline - 1]['payment']['value']['amount'];
                    $paymentNetwork = $response['data']['timeline'][$timeline - 1]['payment']['value']['currency'];
                    // echo $response['data']['timeline'][2]['status'];
                    // echo $response['data']['timeline'][2]['payment']['value']['amount'];
                    // echo $response['data']['timeline'][2]['payment']['value']['amount'];
                }
                //////////////////////////////////

                if($paymentStatus === "COMPLETED"){
                    $sqlu = "UPDATE `deposit_history` SET `status`=?,`amountC`=?,`Crypto`=?,`update_done`=? WHERE `token_co`=?";
                    $values = array(1, $paymentAmount, $paymentNetwork, $paymentTime, $token);
                    $model->doUpdate($sqlu, $values);
    
                    $sqlProfileSQL = "SELECT * FROM user_profile WHERE `Player` = ?";
                    $valuesST2 = array($_SESSION['Player']);
                    $RecProfileC = $model->doSelect($sqlProfileSQL, $valuesST2);
    
                    $totalAmount = $totalConvert + $RecProfileC[0]['DBalance'];
    
                    $UBalanceSQL = "update user_profile set DBalance=? where Player=?";
                    $valuesBL = array($totalAmount, $_SESSION['Player']);
                    $model->doUpdate($UBalanceSQL, $valuesBL);
    
                    $_SESSION['errors_code'] = "alert-success";
                    $_SESSION['errors_msg'] = "حساب شما با موفقیت شارژ شد.";
    
                    header("Location:../deposit_cry.php?tab=cry&action=success");
                }else{
                    // if Case status return is not COMPLETED
                    $_SESSION['errors_code'] = "alert-success";
                    $_SESSION['errors_msg'] = "حساب شما با موفقیت شارژ شد.";
                    header("Location:../deposit_cry.php?tab=cry&action=success");
                }
                
            } else {
                $_SESSION['errors_code'] = "alert-danger";
                $_SESSION['errors_msg'] = "تراکنش تکراری";

                header("Location:../deposit_cry.php?tab=cry&action=failed");
            }
        } else {
            $_SESSION['errors_code'] = "alert-danger";
            $_SESSION['errors_msg'] = "تراکنش مورد نظر موجود نمی باشد";

            header("Location:../deposit_cry.php?tab=cry&action=failed");
        }
    }
} else if (isset($_GET['action']) && $_GET['action'] === 'cancel') {
    if (isset($_GET['token'])) {
        $token = $_GET['token'];
        $sqlu = "UPDATE `deposit_history` SET `status`=?,`update_done`=? WHERE `token_ca`=? and `status`=? and `player`=?";
        $values = array(2, date("Y-m-d H:i:s"), $token, 0, $_SESSION['Player']);
        $model->doUpdate($sqlu, $values);

        $_SESSION['errors_code'] = "alert-danger";
        $_SESSION['errors_msg'] = "تراکنش از جانب شما کنسل گردید.";

        header("Location:../deposit_cry.php?tab=cry&action=failed");
    }
}

if (!isset($_GET['action'])) {
    $_SESSION['errors_code'] = "";

}
?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once 'meta2.php';?>
    <title>Deposits | Lion Royal Betting</title>
</head>

<body class="dark-theme-layout">
    <div class="" id="testtheme"></div>
    <input type="hidden" id="token" value="Qs8ERsZpmWnFqvKN5iVen1SmapOWE150y8VHJiTC">
    <?php include_once 'head2.php';?>
    <section class="page-paddings">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="user-page-main clearfix">
                        <?php include_once 'left_menu2.php';?>
                        <style type="text/css"></style>
                        <div class="user-panel-right">
                            <div class="user-detail">
                                <div class="user-box-detai">
                                    <div class="row">
                                        <?php if ($_SESSION['errors_code'] != "") {?>
                                        <div class="col-12">
                                            <div class="alert <?php echo $_SESSION['errors_code']; ?>">
                                                <?php echo $_SESSION['errors_msg']; ?>
                                            </div>
                                        </div>
                                        <?php }?>
                                        <div class="col-xl-12">
                                            <div class="theme-tab security-tab">
                                                <ul class="tabs group clearfix">
                                                    <li class="<?php if ($_GET['tab'] === "pm") {echo "active";}?>">
                                                        <a href="deposit_pm.php?tab=pm">Deposits - Perfect Money Voucher</a>
                                                    </li>
                                                    <li class="<?php if ($_GET['tab'] === "cry") {echo "active";}?>"><a href="deposit_cry.php?tab=cry">Deposits - Cryptocurrency</a></li>
                                                </ul>
                                                <div class="theme-content clearfix">
                                                    <div class="theme-content-box <?php if ($_GET['tab'] === "pm") {echo "active";} else {echo "hide";}?>" id="dpm">
                                                       
                                                    </div>
                                                    <div class="theme-content-box <?php if ($_GET['tab'] === "cry") {echo "active";} else {echo "hide";}?>" id="dcry">
                                                        <div class="col-xs-12 m-t-10">
                                                            <section class="card-box">
                                                            <div class="row">
                                                            <div class="col-lg-5 mb-20">
                                                                <form id="frm_deposit2" enctype="multipart/form-data" role='form' action="deposit_cry.php?tab=cry&action=cryptocurrency" method="post">
                                                                        <div class="col-12 text-center mb-30">
                                                                            <span class="rate-span">  1$ <span class="small-text">Cryptocurrency</span> -&gt; <?php echo number_format($configDT[0]['currency_cc']); ?> <span class="small-text">Toman</span></span>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="amount" class="inp">
                                                                                    <input type="tel" id="amount"
                                                                                        name="amount" placeholder="&nbsp;">
                                                                                    <span class="label">Amount (Toman)</span>
                                                                                    <span class="border"></span>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="text-center">
                                                                                <button class="btn-main-success" id="btDeposit2"><?php echo WITHDRAW_CONFIRMATION; ?>&nbsp&nbsp<i class="fa fa-spinner fa-spin hide" aria-hidden="true" id='spexDeposit2'></i></button>
                                                                            </div>
                                                                        </div>
                                                                        <input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>"/>
                                                                        <input type="hidden" name="tab" value="<?php echo $_GET['tab']; ?>"/>
                                                                </from>
                                                            </div>
                                                            <div class="col-lg-7 text-right text-white" dir="rtl">
                                                            <?php
$TITLE_DEPOSITS_DESC_CC = str_replace("%s1", number_format($configDT[0]['currency_cc']), TITLE_DEPOSITS_DESC_CC);
echo $TITLE_DEPOSITS_DESC_CC;
?>
                                                            </div>
                                                       </div>
                                                            </section>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <script type="text/javascript" src="js/profile.min.js?cmt=fa217407"></script>
    <script>

        $( "#deposit_captcha_code" ).keypress(function( event ) {
            if ( event.which == 13 ) {
                event.preventDefault();
            }
        });
        

        $("#btDeposit").click(function() {


            if($('#e_voucher').val() == ""){
                $('#e_voucher').focus();
                return false;
            }

            if($('#activation_code').val() == ""){
                $('#activation_code').focus();
                return false;
            }

            if($('#deposit_captcha_code').val() == ""){
                $('#deposit_captcha_code').focus();
                return false;
            }

            $("#spexDeposit").removeClass('hide');
            $('#btDeposit').prop('disabled', true);

            $('#frm_deposit').submit();

        });

        

    </script>
</body>

</html>