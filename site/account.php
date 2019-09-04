<?php

    include_once("function/app_top.php");
    
	if($_GET['action'] === 'account_info'){
        $_SESSION['errors_code0'] = "";
        $_SESSION['errors_code1'] = "";
        $_SESSION['errors_code2'] = "";
        include_once("function/account_info.php");	
    }
    
    if($_GET['action'] === 'bank_info'){
        $_SESSION['errors_code'] = "";
        $_SESSION['errors_code1'] = "";
        $_SESSION['errors_code2'] = "";
        include_once("function/bank_info.php");	
    }
    
    if(!isset($_GET['action'])){
        $_SESSION['errors_code'] = "";
        $_SESSION['errors_code1'] = "";
        $_SESSION['errors_code2'] = "";
    }

    $realName = explode(" ",$RecDataUserProfile[0]['RealName']);

    $RecData = $db->select("SELECT * FROM bank_info WHERE player = '".$_SESSION['Player']."' ORDER BY id DESC");
    //$RecTophand = $db->select("SELECT COUNT(*) as count FROM `top_hand` WHERE `player` = '".$_SESSION['Player']."'");
    //$RecToplost = $db->select("SELECT SUM(point) as point FROM `top_lost` WHERE `player` = '".$_SESSION['Player']."'");
    $RecDataPoint = $db->select("SELECT * FROM point_history WHERE player = '".$_SESSION['Player']."' ORDER BY id DESC");
    
   
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
			<section class="feature-area section-gap ">
				<div class="container card-content">					
					<div class="row">
                        <div class="col-12">
                            <h3 class="text-heading"><?php echo TITLE_YOUR_ACCOUNT;?></h3> 
                        </div>
                        <div class="col-12 mb-30 text-center"><?php echo TITLE_YOUR_ACCOUNT_DESC;?></div>
                        <div class="col-12 mb-60">
                            <form id="frm_account" name="frm_account" action="account.php?action=account_info" method="post">
                                <div class="col-md-8 col-md-offset-2">
                                <?php if($_SESSION['errors_code'] != ""){?>
                                <div class="alert <?php echo $_SESSION['errors_code'];?>">
                                    <?php echo $_SESSION['errors_msg'];?>
                                </div>
                                <?php }?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo TITLE_NAME;?>:</label>
                                                <input type="text" value="<?php echo $realName[0];?>" name="account_fname" class="form-control" placeholder="<?php echo TITLE_NAME;?>" autofocus required <?php if($realName[0] != ""){echo "readonly";}?>>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo TITLE_FAMILY_NAME;?>:</label>
                                                <input type="text" value="<?php echo $realName[1];?>" name="account_lname" class="form-control parsley-validated" placeholder="<?php echo TITLE_FAMILY_NAME;?>" autofocus required <?php if($realName[0] != ""){echo "readonly";}?>>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-20">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo TITLE_EMAIL;?>:</label>
                                                <input type="text" value="<?php echo $_SESSION['Player_Email'];?>" name="account_email" class="form-control" placeholder="<?php echo TITLE_EMAIL;?>" autofocus required <?php if($realName[0] != ""){echo "readonly";}?>>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo TITLE_PHONE_NUMBER;?>:</label>
                                                <input type="text" value="<?php echo $_SESSION['Player_Phone'];?>" name="account_phone" class="form-control parsley-validated" placeholder="<?php echo TITLE_PHONE_NUMBER;?>r" autofocus required <?php if($realName[0] != ""){echo "readonly";}?>>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                    if($realName[0] === ""){
                                    ?>
                                    <div class="text-center">
                                    <button class="genric-btn primary circle arrow" type="submit"><?php echo TITLE_CONFIRMATION;?></button>
                                    </div>
                                    <?php }?>
                                </div>		
                            <input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>"/>
                            </form>
                        </div>
                        <div class="col-12">
                            <h3 class="text-heading"><?php echo TITLE_YOUR_BANK;?></h3> 
                        </div>
						<div class="col-12 mb-60">
                            <form id="frm_bank" name="frm_bank" action="account.php?action=bank_info" method="post">
                                <div class="col-md-8 col-md-offset-2">
                                <?php if($_SESSION['errors_code1'] != ""){?>
                                <div class="alert <?php echo $_SESSION['errors_code1'];?>">
                                    <?php echo $_SESSION['errors_msg1'];?>
                                </div>
                                <?php }?>
                                    
                                    <div class="row">
                                        <div class="col-md-5 col-md-offset-1">
                                            <div class="form-group">
                                                <label><?php echo TITLE_SHABA;?>:</label>
                                                <input type="text" value="<?php echo $RecData[0]['bank_sheba'];?>" name="account_bank_sheba" class="form-control" placeholder="Bank Number shaba 24 digits" autofocus required maxlength="24" <?php if($RecData[0]['bank_sheba'] != ""){echo "readonly";}?>>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label><?php echo TITLE_CARD_NUMBER;?>:</label>
                                                <input type="text" value="<?php echo $RecData[0]['bank_card'];?>" name="account_bank_card" class="form-control parsley-validated" placeholder="16-digit card number" autofocus required maxlength="16" <?php if($RecData[0]['bank_sheba'] != ""){echo "readonly";}?>>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo TITLE_BANK_NAME;?> :</label>
                                        <!-- <select id="account_bank_name" name="account_bank_name" class="form-control">
                                            <option value="0">انتخاب بانک</option>
                                            <option value="1">ملت</option>
                                            <option value="2">ملّي ايران</option>
                                            <option value="3">ايران زمين</option>
                                            <option value="4">صادرات</option>
                                            <option value="5">اقتصاد نوين</option>
                                            <option value="6">پاسارگاد</option>
                                            <option value="7">تجارت</option>
                                            <option value="8">پارسيان</option>
                                            <option value="9">شهر</option>
                                            <option value="10">آينده</option>
                                            <option value="11">سپه</option>
                                            <option value="12">توسعه صادرات ايران</option>
                                            <option value="13">صنعت و معدن</option>
                                            <option value="14">کشاورزي</option>
                                            <option value="15">مسکن</option>
                                            <option value="16">پست ايران</option>
                                            <option value="17">توسعه تعاون</option>
                                            <option value="18">کارآفرين</option>
                                            <option value="19">سامان</option>
                                            <option value="20">سينا</option>
                                            <option value="21">سرمايه</option>
                                            <option value="22">دي</option>
                                            <option value="23">رفاه</option>
                                            <option value="24">حکمت ايرانيان</option>
                                            <option value="25">گردشگري</option>
                                            <option value="26">قوامين</option>
                                            <option value="27">انصار</option>
                                            <option value="28">خاور ميانه</option>
                                        </select> -->
                                        <input type="text" value="<?php echo $RecData[0]['bank_name'];?>" name="account_bank_name" class="form-control parsley-validated" placeholder="Bank name" autofocus required <?php if($RecData[0]['bank_sheba'] != ""){echo "readonly";}?>>
                                    </div>
                                    <div class="form-group mb-20">
                                        <label><?php echo TITLE_NAME_ACCOUNT;?> :</label>
                                        <input type="text" value="<?php echo $RecData[0]['fullname'];?>" name="account_bank_fullname" class="form-control parsley-validated" placeholder="Account Holder Name (Please Type in Persian)" autofocus required <?php if($RecData[0]['bank_sheba'] != ""){echo "readonly";}?>>
                                    </div>
                                    <?php 
                                    if($RecData[0]['bank_sheba'] == ""){
                                    ?>
                                    <div class="text-center">
                                    <button class="genric-btn primary circle arrow" type="submit"><?php echo TITLE_CONFIRMATION;?></button>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>	
                            <input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>"/>
                            </form>			
                        </div>	
																	
					</div>
				</div>	
			</section>
			<!-- End feature Area -->
        </div>

        <?php include_once("footer.php");?>	
        
		<?php include_once("footer_script.php");?>	

                
        <script>
        $(document).ready(function() {

            $('#point').DataTable(
                /*responsive: true*/
            );

        } );

        function exchangePoint(ref,amount,player){

            var request;

            if(ref == 1){

            }else if(ref == 2){

                $("#spexTopwin").removeClass('hide');
                $('#exTopwin').prop('disabled', true);

                 // Serialize the data in the form
                var serializedData = $('#frmTopwin').serialize();

            // console.log(JSON.stringify(formVel));

            }else if(ref == 3){

            }

            // Abort any pending request
            if (request) {
                request.abort();
            }

            console.log(serializedData);

            // Fire off the request to /form.php
            request = $.ajax({
                url: "./function/exchange2.php",
                type: "post",
                data: serializedData
            });
            

            //Callback handler that will be called on success
            request.done(function (response, textStatus, jqXHR){
                // Log a message to the console
                console.log("Hooray, it worked! "+response);
            });

            // // Callback handler that will be called on failure
            request.fail(function (jqXHR, textStatus, errorThrown){
                // Log the error to the console
                console.error("The following error occurred: "+textStatus+" "+errorThrown);
            });

        }

        </script>
	</body>
</html>