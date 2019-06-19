<?php
    include_once("function/app_top.php");

    if($_GET['action'] === 'changePass'){
		include_once("function/change_pass.php");	
    }
    
    if(!isset($_GET['action'])){
        $_SESSION['errors_code'] = "";
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
			<section class="feature-area section-gap " id="secvice">
				<div class="container card-content">					
					<div class="row">
                        <div class="col-12">
                            <h3 class="text-heading">Change Password</h3> 
                        </div>
						<div class="col-12">
                            <div class="text-center"> 
                            <?php echo TITLE_CHANGE_PASS_DETAIL;?>
                            </div>						
						</div>
                    </div>
                    <form id="frm_login" name="frm_login" action="change_password.php?action=changePass" method="post">
					<div class="row section-top-border">
                        <div class="col-md-8 col-md-offset-2">
                            <?php if($_SESSION['errors_code'] != ""){?>
                            <div class="alert <?php echo $_SESSION['errors_code'];?>">
                                <?php echo $_SESSION['errors_msg'];?>
                            </div>
                            <?php }?>
                            <div class="form-group"><label><?php echo TITLE_CURRENT_PASSWORD;?>:</label>
                                <input type="password" name="old_password" class="form-control" placeholder="<?php echo TITLE_CURRENT_PASSWORD;?>" required>
                            </div>
                            <div class="form-group"><label><?php echo TITLE_NEW_PASSWORD;?>:</label>
                                <input type="password" name="new_password" class="form-control" placeholder="<?php echo TITLE_NEW_PASSWORD;?>" required>
                            </div>
                            <div class="form-group"><label><?php echo TITLE_CONFIRM_NEW_PASSWORD;?>:</label>
                                <input type="password" name="retype_new_password" class="form-control" placeholder="<?php echo TITLE_CONFIRM_NEW_PASSWORD;?>" required>
                            </div>
                            <div class="text-center">
                                <button class="genric-btn primary circle arrow" type="submit"><?php echo TITLE_CONFIRMATION;?></button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>"/>
                    </form>
				</div>	
			</section>
			<!-- End feature Area -->
        </div>

        <?php include_once("footer.php");?>	
        
		<?php include_once("footer_script.php");?>	
	</body>
</html>