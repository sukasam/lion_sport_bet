<?php

 include_once("function/app_top.php");

 
 if($_GET['action'] === 'evoucher'){
     $_SESSION['errors_code'] = "";
     include_once("function/deposit.php");
 }


 if(!isset($_GET['action'])){
    $_SESSION['errors_code'] = "";
    
 }

 $RecDataBank = $db->select("SELECT bank_card,bank_name FROM bank_info WHERE player = '".$_SESSION['Player']."'  ORDER BY id DESC");
 $RecDataDeposit = $db->select("SELECT * FROM deposit_history WHERE player = '".$_SESSION['Player']."' AND deposit_type = 'E-Voucher' ORDER BY id DESC");
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
                            <h3 class="text-heading"><?php echo TOP_MENU_DEPOSIT_EV;?></h3> 
                        </div>
                        
						<div class="col-12 mb-60" id="aTab">
                        <form id="frm_deposit" name="frm_deposit" action="deposit.php?action=evoucher" method="post">
                            <?php //if($RecDataUser[0]['onlineCard'] == 0){
                               // if($_SESSION['Player'] == "adminT-T" || $_SESSION['Player'] == "roxy"){    
                            ?>
                            <div class="col-md-8 col-md-offset-2">
                                <?php if($_SESSION['errors_code'] != ""){?>
                                <div class="alert <?php echo $_SESSION['errors_code'];?>">
                                    <?php echo $_SESSION['errors_msg'];?>
                                </div>
                                <?php }?>
                                <div class="col-12 mb-30 text-center"><?php echo TITLE_DEPOSIT_DESC?></div>
                                <div class="row mb-20">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>E-Voucher:</label>
                                            <input type="text" value="" name="e_voucher" id="e_voucher" class="form-control" placeholder="E-Voucher" autofocus="" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Activation Code:</label>
                                            <input type="text" value="" name="activation_code" id="activation_code" class="form-control parsley-validated" placeholder="Activation Code" autofocus="" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-group form-group justify-content-center">
                                            <img id="captcha" src="include/captcha.php" alt="CAPTCHA Image" class="img-thumbnail img-thumbnail-captcha">
                                        </div>
                                        <div class="input-group form-group">
                                            <div class="input-group-prepend">
                                            </div>
                                            <input type="password" class="form-control" placeholder="Secured Code" name="deposit_captcha_code" id="deposit_captcha_code" autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                <button class="genric-btn primary circle arrow" id="btDeposit"><?php echo WITHDRAW_CONFIRMATION;?>&nbsp&nbsp<i class="fa fa-spinner fa-spin hide" aria-hidden="true" id='spexDeposit'></i></button>
                                </div>
                            </div>	
                            <?php 
                           /* }else {
                                ?>
                                <div class="text-center onlineCard"><br><?php echo TITLE_DEPOSIT_EV_CARD;?><br><br>
                    <a href="https://t.me/lionroyalsup" target="_blank" style="color: #FFFFFF;"><i class="fa fa-telegram fa-3x"></i></a>
                    </div>
                                <?php
                            }*/?>	
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
                                    <th><?php if($value['deposit_type'] == "E-Voucher"){echo number_format($value['amount'] * $value['currency']);}else{echo number_format($value['amount']);}?></th>
                                    <th class="text-center"><?php echo date("m/d/Y", strtotime($value['date']));?> <?php echo $value['time'];?></th>
                                    <th class="text-center"><?php echo $value['deposit_type'];?></th>
                                    <th class="text-center"><?php echo $value['tran_id'];?></th>
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
            $("#amount").val(amount);
            if(amount == "500000"){$(".pkamount").html("500K");}
            if(amount == "200000"){$(".pkamount").html("200K");}
            if(amount == "100000"){$(".pkamount").html("100K");}
            if(amount == "50000"){$(".pkamount").html("50K");}
            if(amount == "30000"){$(".pkamount").html("30K");}
            if(amount == "20000"){$(".pkamount").html("20K");}
            if(amount == "10000"){$(".pkamount").html("10K");}
            if(amount == "5000"){$(".pkamount").html("5K");}
            if(amount == "2000"){$(".pkamount").html("2K");}
            if(amount == "1000"){$(".pkamount").html("1K");}
            $("#packageSL").show();
            $("#mainAl").hide();
        }

        $(document).ready(function() {
            $('#deposit').DataTable();
        } );

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