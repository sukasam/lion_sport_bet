<?php
include_once "function/app_top.php";

if (isset($_GET['action']) && $_GET['action'] === 'withdraw') {
    include_once "function/withdraw.php";
}

if (isset($_GET['action']) && $_GET['action'] === 'SecondPassword') {
    include_once "function/secondpassword.php"; 
}

if (!isset($_GET['action'])) {
    $_SESSION['errors_code'] = "";
}

$RecDataWithdrawSQL = "SELECT * FROM withdraw_history WHERE player = ? AND withdraw_type = ? ORDER BY id DESC";
$values = array($_SESSION['Player'],'1');
$RecDataWithdraw = $model->doSelect($RecDataWithdrawSQL, $values);

// $RecDataWithdraw = $db->select("SELECT * FROM withdraw_history WHERE player = '".$_SESSION['Player']."' AND withdraw_type = '1' ORDER BY id DESC");
// $RecWidraw = $db->select("SELECT count(*) as countW FROM `withdraw_history` WHERE `player` = '".$_SESSION['Player']."' AND `amount` >='750000'");
// $RecDataWithdrawStatus = $db->select("SELECT * FROM `withdraw_history` WHERE `player` = '".$_SESSION['Player']."' AND withdraw_type = '1' AND `status` = '0'");
// $RecDataUser = $db->select("SELECT * FROM user_profile WHERE Player = '".$_SESSION['Player']."'");

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
			<section class="feature-area section-gap " id="withdraw">
				<div class="container card-content">
                    <div class="row">
                        <div class="col-12 mb-20">
                            <h3 class="text-heading"><?php echo TOP_MENU_CASHOUTS . " - " . TOP_MENU_DEPOSITS_PM_VOUCHER; ?></h3>
                        </div>

                        <div class="col-12 mb-40">
                            <form id="frm_cashouts" name="frm_cashouts" action="withdraw.php?action=withdraw" method="post">
                                <div class="row">
                                    <div class="col-md-5">
                                        <?php if ($_SESSION['errors_code'] != "") {?>
                                            <div class="col-12 alert <?php echo $_SESSION['errors_code']; ?> mb-20" id="mainAl">
                                                <?php echo $_SESSION['errors_msg']; ?>
                                            </div>
                                        <?php }?>
                                        <div class="text-center mb-20">
                                            <span class="rate-span"><?php echo number_format($configDT[0]['currency_withdraw']); ?> <span class="small-text">Toman</span> -&gt; 1$ <span class="small-text">Perfect Money</span></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Amount:</label>
                                            <input type="tel" class="form-control" placeholder="0" name="amount" id="amount" autocomplete="off" required onkeypress="return isNumberKey(event);">
                                        </div>
                                        <div class="form-group">
                                            <label>Second Password:</label>
                                            <input type="password" class="form-control" placeholder="Second Password" name="second_password" id="second_password" autocomplete="off" required onkeypress="return isNumberKey(event);">
                                        </div>
                                        <div class="form-group text-center">
                                        <button class="genric-btn primary circle arrow" id="btWithdraw"><?php echo WITHDRAW_CONFIRMATION; ?>&nbsp&nbsp<i class="fa fa-spinner fa-spin hide" aria-hidden="true" id='spexWithdraw'></i></button>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <?php
                                        $TITLE_CASHOUTS_DESC = str_replace("%s1", number_format($configDT[0]['currency_withdraw']), TITLE_CASHOUTS_DESC);
                                        echo $TITLE_CASHOUTS_DESC;?>
                                    </div>
                                </div>
                                <input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>"/>
                            </form>
                        </div>

                        <div class="col-12">
                            <h3 class="text-heading"><?php echo TITLE_CASHOUT_PM_VOUCHER_HISTORY; ?></h3>
                        </div>
						<div class="col-12 mb-60">
                        <table id="withdrow" class="table table-striped table-bordered display responsive nowrap" style="width: 100%;">
                            <thead>
								<tr>
									<th>#</th>
                                    <th><?php echo TITLE_AMOUNT; ?></th>
                                    <th class="text-center"><?php echo TITLE_DATE_TIME; ?></th>
                                    <!-- <th><?php echo TITLE_TYPE; ?></th> -->
                                    <th class="text-center"><?php echo TITLE_STATUS; ?></th>
                                    <th class="text-center"><?php echo TITLE_ACTION; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
if (!empty($RecDataWithdraw)) {
    foreach ($RecDataWithdraw as $key => $value) {

        $dateTime = date("m/d/Y", strtotime($value['date'])) . " " . $value['time'];
        $amountWithdraw = number_format($value['amount']);

        ?>
                                        <tr>
                                            <th><?php echo $key + 1; ?>.</th>
                                            <th><?php echo $amountWithdraw; ?></th>
                                            <th class="text-center"><?php echo $dateTime; ?></th>
                                            <!-- <th class="text-center"><?php echo 'E-Voucher'; ?></th> -->
                                            <th class="text-center"><?php if ($value['status'] == 1) {echo '<button class="genric-btn success circle" style="width: 130px;">Complated</button>';} else if ($value['status'] == 2) {echo '<button class="genric-btn danger circle" style="width: 130px;">Cancel</button>';} else {echo '<button class="genric-btn info circle" style="width: 130px;">Processing</button>';}?></th>
                                            <th class="text-center"><a href="javascript:void(0);" onClick="showDetail('<?php echo $amountWithdraw; ?>','<?php echo $value['withdraw_type']; ?>','<?php if ($value['status'] == "1") {echo $value['evoucher'];}?>','<?php if ($value['status'] == "1") {echo $value['activation_code'];}?>','<?php echo $dateTime; ?>');"><i class="fa fa-info-circle" style="font-size: 3.3em;color: #ffb320;"></i></a>&nbsp&nbsp&nbsp&nbsp&nbsp<a href="https://t.me/LionRoyalCasino" target="_blank"><i class="fa fa-telegram fa-3x" style="color: #FFFFFF;"></i></a>
                                            </th>
                                        </tr>
                                     <?php }
}
?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo TITLE_AMOUNT; ?></th>
                                    <th class="text-center"><?php echo TITLE_DATE_TIME; ?></th>
                                    <!-- <th><?php echo TITLE_TYPE; ?></th> -->
                                    <th class="text-center"><?php echo TITLE_STATUS; ?></th>
                                    <th class="text-center"><?php echo TITLE_ACTION; ?></th>
                                </tr>
                            </tfoot>
                        </table>
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
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo TOP_MENU_CASHOUTS;?> (<span id="dateTimeWithdraw"></span>)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="infoDetail" style="background-color: #DDDDDD;">

                </div>
                <div class="modal-footer" style="justify-content: center;">
                    <button type="button" class="btn genric-btn primary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>

        <?php include_once "footer.php";?>

        <?php include_once "footer_script.php";?>

        <script>

        function showDetail(amount,withdrawType,evoucher,activation,datetime){

            var wType = "";
            if(withdrawType == '1'){
                wType = 'Perfect Money Voucher';
            }else{
                wType = 'Perfect Money Direct';
            }

            var conDetail = '<span style="font-weight: bold;">Amount : </span>'+amount+' <span style="font-weight: bold;">Toman</span><br>';
                conDetail += '<span style="font-weight: bold;">Type : </span>'+wType+'<br>';
               if(evoucher != "" && activation != ""){
                conDetail += '<hr>';
                conDetail += '<span style="font-weight: bold;">E-Voucher : </span>'+evoucher+"<br>";
                conDetail += '<span style="font-weight: bold;">Activation Code : </span>'+activation+"<br>";
               }


            $("#infoDetail").html(conDetail);
            $("#dateTimeWithdraw").html(datetime);
            $("#exampleModal").modal('show');
        }

        $(document).ready(function() {

            $('#withdrow').DataTable(
                /*responsive: true*/
            );

            $( "#btWithdraw" ).click(function() {

                if($('#amount').val() == ""){
                    $('#amount').focus();
                    return false;
                }

                if($('#second_password').val() == ""){
                    $('#second_password').focus();
                    return false;
                }

                $('#frm_cashouts').submit();

                });


            } );

        </script>

	</body>
</html>