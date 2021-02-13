<?php include_once "function/app_top.php";
if (!isset($_GET['tab']) || $_GET['tab'] == "") {
    header("Location:deposit_pm.php?tab=pm");
}

if (isset($_GET['action']) && $_GET['action'] === 'evoucher') {
    $_SESSION['errors_code'] = "";
    include_once "function/deposit.php";
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
                                                       <div class="row">
                                                            <div class="col-lg-5 mb-20">
                                                                <form id="frm_deposit" enctype="multipart/form-data" role='form' action="deposit_pm.php?tab=pm&action=evoucher" method="post">
                                                                        <div class="col-12 text-center mb-30">
                                                                            <span class="rate-span">  1$ <span class="small-text">Perfect Money</span> -&gt; <?php echo number_format($configDT[0]['currency_withdraw']); ?> <span class="small-text">Toman</span></span>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="e_voucher" class="inp">
                                                                                    <input type="tel" id="e_voucher"
                                                                                        name="e_voucher" placeholder="&nbsp;">
                                                                                    <span class="label">E-Voucher</span>
                                                                                    <span class="border"></span>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="activation_code" class="inp">
                                                                                    <input type="tel" id="activation_code"
                                                                                        name="activation_code" placeholder="&nbsp;">
                                                                                    <span class="label">Activation Code</span>
                                                                                    <span class="border"></span>
                                                                                </label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <div class="input-group form-group justify-content-center">
                                                                            <?php
$_SESSION['security_code'] = generateCode(6);
?>
                                                                                <div class="captcha">
                                                                                    <?php echo $_SESSION['security_code']; ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="deposit_captcha_code" class="inp">
                                                                                    <input type="password" id="deposit_captcha_code"
                                                                                        name="deposit_captcha_code" placeholder="&nbsp;">
                                                                                    <span class="label">Secured Code</span>
                                                                                    <span class="border"></span>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="text-center">
                                                                                <button class="btn-main-success" id="btDeposit"><?php echo WITHDRAW_CONFIRMATION; ?>&nbsp&nbsp<i class="fa fa-spinner fa-spin hide" aria-hidden="true" id='spexDeposit'></i></button>
                                                                            </div>
                                                                        </div>
                                                                        <input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>"/>
                                                                        <input type="hidden" name="tab" value="<?php echo $_GET['tab']; ?>"/>
                                                                </from>
                                                            </div>
                                                            <div class="col-lg-7 text-right text-white" dir="rtl">
                                                            <?php
$TITLE_DEPOSIT_DESC = str_replace("%s1", number_format($configDT[0]['currency']), TITLE_DEPOSIT_DESC);
echo $TITLE_DEPOSIT_DESC;
?>
                                                            </div>
                                                       </div>
                                                    </div>
                                                    <div class="theme-content-box <?php if ($_GET['tab'] === "cry") {echo "active";} else {echo "hide";}?>" id="dcry">
                                                        <div class="col-xs-12 m-t-10">
                                                            <section class="card-box">

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