<?php
 include_once("function/app_top.php");
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
                        <div class="col-12 col-md-4 mb-20">
                            <div class="cardIndex">
                                <div class="card-wrapper">
                                    <div class="card-img">
                                    <a href="javascript:void(0);"><img src="img/Porker01.jpg" alt="Mobirise" title="" media-simple="true"></a>
                                    </div>
                                    <div class="card-box">
                                        <h4 class="card-title mb-20"><?php echo HOME_TOP_HAND;?></h4>
                                        <p class="mbr-text">
                                        <strong><?php echo HOME_TOP_HAND_DESC;?></strong><br>
                                        </p>
                                    </div>
                                    <div class="mbr-section-btn text-center"><a href="javascript:void(0);" class="genric-btn primary" style="width: 80%;"><?php echo HOME_SEE_MY_RANKING?></a></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-20">
                            <div class="cardIndex">
                                <div class="card-wrapper">
                                    <div class="card-img">
                                    <a href="javascript:void(0);"><img src="img/Porker02.jpg" alt="Mobirise" title="" media-simple="true"></a>
                                    </div>
                                    <div class="card-box">
                                        <h4 class="card-title mb-20"><?php echo HOME_TOP_WIN;?></h4>
                                        <p class="mbr-text">
                                        <strong><?php echo HOME_TOP_WIN_DESC;?></strong><br>
                                        </p>
                                    </div>
                                    <div class="mbr-section-btn text-center">
                                        <div class="row">
                                            <div class="col-6" style="text-align: right;">
                                                <a href="bet_lotorry.php" class="genric-btn primary" style="width: 80%;"><?php echo HOME_PLAY_NOW;?></a>
                                            </div>
                                            <div class="col-6" style="text-align: left;">
                                                <a href="bet_lotorry_history.php" class="genric-btn primary" style="width: 80%;"><?php echo HOME_SEE_RESULTS;?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-20">
                            <div class="cardIndex">
                                <div class="card-wrapper">
                                    <div class="card-img">
                                        <a href="javascript:void(0);"><img src="img/Porker03.jpg" alt="Mobirise" title="" media-simple="true"></a>
                                    </div>
                                    <div class="card-box">
                                        <h4 class="card-title mb-20"><?php echo HOME_TOP_LOST?></h4>
                                        <p class="mbr-text">
                                        <strong><?php echo HOME_TOP_LOST_DESC?></strong><br>
                                        </p>
                                    </div>
                                    <div class="mbr-section-btn text-center">
                                        <div class="row">
                                            <div class="col-6" style="text-align: right;">
                                                <a href="iranian_milioner.php" class="genric-btn primary" style="width: 80%;"><?php echo HOME_PLAY_NOW;?></a>
                                            </div>
                                            <div class="col-6" style="text-align: left;">
                                                <a href="iranian_milioner_results_history.php" class="genric-btn primary" style="width: 80%;"><?php echo HOME_SEE_RESULTS;?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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