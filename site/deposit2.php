<?php

 include_once("function/app_top.php");
 

 if($_GET['action'] === 'onlinecard'){
    $_SESSION['errors_code1'] = "";
    include_once("function/deposit_onlinecard.php");	
 }


 if(!isset($_GET['action'])){
    $_SESSION['errors_code1'] = "";
 }

 $RecDataBank = $db->select("SELECT bank_card,bank_name FROM bank_info WHERE player = '".$_SESSION['Player']."'  ORDER BY id DESC");
 
 $RecDataDeposit = $db->select("SELECT * FROM deposit_history WHERE player = '".$_SESSION['Player']."' AND deposit_type = 'Online Card' ORDER BY id DESC");

 $RecDataUser = $db->select("SELECT * FROM user_profile WHERE Player = '".$_SESSION['Player']."'");


?>
<!DOCTYPE html>
	<html lang="en" class="no-js">
    <?php include_once("header.php");?>
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
                <?php include_once("topmenu.php");?>
			</section>		
            <!-- End banner Area -->
            
            <!-- About Generic Start -->
		<div class="main-wrapper ">
            <!-- Start feature Area -->
			<section class="feature-area section-gap " id="secvice">
				<div class="container card-content">					
					<div class="row">
                        <div class="col-12 mb-40">
                            <h3 class="text-heading"><?php echo TOP_MENU_DEPOSIT_ONLINE;?></h3> 
                            <center>
                            <p><?php echo TITLE_DEPOSIT_ONLINE_ANO1;?></p>
                            <p><?php echo TITLE_DEPOSIT_ONLINE_ANO2;?></p>
                            </center>
                        </div>
                        
                        <div id="bTab" class="col-12 mb-60">
                        <form id="frm_deposit" name="frm_deposit" action="deposit2.php?action=onlinecard" method="post">
                            <?php if($RecDataUser[0]['onlineCard'] == 1){
                               // if($_SESSION['Player'] == "adminT-T" || $_SESSION['Player'] == "roxy"){    
                            ?>
                            <div class="col-md-8 col-md-offset-2">
                                <?php if($_SESSION['errors_code1'] != ""){?>
                                <div class="alert <?php echo $_SESSION['errors_code1'];?>">
                                    <?php echo $_SESSION['errors_msg1'];?>
                                </div>
                                <?php }?>
                                <div class="row mb-20">
                                    <div class="col-12 alert alert-success mb-20" style="display:none;" id="packageSL">
                                        You have selected <span class="pkamount"></span> Toman package.
                                    </div>
                                    <div class="col-12 justify-content-center text-center mb-20">
                                        <input type="hidden" name="amount" id="amount" value="0">
                                        <!-- <div class="form-group">
                                            <label>Amount:</label>
                                            <input id="deposit_c_o_amount" name="deposit_c_o_amount" type="text" placeholder="حداقل خرید ۵ هزار تومان - حداکثر خرید ۵۰ هزار تومان" class="form-control" maxlength="5" required="" autocomplete="off">
                                        </div> -->
                                        <button class="genric-btn primary circle arrow mb-10" onClick="packageAmount('500000')"><span style="padding-right: 10px;">500K</span><i class="fa fa-credit-card-alt" aria-hidden="true"></i></button> 
                                        <button class="genric-btn success circle arrow mb-10" onClick="packageAmount('200000')"><span style="padding-right: 10px;">200K</span><i class="fa fa-credit-card-alt" aria-hidden="true"></i></button>
                                        <button class="genric-btn info circle arrow mb-10" onClick="packageAmount('100000')"><span style="padding-right: 10px;">100K</span><i class="fa fa-credit-card-alt" aria-hidden="true"></i></button>
                                        <button class="genric-btn primary circle arrow mb-10" onClick="packageAmount('50000')"><span style="padding-right: 10px;">50K</span><i class="fa fa-credit-card-alt" aria-hidden="true"></i></button>
                                        <button class="genric-btn info circle arrow mb-10" onClick="packageAmount('30000')"><span style="padding-right: 10px;">30K</span><i class="fa fa-credit-card-alt" aria-hidden="true"></i></button>
                                        <button class="genric-btn danger circle arrow mb-10" onClick="packageAmount('20000')"><span style="padding-right: 10px;">20K</span><i class="fa fa-credit-card-alt" aria-hidden="true"></i></button>
                                        <button class="genric-btn success circle arrow mb-10" onClick="packageAmount('10000')"><span style="padding-right: 10px;">10K</span><i class="fa fa-credit-card-alt" aria-hidden="true"></i></button>
                                        <button class="genric-btn info circle arrow mb-10" onClick="packageAmount('5000')"><span style="padding-right: 10px;">5K</span><i class="fa fa-credit-card-alt" aria-hidden="true"></i></button>
                                        <button class="genric-btn danger circle arrow mb-10" onClick="packageAmount('2000')"><span style="padding-right: 10px;">2K</span><i class="fa fa-credit-card-alt" aria-hidden="true"></i></button>
                                        <?php if($_SESSION['Player'] == "adminT-T" || $_SESSION['Player'] == "roxy"){?>
                                        <!-- <button class="genric-btn success circle arrow mb-10" onClick="packageAmount('1000')"><span style="padding-right: 10px;">1K</span><i class="fa fa-credit-card-alt" aria-hidden="true"></i></button> -->
                                        <?php }?>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label><?php echo TITLE_CARD_NUMBER;?>:</label>
                                            <input name="card_number" type="text" class="form-control" maxlength="16" value="<?php echo $RecDataBank[0]['bank_card'];?>" required="" autocomplete="off">
                                            <input type="hidden" name="deposit_card_number" value="<?php echo $RecDataBank[0]['bank_card'];?>">
                                            <input type="hidden" name="deposit_bankname" value="<?php echo $RecDataBank[0]['bank_name'];?>">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label><?php echo TITLE_PIN2;?>:</label>
                                            <input name="deposit_card_pin" type="password" class="form-control" required="" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-6">
                                        <div class="form-group">
                                            <label><?php echo TITLE_MONTH_EXP;?>:</label>
                                            <input name="deposit_card_mexp" type="text" class="form-control" maxlength="2" required="" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-6">
                                        <div class="form-group">
                                            <label><?php echo TITLE_YEAR_EXP;?>:</label>
                                            <input name="deposit_card_yexp" type="text" class="form-control" maxlength="2" required="" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-12 mb-20">
                                        <div class="form-group">
                                            <label>Cvv2:</label>
                                            <input name="deposit_card_ccv2" type="password" class="form-control" required="" autocomplete="off">
                                        </div>
                                    </div>
                                    <!-- <div class="col-12" style="display:none;">
                                        <div class="input-group form-group justify-content-center">
                                            <img id="captcha" src="include/captcha.php?v=<?php echo date("YmdHis");?>" alt="CAPTCHA Image" class="img-thumbnail img-thumbnail-captcha">
                                        </div>
                                        <div class="input-group form-group">
                                            <div class="input-group-prepend">
                                            </div>
                                            <input type="password" class="form-control" placeholder="Secured Code" name="deposit2_captcha_code" id="deposit2_captcha_code" autocomplete="off" required>
                                            <input type="hidden" name="paymentLevel" value="<?php echo $api3->Permissions;?>">
                                        </div>
                                    </div> -->
                                </div>
                                <div class="text-center">
                                <button class="genric-btn primary circle arrow" id="btDeposit"><?php echo WITHDRAW_CONFIRMATION;?>&nbsp&nbsp<i class="fa fa-spinner fa-spin hide" aria-hidden="true" id='spexDeposit'></i></button>
                                </div>
                            </div>
                                <?php }else {
                                    ?>
                                    <div class="text-center onlineCard"><br><?php echo TITLE_DEPOSIT_ONLINE_CARD;?><br><br>
                        <a href="https://t.me/lionroyalsup" target="_blank" style="color: #FFFFFF;"><i class="fa fa-telegram fa-3x"></i></a>
                        </div>
                                    <?php
                                }?>
                                <input type="hidden" name="paymentLevel" value="<?php echo encode($api3->Permissions,KEY_HASH);?>">
                                <input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>"/>
                        </form>
                        </div>	
                        <div class="col-12">
                            <h3 class="text-heading"><?php echo TITLE_DEPOSIT_HISTORY;?></h3> 
                        </div>
						<div class="col-12 mb-60">
                        <table id="deposit" class="table table-striped table-bordered display responsive nowrap" style="width: 100%;">
                            <thead>
								<tr>
									<th>#</th>
                                    <th><?php echo TITLE_AMOUNT;?></th>
                                    <th class="text-center"><?php echo TITLE_DATE_TIME;?></th>
                                    <th class="text-center"><?php echo TITLE_TYPE;?></th>
                                    <th class="text-center"><?php echo TITLE_TRANID;?></th>
                                    <th class="text-center"><?php echo TITLE_STATUS;?></th>
                                    <!-- <th class="text-center">Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach ($RecDataDeposit as $key => $value) {
                                ?>
                                <tr>
									<th><?php echo $key+1;?>.</th>
                                    <th><?php if($value['deposit_type'] == "E-Voucher"){echo number_format($value['amount'] * $configDT[0]['currency']);}else{echo number_format($value['amount']);}?></th>
                                    <th class="text-center"><?php echo date("m/d/Y", strtotime($value['date']));?> <?php echo $value['time'];?></th>
                                    <th class="text-center"><?php echo $value['deposit_type'];?></th>
                                    <th class="text-center"><?php echo substr($value['tran_id'],0,12);?></th>
                                    <th class="text-center"><?php if($value['status'] == 1){echo '<button class="genric-btn success circle" style="width: 80px;">'.TITLE_COMPLATED.'</button>';}else if($value['status'] == 2){echo '<button class="genric-btn danger circle" style="width: 80px;">'.TITLE_CANCEL.'</button>';}else{echo '<button class="genric-btn info circle" style="width: 80px;">'.TITLE_PROCESSING.'</button>';}?></th>
                                    <!-- <th class="text-center"><a href="javascript:void(0);" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-info-circle" style="font-size: 3.3em;color: #ffb320;"></i></a>&nbsp&nbsp&nbsp&nbsp&nbsp<a href="https://t.me/lionroyalsup" target="_blank"><i class="fa fa-telegram fa-3x" style="color: #FFFFFF;"></i></a> -->
                                </tr>
                                <?php }?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo TITLE_AMOUNT;?></th>
                                    <th class="text-center"><?php echo TITLE_DATE_TIME;?></th>
                                    <th class="text-center"><?php echo TITLE_TYPE;?></th>
                                    <th class="text-center"><?php echo TITLE_TRANID;?></th>
                                    <th class="text-center"><?php echo TITLE_STATUS;?></th>
                                    <!-- <th class="text-center">Action</th> -->
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

        <?php include_once("footer.php");?>	
        
        <?php include_once("footer_script.php");?>	
        
        <script>
        
        function packageAmount(amount){
            
            if(amount == "500000"){$(".pkamount").html("500K");$("#amount").val('<?php echo encode('500000',KEY_HASH);?>');}
            else if(amount == "200000"){$(".pkamount").html("200K");$("#amount").val('<?php echo encode('200000',KEY_HASH);?>');}
            else if(amount == "100000"){$(".pkamount").html("100K");$("#amount").val('<?php echo encode('100000',KEY_HASH);?>');}
            else if(amount == "50000"){$(".pkamount").html("50K");$("#amount").val('<?php echo encode('50000',KEY_HASH);?>');}
            else if(amount == "30000"){$(".pkamount").html("30K");$("#amount").val('<?php echo encode('30000',KEY_HASH);?>');}
            else if(amount == "20000"){$(".pkamount").html("20K");$("#amount").val('<?php echo encode('20000',KEY_HASH);?>');}
            else if(amount == "10000"){$(".pkamount").html("10K");$("#amount").val('<?php echo encode('10000',KEY_HASH);?>');}
            else if(amount == "5000"){$(".pkamount").html("5K");$("#amount").val('<?php echo encode('5000',KEY_HASH);?>');}
            else if(amount == "2000"){$(".pkamount").html("2K");$("#amount").val('<?php echo encode('2000',KEY_HASH);?>');}
            else if(amount == "1000"){$(".pkamount").html("1K");$("#amount").val('<?php echo encode('1000',KEY_HASH);?>');}
            else{
                $("#amount").val('<?php echo encode('0',KEY_HASH);?>');
            }
            $("#packageSL").show();
            $("#mainAl").hide();
        }

        $(document).ready(function() {
            $('#deposit').DataTable(
                /*responsive: true*/
            );

        } );

        $( "#deposit2_captcha_code" ).keypress(function( event ) {
            if ( event.which == 13 ) {
                event.preventDefault();
            }
        });

        $("#btDeposit").click(function() {

            // if($('#deposit2_captcha_code').val() == ""){
            //     $('#deposit2_captcha_code').focus();
            //     return false;
            // }

            $("#spexDeposit").removeClass('hide');
            $('#btDeposit').prop('disabled', true);

            $('#frm_deposit').submit();

        });

        </script>
	</body>
</html>