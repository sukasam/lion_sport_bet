<?php
    include_once("function/app_top.php");

     
    if($_GET['action'] === 'withdraw'){
        include_once("function/withdraw.php");
    }

    if(!isset($_GET['action'])){
        $_SESSION['errors_code'] = "";
    }

    $RecDataWithdraw = $db->select("SELECT * FROM withdraw_history WHERE player = '".$_SESSION['Player']."' AND withdraw_type = '2' ORDER BY id DESC");
    $RecWidraw = $db->select("SELECT count(*) as countW FROM `withdraw_history` WHERE `player` = '".$_SESSION['Player']."' AND `amount` >='750000'");
    $RecDataWithdrawStatus = $db->select("SELECT * FROM `withdraw_history` WHERE `player` = '".$_SESSION['Player']."' AND withdraw_type = '2' AND `status` = '0'");
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
			<section class="feature-area section-gap " id="withdraw">
				<div class="container card-content">					
					<?php if($configDT[0]['withdraw'] == 1){
                    ?>
                    <div class="row">
                        <div class="col-12 mb-20">
                            <h3 class="text-heading"><?php echo TOP_MENU_WITHDRAW_ONLINE;?></h3> 
                        </div>
                        <?php
                        //if($RecDataUser[0]['onlineCard'] == 0){
                            if($RecDataWithdrawStatus[0]['id'] == ""){
                            ?>
                        <?php if($_SESSION['errors_code'] != ""){?>
                            <div class="col-md-8 col-md-offset-2">
                                <div class="col-12 alert <?php echo $_SESSION['errors_code'];?> mb-20" id="mainAl">
                                    <?php echo $_SESSION['errors_msg'];?>
                                </div>
                            </div>
                        <?php }?>
                        <div class="col-md-8 col-md-offset-2" style="display:none;" id="packageSL">
                            <div class="col-12 alert alert-success mb-20">
                                <?php echo WITHDRAW_PACKAGE_SELECT;?> <span class="pkamount"></span> <?php echo WITHDRAW_PACKAGE_SELECT2;?>
                            </div>
                        </div>
						<div class="col-12 col-md-8 col-md-offset-2 justify-content-center text-center mb-40">
                             <button class="genric-btn success circle arrow mb-10" onClick="packageAmount('3000000')"><span style="padding-right: 10px;"><?php echo WITHDRAW_PACKAGE_3M;?></span><i class="fa fa-credit-card-alt" aria-hidden="true"></i></button> 
                            <!--<button class="genric-btn info circle arrow mb-10" onClick="packageAmount('2000000')"><span style="padding-right: 10px;"><?php echo WITHDRAW_PACKAGE_2M;?></span><i class="fa fa-credit-card-alt" aria-hidden="true"></i></button> 
                            <button class="genric-btn warning circle arrow mb-10" onClick="packageAmount('1500000')"><span style="padding-right: 10px;"><?php echo WITHDRAW_PACKAGE_1_5M;?></span><i class="fa fa-credit-card-alt" aria-hidden="true"></i></button> 
                            <button class="genric-btn danger circle arrow mb-10" onClick="packageAmount('1000000')"><span style="padding-right: 10px;"><?php echo WITHDRAW_PACKAGE_1M;?></span><i class="fa fa-credit-card-alt" aria-hidden="true"></i></button> 
                            <button class="genric-btn primary circle arrow mb-10" onClick="packageAmount('750000')"><span style="padding-right: 10px;"><?php echo WITHDRAW_PACKAGE_750K;?></span><i class="fa fa-credit-card-alt" aria-hidden="true"></i></button>    -->
                            <button class="genric-btn primary circle arrow mb-10" onClick="packageAmount('500000')"><span style="padding-right: 10px;"><?php echo WITHDRAW_PACKAGE_500K;?></span><i class="fa fa-credit-card-alt" aria-hidden="true"></i></button> 
                            <button class="genric-btn success circle arrow mb-10" onClick="packageAmount('200000')"><span style="padding-right: 10px;"><?php echo WITHDRAW_PACKAGE_200K;?></span><i class="fa fa-credit-card-alt" aria-hidden="true"></i></button>
                            <button class="genric-btn info circle arrow mb-10" onClick="packageAmount('100000')"><span style="padding-right: 10px;"><?php echo WITHDRAW_PACKAGE_100K;?></span><i class="fa fa-credit-card-alt" aria-hidden="true"></i></button>
                            <button class="genric-btn warning circle arrow mb-10" onClick="packageAmount('50000')"><span style="padding-right: 10px;"><?php echo WITHDRAW_PACKAGE_50K;?></span><i class="fa fa-credit-card-alt" aria-hidden="true"></i></button>
                            <button class="genric-btn danger circle arrow mb-10" onClick="packageAmount('30000')"><span style="padding-right: 10px;"><?php echo WITHDRAW_PACKAGE_30K;?></span><i class="fa fa-credit-card-alt" aria-hidden="true"></i></button>
                            <!-- <button class="genric-btn success circle arrow mb-10" onClick="packageAmount('20000')"><span style="padding-right: 10px;"><?php echo WITHDRAW_PACKAGE_20K;?></span><i class="fa fa-credit-card-alt" aria-hidden="true"></i></button>
                            <button class="genric-btn primary circle arrow mb-10" onClick="packageAmount('10000')"><span style="padding-right: 10px;"><?php echo WITHDRAW_PACKAGE_10K;?></span><i class="fa fa-credit-card-alt" aria-hidden="true"></i></button> -->
                        </div>
                        <div class="col-12 mb-40">
                            <form id="frm_deposit" name="frm_deposit" action="withdraw2.php?action=withdraw" method="post">
                            <div class="col-md-8 col-md-offset-2">
                                <!-- <div class="input-group form-group">
                                    <input type="password" class="form-control" placeholder="Pin Code" name="pin_code" id="pin_code" autocomplete="off" required>
                                </div> -->
                                <div class="input-group form-group justify-content-center">
                                    <img id="captcha" src="include/captcha.php" alt="CAPTCHA Image" class="img-thumbnail img-thumbnail-captcha">
                                </div>
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                    </div>
                                    <input type="password" class="form-control" placeholder="Secured Code" id="withdraw_captcha_code" name="withdraw_captcha_code" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="text-center">
                                <input type="hidden" name="amount" id="amount" value="0">
                                <input type="hidden" name="withdraw_type" id="withdraw_type" value="2">
                                <button class="genric-btn primary circle arrow" id="btWithdraw"><?php echo WITHDRAW_CONFIRMATION;?>&nbsp&nbsp<i class="fa fa-spinner fa-spin hide" aria-hidden="true" id='spexWithdraw'></i></button>
                            </div>
                            <input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>"/>
                            </form>
                        </div>
                            <?php
                            }else{
                                ?>
                                <div class="col-12 mb-40">
                                    <div class="text-center onlineCard"><br><?php echo TITLE_WITHDRAW_ONCE_APPLOVED;?><br><br></div>
                                </div>
                                <?php
                            }
                        /*}else{
                            ?>
                             <div class="col-12 mb-40">
                                <div class="text-center onlineCard"><br><?php echo TITLE_WITHDRAW_ONLINE_CARD;?><br><br>
                                    <a href="https://t.me/lionroyalsup" target="_blank" style="color: #FFFFFF;"><i class="fa fa-telegram fa-3x"></i></a>
                                </div>
                             </div>
                            <?php
                        }*/
                        ?>
                        <div class="col-12">
                            <h3 class="text-heading"><?php echo TITLE_WITHDRAW_HISTORY;?></h3> 
                        </div>
						<div class="col-12 mb-60">
                        <table id="withdrow" class="table table-striped table-bordered display responsive nowrap" style="width: 100%;">
                            <thead>
								<tr>
									<th>#</th>
                                    <th><?php echo TITLE_AMOUNT;?></th>
                                    <th class="text-center"><?php echo TITLE_DATE_TIME;?></th>
                                    <th><?php echo TITLE_TYPE;?></th>
                                    <th class="text-center"><?php echo TITLE_STATUS;?></th>
                                    <th class="text-center"><?php echo TITLE_ACTION;?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($RecDataWithdraw as $key => $value) {
                                   
                                    $dateTime =  date("m/d/Y", strtotime($value['date']))." ".$value['time'];
                                    $amountWithdraw = number_format($value['amount']);

                                    ?>
                                    <tr>
                                        <th><?php echo $key+1;?>.</th>
                                        <th><?php echo $amountWithdraw;?></th>
                                        <th class="text-center"><?php echo $dateTime;?></th>
                                        <th class="text-center"><?php echo 'Online Card';?></th>
                                        <th class="text-center"><?php if($value['status'] == 1){echo '<button class="genric-btn success circle" style="width: 60px;">Complated</button>';}else if($value['status'] == 2){echo '<button class="genric-btn danger circle" style="width: 60px;">Cancel</button>';}else{echo '<button class="genric-btn info circle" style="width: 60px;">Processing</button>';}?></th>
                                        <th class="text-center"><a href="javascript:void(0);" onClick="showDetail('<?php echo $amountWithdraw;?>','<?php echo $value['withdraw_type'];?>','<?php if($value['status'] == "1"){echo $value['evoucher'];}?>','<?php if($value['status'] == "1"){echo $value['activation_code'];}?>','<?php echo $dateTime;?>');"><i class="fa fa-info-circle" style="font-size: 3.3em;color: #ffb320;"></i></a>&nbsp&nbsp&nbsp&nbsp&nbsp<a href="https://t.me/lionroyalsup" target="_blank"><i class="fa fa-telegram fa-3x" style="color: #FFFFFF;"></i></a>
                                        </th>
                                    </tr>
                                 <?php }?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo TITLE_AMOUNT;?></th>
                                    <th class="text-center"><?php echo TITLE_DATE_TIME;?></th>
                                    <th><?php echo TITLE_TYPE;?></th>
                                    <th class="text-center"><?php echo TITLE_STATUS;?></th>
                                    <th class="text-center"><?php echo TITLE_ACTION;?></th>
                                </tr>
                            </tfoot>
                        </table>					
                        </div>
					</div>
                    <?php
                    }else{
                    ?>
                    <div class="text-center invite-desc">
                        <div class="mb-30"><?php echo TITLE_WITHDRAW_CLOSE;?></div>
                        <div class="text-center">
                            <a href="https://t.me/lionroyalsup" target="_blank" style="color: #FFFFFF;"><i class="fa fa-telegram fa-3x"></i></a>
                        </div>
                    </div>
                    <?php
                    }?>
				</div>	
			</section>
			<!-- End feature Area -->

        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Withdrow (<span id="dateTimeWithdraw"></span>)</h5>
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

        <?php include_once("footer.php");?>	
        
        <?php include_once("footer_script.php");?>	
        
        <script>
        

        function packageAmount(amount){
           if(amount == "3000000"){$(".pkamount").html("3 MIL");$("#amount").val('<?php echo encode('3000000',KEY_HASH);?>');}
           else if(amount == "2000000"){$(".pkamount").html("2 MIL");$("#amount").val('<?php echo encode('2000000',KEY_HASH);?>');}
           else if(amount == "1500000"){$(".pkamount").html("1.5 MIL");$("#amount").val('<?php echo encode('1500000',KEY_HASH);?>');}
           else if(amount == "1000000"){$(".pkamount").html("1 MIL");$("#amount").val('<?php echo encode('1000000',KEY_HASH);?>');}
           else if(amount == "750000"){$(".pkamount").html("750K");$("#amount").val('<?php echo encode('750000',KEY_HASH);?>');}
           else if(amount == "500000"){$(".pkamount").html("500K");$("#amount").val('<?php echo encode('500000',KEY_HASH);?>');}
           else if(amount == "200000"){$(".pkamount").html("200K");$("#amount").val('<?php echo encode('200000',KEY_HASH);?>');}
           else if(amount == "100000"){$(".pkamount").html("100K");$("#amount").val('<?php echo encode('100000',KEY_HASH);?>');}
           else if(amount == "50000"){$(".pkamount").html("50K");$("#amount").val('<?php echo encode('50000',KEY_HASH);?>');}
           else if(amount == "30000"){$(".pkamount").html("30K");$("#amount").val('<?php echo encode('30000',KEY_HASH);?>');}
           else if(amount == "20000"){$(".pkamount").html("20K");$("#amount").val('<?php echo encode('20000',KEY_HASH);?>');}
           else if(amount == "10000"){$(".pkamount").html("10K");$("#amount").val('<?php echo encode('10000',KEY_HASH);?>');}
           else{$("#amount").val('<?php echo encode('0',KEY_HASH);?>');}
           $("#packageSL").show();
           $("#mainAl").hide();
        }

        function showDetail(amount,withdrawType,evoucher,activation,datetime){

            var wType = "";
            if(withdrawType == '1'){
                wType = 'E-Voucher';
            }else{
                wType = 'Online Card';
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

                
                if($('#pin_code').val() == ""){
                    $('#pin_code').focus();
                    return false;
                }

                if($('#withdraw_captcha_code').val() == ""){
                    $('#withdraw_captcha_code').focus();
                    return false;
                }

                $("#spexWithdraw").removeClass('hide');
                $('#btWithdraw').prop('disabled', true);

                // $("#pin_code").attr("disabled",true);
                // $("#withdraw_captcha_code").attr("disabled",true);

                $('#frm_deposit').submit();
                //alert( "Handler for .click() called." );
            });
            

        } );

        </script>

	</body>
</html>