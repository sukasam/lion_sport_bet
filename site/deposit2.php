<?php

include_once "function/app_top.php";

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

                    header("Location:../deposit2.php?action=failed");
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
    
                    header("Location:../deposit2.php?action=success");
                }else{
                    // if Case status return is not COMPLETED
                    $_SESSION['errors_code'] = "alert-success";
                    $_SESSION['errors_msg'] = "حساب شما با موفقیت شارژ شد.";
                    header("Location:../deposit2.php?action=success");
                }
                
            } else {
                $_SESSION['errors_code'] = "alert-danger";
                $_SESSION['errors_msg'] = "تراکنش تکراری";

                header("Location:../deposit2.php?action=failed");
            }
        } else {
            $_SESSION['errors_code'] = "alert-danger";
            $_SESSION['errors_msg'] = "تراکنش مورد نظر موجود نمی باشد";

            header("Location:../deposit2.php?action=failed");
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

        header("Location:../deposit2.php?action=failed");
    }
}

if (!isset($_GET['action'])) {
    $_SESSION['errors_code'] = "";

}

?>
<!DOCTYPE html>
	<html lang="en" class="no-js">
    <?php include_once "header.php";?>
    <style>
    html {
    background: url(img/bg/bg_lionroyalcasino.jpg) no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;

    }
    body{
        background-color: transparent;
    }

    </style>
		<body>
			<!-- Start banner Area -->
			<section class="generic-banner relative">
                <?php include_once "topmenu.php";?>
			</section>
            <!-- End banner Area -->

            <!-- About Generic Start -->
		<div class="main-wrapper ">
            <!-- Start feature Area -->
			<section class="feature-area section-gap " id="secvice">
				<div class="container card-content">
					<div class="row">
                        <div class="col-12 mb-40">
                            <h3 class="text-heading"><?php echo TOP_MENU_DEPOSITS . " - " . TOP_MENU_DEPOSITS_CRYPTO; ?></h3>
                        </div>

						<div class="col-12 mb-60" id="aTab">
                            <form id="frm_deposit" name="frm_deposit" action="deposit2.php?action=cryptocurrency" method="post">
                                <div class="row">
                                    <div class="col-md-5 mb-30">
                                        <?php if ($_SESSION['errors_code'] != "") {?>
                                        <div class="alert <?php echo $_SESSION['errors_code']; ?>">
                                            <?php echo $_SESSION['errors_msg']; ?>
                                        </div>
                                        <?php }?>
                                        <div class="row mb-20">
                                            <div class="col-12 text-center mb-20">
                                                <span class="rate-span">  1$ <span class="small-text">Cryptocurrency</span> -&gt; <?php echo number_format($configDT[0]['currency_cc']); ?> <span class="small-text">Toman</span></span>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Amount (Toman):</label>
                                                    <input type="tel" value="" name="amount" id="amount" class="form-control parsley-validated" placeholder="0" autofocus="" required onkeypress="return isNumberKey(event);">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button class="genric-btn primary circle arrow" id="btDeposit"><?php echo WITHDRAW_CONFIRMATION; ?>&nbsp&nbsp<i class="fa fa-spinner fa-spin hide" aria-hidden="true" id='spexDeposit'></i></button>
                                        </div>
                                    </div>

                                    <div class="col-md-7">
                                        <?php
$TITLE_DEPOSITS_DESC_CC = str_replace("%s1", number_format($configDT[0]['currency_cc']), TITLE_DEPOSITS_DESC_CC);
echo $TITLE_DEPOSITS_DESC_CC;
?>
                                    </div>
                                </div>

                                <input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>"/>
                            </form>
                        </div>
                    </div>
				</div>
			</section>
			<!-- End feature Area -->
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer" style="justify-content: center;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>

        <?php include_once "footer.php";?>

        <?php include_once "footer_script.php";?>

        <script>

        $(document).ready(function() {
            $('#deposit').DataTable();
        } );


        $("#btDeposit").click(function() {


            if($('#amount').val() == ""){
                $('#amount').focus();
                return false;
            }

            $('#frm_deposit').submit();

        });

        </script>
	</body>
</html>