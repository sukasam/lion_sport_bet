<?php include_once "function/app_top.php";
if (!isset($_GET['tab']) || $_GET['tab'] == "") {
    header("Location:withdraw_pm.php?tab=pm");
}


if (isset($_GET['action']) && $_GET['action'] === 'withdraw') {
    include_once "function/withdraw2.php";
}


if (!isset($_GET['action'])) {
    $_SESSION['errors_code'] = "";

}

$RecPMSQL = "SELECT * FROM pm_info WHERE player = ? AND `action` = ? ORDER BY id DESC";
$valuesPMSQL = array($_SESSION['Player'],'Enable');
$RecPM = $model->doSelect($RecPMSQL, $valuesPMSQL);

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
                                        <?php
                            
                                        if(empty($RecPM[0]['pm_account'])){
                                            $RecPM[0]['pm_account'] = "";
                                            ?>
                                            <div class="col-12 alert alert-danger mb-20">
                                                <span> Your Perfect Money account information is not registered. Please go here to register this information 
                                                    | <a class="orange-link" href="profile.php"> Register Perfect Money account information </a>
                                                </span>
                                            </div>
                                            <?php
                                        }
                                        ?>
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
                                                                
                                                            </div>
                                                            <div class="col-lg-7 text-right text-white" dir="rtl">
                                                            </div>
                                                            
                                                       </div>
                                                    </div>
                                                    <div class="theme-content-box <?php if ($_GET['tab'] === "cry") {echo "active";} else {echo "hide";}?>" id="dcry">
                                                        <div class="col-xs-12 m-t-10">
                                                            <div class="row">
                                                                <div class="col-lg-5 mb-20">
                                                                <form id="frm_cashouts" enctype="multipart/form-data" role='form' action="withdraw_pm2.php?tab=cry&action=withdraw" method="post">
                                                                        <div class="col-12 text-center mb-30">
                                                                            <span class="rate-span"><?php echo number_format($configDT[0]['currency_withdraw']); ?> <span class="small-text">Toman</span> -&gt; 1$ <span class="small-text">Perfect Money</span></span>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="pmaccount" class="inp">
                                                                                    <input type="tel" id="pmaccount"
                                                                                        name="pmaccount" placeholder="&nbsp;" 
                                                                                        value="<?php echo $RecPM[0]['pm_account'];?>"
                                                                                        readonly>
                                                                                    <span class="label">P.M Account</span>
                                                                                    <span class="border"></span>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="amount" class="inp">
                                                                                    <input type="tel" id="amount"
                                                                                        name="amount" placeholder="&nbsp;" 
                                                                                        value=""
                                                                                        >
                                                                                    <span class="label">Amount</span>
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
                                        echo TITLE_CASHOUTS_DESC_PM_ACCOUNT;?>
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

            $("#spexWithdraw").removeClass('hide');
            $('#btWithdraw').prop('disabled', true);
            $('#frm_cashouts').submit();

        });



    </script>
</body>

</html>