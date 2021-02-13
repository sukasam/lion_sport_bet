<?php include_once "function/app_top.php";
if (!isset($_GET['tab']) || $_GET['tab'] == "") {
    header("Location:withdraw_pm.php?tab=pm");
}


if (isset($_GET['action']) && $_GET['action'] === 'withdraw') {
    include_once "function/withdraw.php";
}

if (isset($_GET['action']) && $_GET['action'] === 'SecondPassword') {
    include_once "function/secondpassword.php"; 
}

if (!isset($_GET['action'])) {
    $_SESSION['errors_code'] = "";

}

?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once 'meta2.php';?>
    <title>Cashouts | Lion Royal Betting</title>
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
                                                        <a href="withdraw_pm.php?tab=pm">Cashouts - Perfect Money Voucher</a>
                                                    </li>
                                                    <li class="<?php if ($_GET['tab'] === "cry") {echo "active";}?>"><a href="withdraw_pm2.php?tab=cry">Cashouts - Perfect Money To Account</a></li>
                                                </ul>
                                                <div class="theme-content clearfix">
                                                    <div class="theme-content-box <?php if ($_GET['tab'] === "pm") {echo "active";} else {echo "hide";}?>" id="dpm">
                                                       <div class="row">
                                                            <div class="col-lg-5 mb-20">
                                                                <form id="frm_cashouts" enctype="multipart/form-data" role='form' action="withdraw_pm.php?tab=pm&action=withdraw" method="post">
                                                                        <div class="col-12 text-center mb-30">
                                                                        <span class="rate-span"><?php echo number_format($configDT[0]['currency_withdraw']); ?> <span class="small-text">Toman</span> -&gt; 1$ <span class="small-text">Perfect Money</span></span>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="amount" class="inp">
                                                                                    <input type="tel" id="amount"
                                                                                        name="amount" placeholder="&nbsp;">
                                                                                    <span class="label">Amount</span>
                                                                                    <span class="border"></span>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="second_password" class="inp">
                                                                                    <input type="tel" id="second_password"
                                                                                        name="second_password" placeholder="&nbsp;">
                                                                                    <span class="label">Second Password</span>
                                                                                    <span class="border"></span>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-12">
                                                                            <div class="text-center">
                                                                                <button class="btn-main-success" id="btWithdraw"><?php echo WITHDRAW_CONFIRMATION; ?>&nbsp&nbsp<i class="fa fa-spinner fa-spin hide" aria-hidden="true" id='spexWithdraw'></i></button>
                                                                            </div>
                                                                        </div>
                                                                        <input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>"/>
                                                                        <input type="hidden" name="tab" value="<?php echo $_GET['tab']; ?>"/>
                                                                </from>
                                                            </div>
                                                            <div class="col-lg-7 text-right text-white" dir="rtl">
                                                            <?php
                                        $TITLE_CASHOUTS_DESC = str_replace("%s1", number_format($configDT[0]['currency_withdraw']), TITLE_CASHOUTS_DESC);
                                        echo $TITLE_CASHOUTS_DESC;?>
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
       

        $( "#btWithdraw" ).click(function() {

            if($('#amount').val() == ""){
                $('#amount').focus();
                return false;
            }

            if($('#second_password').val() == ""){
                $('#second_password').focus();
                return false;
            }

            $("#spexWithdraw").removeClass('hide');
            $('#btWithdraw').prop('disabled', true);
            $('#frm_cashouts').submit();

        });



    </script>
</body>

</html>