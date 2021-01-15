<?php

include_once "function/app_top.php";

if (isset($_GET['action']) && $_GET['action'] === 'evoucher') {
    $_SESSION['errors_code'] = "";
    include_once "function/deposit.php";
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
                            <h3 class="text-heading"><?php echo TOP_MENU_DEPOSITS." - ".TOP_MENU_DEPOSITS_PM_VOUCHER; ?></h3>
                        </div>

						<div class="col-12 mb-60" id="aTab">
                            <form id="frm_deposit" name="frm_deposit" action="deposit.php?action=evoucher" method="post">
                                <div class="row">
                                    <div class="col-md-5 mb-30">
                                        <?php if ($_SESSION['errors_code'] != "") {?>
                                        <div class="alert <?php echo $_SESSION['errors_code']; ?>">
                                            <?php echo $_SESSION['errors_msg']; ?>
                                        </div>
                                        <?php }?>
                                        <div class="row mb-20">
                                            <div class="col-12 text-center mb-20">
                                                <span class="rate-span">  1$ <span class="small-text">Perfect Money</span> -&gt; <?php echo number_format($configDT[0]['currency_withdraw']);?> <span class="small-text">Toman</span></span>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>E-Voucher:</label>
                                                    <input type="tel" value="" name="e_voucher" id="e_voucher" class="form-control" placeholder="E-Voucher" autofocus="" required onkeypress="return isNumberKey(event);">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Activation Code:</label>
                                                    <input type="tel" value="" name="activation_code" id="activation_code" class="form-control parsley-validated" placeholder="Activation Code" autofocus="" required onkeypress="return isNumberKey(event);">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-group form-group justify-content-center">
                                                    <!-- <img id="captcha" src="include/captcha.php?v=<?php echo date("YmdHis"); ?>" alt="CAPTCHA Image" class="img-thumbnail img-thumbnail-captcha"> -->
                                                <?php
$_SESSION['security_code'] = generateCode(4);
?>
                                                <div class="captcha">
                                                    <?php echo $_SESSION['security_code']; ?>
                                                </div>

                                                </div>
                                                <div class="input-group form-group">
                                                    <div class="input-group-prepend">
                                                    </div>
                                                    <input type="password" class="form-control" placeholder="Secured Code" name="deposit_captcha_code" id="deposit_captcha_code" autocomplete="off" required onkeypress="return isNumberKey(event);">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button class="genric-btn primary circle arrow" id="btDeposit"><?php echo WITHDRAW_CONFIRMATION; ?>&nbsp&nbsp<i class="fa fa-spinner fa-spin hide" aria-hidden="true" id='spexDeposit'></i></button>
                                        </div>
                                    </div>

                                    <div class="col-md-7 text-right" dir="rtl">
                                        <?php
$TITLE_DEPOSIT_DESC = str_replace("%s1", number_format($configDT[0]['currency']), TITLE_DEPOSIT_DESC);
echo $TITLE_DEPOSIT_DESC;
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

        <?php include_once "footer.php";?>

        <?php include_once "footer_script.php";?>

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