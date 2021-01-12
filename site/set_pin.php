<?php
    include_once("function/app_top.php");
    if($_GET['action'] === 'pinset'){
        include_once("function/pinset.php");	
    }
    if(!isset($_GET['action'])){
        $_SESSION['errors_code'] = "";
        if($apiUserNote->Note != ""){
            header("Location:index.php");
        }
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
                        <div class="col-12 mb-40">
                            <h3 class="text-heading">PIN code</h3> 
                        </div>
						<div class="col-12">
                            <form id="frm_ticket" name="frm_ticket" action="set_pin.php?action=pinset" method="post">
                                <div class="col-md-8 offset-md-2">
                                    <div class="headTitlePage text-center mb-20">4 digit PIN code</div>
                                    <?php if($_SESSION['errors_code'] != ""){?>
                                    <div class="alert <?php echo $_SESSION['errors_code'];?>">
                                        <?php echo $_SESSION['errors_msg'];?>
                                    </div>
                                    <?php }?>
                                    <?php 
                                        if($_GET['action'] != "success"){
                                            ?>
                                            <div class="row mb-20">
                                                <div class="col-12">
                                                    <div class="text-center mb-20"><?php echo TITLE_PINS_01;?></div>
                                                    <div class="form-group">
                                                        <input type="text" value="" name="pincode" class="form-control text-center" placeholder="((PIN code))" required="" autocomplete="off" maxlength="4">
                                                    </div>
                                                    <div class="text-center mb-20"><?php echo TITLE_PINS_02;?></div>
                                                    <div class="col-12 text-center mb-20"><button class="genric-btn primary circle arrow" type="submit">Confirmation</button></div>
                                                </div>
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
	</body>
</html>