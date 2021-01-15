<?php

include_once "function/app_top.php";

if (isset($_GET['action']) && $_GET['action'] === 'cryptocurrency') {
    $_SESSION['errors_code'] = "";
    include_once "function/deposit2.php";
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
                            <h3 class="text-heading"><?php echo TOP_MENU_DEPOSITS." - ".TOP_MENU_DEPOSITS_CRYPTO; ?></h3>
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
                                                <span class="rate-span">  1$ <span class="small-text">Cryptocurrency</span> -&gt; <?php echo number_format($configDT[0]['currency_cc']);?> <span class="small-text">Toman</span></span>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Amount:</label>
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