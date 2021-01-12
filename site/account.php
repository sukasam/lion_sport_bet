<?php

    include_once("function/app_top.php");
    
	if(isset($_GET['action']) && $_GET['action'] === 'account_info'){
        $_SESSION['errors_code0'] = "";
        $_SESSION['errors_code1'] = "";
        $_SESSION['errors_code2'] = "";
        include_once("function/account_info.php");	
    }
    
    if(isset($_GET['action']) && $_GET['action'] === 'pm_info'){
        $_SESSION['errors_code'] = "";
        $_SESSION['errors_code1'] = "";
        $_SESSION['errors_code2'] = "";
        include_once("function/pm_info.php");	
    }
    
    if(!isset($_GET['action'])){
        $_SESSION['errors_code'] = "";
        $_SESSION['errors_code1'] = "";
        $_SESSION['errors_code2'] = "";
    }

    $RecDataSQL = "SELECT * FROM pm_info WHERE Player = ? ORDER BY id DESC";
    $values=array($_SESSION['Player']);
    $RecData = $model->doSelect($RecDataSQL,$values); 
    
    if(empty($RecData[0])){
        $RecData[0]['pm_account'] = '';
    }
   
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
                                <div class="col-md-8 offset-md-2">
                                <?php if($_SESSION['errors_code'] != ""){?>
                                <div class="alert <?php echo $_SESSION['errors_code'];?>">
                                    <?php echo $_SESSION['errors_msg'];?>
                                </div>
                                <?php }?>
                                    <!-- <div class="row">
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
                                    </div> -->
                                    <div class="row mb-20">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo TITLE_EMAIL;?>:</label>
                                                <input type="text" value="<?php echo $RecDataUserProfile[0]['Email'];?>" name="account_email" class="form-control" placeholder="<?php echo TITLE_EMAIL;?>" autofocus required <?php if(!empty($RecDataUserProfile[0]['Email'])){echo "readonly";}?>>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo TITLE_PHONE_NUMBER;?>:</label>
                                                <input type="text" value="<?php echo $RecDataUserProfile[0]['Telephone'];?>" name="account_phone" class="form-control parsley-validated" placeholder="<?php echo TITLE_PHONE_NUMBER;?>r" autofocus required <?php if(!empty($RecDataUserProfile[0]['Telephone'])){echo "readonly";}?>>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                    if(empty($RecDataUserProfile[0]['Email']) || empty($RecDataUserProfile[0]['Telephone'])){
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
                            <form id="frm_bank" name="frm_bank" action="account.php?action=pm_info" method="post">
                                <div class="col-md-8 offset-md-2">
                                <?php if($_SESSION['errors_code1'] != ""){?>
                                <div class="alert <?php echo $_SESSION['errors_code1'];?>">
                                    <?php echo $_SESSION['errors_msg1'];?>
                                </div>
                                <?php }?>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><?php echo TITLE_PM_ACCOUNT;?>:</label>
                                                <input type="text" value="<?php echo $RecData[0]['pm_account'];?>" name="pm_account" class="form-control parsley-validated" placeholder="Uxxxxxxxx" autofocus required <?php if(!empty($RecData[0]['pm_account'])){echo "readonly";}?>>
                                                <label class="pt-10"><?php echo TITLE_PM_ACCOUNT_DETAIL;?></label>
                                            </div>
                                        </div>
                                    </div>

                                    <?php 
                                    if(empty($RecData[0]['pm_account'])){
                                    ?>
                                        <div class="text-center">
                                        <button class="genric-btn primary circle arrow" type="submit"><?php echo TITLE_CONFIRMATION;?></button>
                                        </div>
                                    <?php }?>
                                    
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