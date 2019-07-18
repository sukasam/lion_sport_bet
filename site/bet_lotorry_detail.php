<?php
    include_once("function/app_top.php");

    if(!isset($_GET['id']) || $_GET['id'] == ""){
        header("Location:".SiteRootDir."bet_lotorry.php");
    }

    $csrf = new csrf();
    
    // Generate Token Id and Valid
    $token_id = $csrf->get_token_id();
    $token_value = $csrf->get_token($token_id);

    $RecDataDrawPlay = $db->select("SELECT * FROM bet_lotorry_play WHERE id = '".$_GET['id']."'");
    $RecDataDrawResults = $db->select("SELECT * FROM bet_lotorry_play_results WHERE id = '".$RecDataDrawPlay[0]['id']."'");

    $date = date_create($RecDataDrawPlay[0]['around']);
    //08/30/2019 11:50 AM
    $dayMach = date_format($date,"l");
    $dayMachCheck = date_format($date,"l, d M Y");
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
                            <h3 class="text-heading"><?php echo HOME_BET_LOTORRY;?></h3> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="com_inner clr"><div class="com_heading"></div></div>                                     
                        </div>
                        <div class="col-12">
                            <div class="row mgL0 mgR0">
                                <div class="col-12 col-md-4 colLeft">
                                    <div class="jackpots">
                                        <h2>
                                            <span class="headline">This <?php echo $dayMach;?></span><br>
                                            <span class="amount amount_large"><?php echo $configDT[0]['lotorry_per_jackpot'];?></span>
                                        </h2><br><hr><br>
                                        <!-- <p class="raffle">Plus automatic entry into the Iranian Millionaire Maker</p> -->

                                        <p class="countdown hide_mobile">
                                            <span class="countdown_message">Game closes in:</span>
                                            <span class="countdown_wrapper clr">
                                                <span class="unit days">
                                                    <span class="number" style="font-size: 150%;"><?php echo $dayMachCheck;?></span>
                                                </span>
                                                
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-8 colRight pdB30">
                                    <form name="irnumber" id="irnumber" action="bet_lotorry.php?action=saveNumbers" method="post" onkeydown="return event.key != 'Enter';">
                                    <div class="row">
                                        <div class="col-9 gameOpen">
                                            <p class="heading_draw_based">
                                                <span class="sub_primary">Play Bet lotorry</span><br>
                                                <span class="sub_secondary">Choose 15 teams that you think are lucky.</span>
                                            </p>
                                        </div>
                                        <div class="col-3 gameOpen">
                                            <p class="pricePlay">Per play<br><span class="strong"><?php echo $configDT[0]['lotorry_per_play'];?></span> toman</p>
                                        </div>
                                        <div class="col-12 gameOpen">
                                        <table class="table table-betlotorry">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Home</th>
                                                    <th>Win</th>
                                                    <th>Draw</th>
                                                    <th>Win</th>
                                                    <th>Away</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                foreach ($RecDataDrawResults as $key => $vals) { 
                                                ?>
                                                <tr>
                                                    <td><?php echo $key+1;?></td>
                                                    <td><?php echo $vals['home'];?></td>
                                                    <td><input type="radio" name="betresults<?php echo $key;?>" value="1" <?php if($vals['results'] == "1"){echo 'checked';}else{echo 'disabled';}?>></td>
                                                    <td><input type="radio" name="betresults<?php echo $key;?>" value="2" <?php if($vals['results'] == "2"){echo 'checked';}else{echo 'disabled';}?>></td>
                                                    <td><input type="radio" name="betresults<?php echo $key;?>" value="3" <?php if($vals['results'] == "3"){echo 'checked';}else{echo 'disabled';}?>></td>
                                                    <td><?php echo $vals['away'];?></td>
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                            </table>
                                        </div>
                                        <div class="col-12">
                                            <p class="pricePlay"><span class="strong">Total: </span> <span id="totalPlay"><?php echo $configDT[0]['lotorry_per_play'];?></span> Toman</p>
                                        </div>
                                    </div>
                                    </form>

                                    <div class="col-12 text-center">
                                        <button class="genric-btn primary circle arrow" onclick="window.location='bet_lotorry.php'"><< Back</button>
                                    </div>
                                    
                                    
                                </div>
                                
                        </div>
                    </div>
				</div>	
			</section>

            <div id="countdown" style="display:none;"></div>
			<!-- End feature Area -->
        </div>

        <?php include_once("footer.php");?>	
        
        <?php include_once("footer_script.php");?>	

	</body>
</html>