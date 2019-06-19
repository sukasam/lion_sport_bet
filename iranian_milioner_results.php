<?php
    include_once("function/app_top.php");
    $RecDataHistory = $db->select("SELECT * FROM iranian_milioner_history WHERE id = '".$_GET['id']."'");
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
                            <h3 class="text-heading"><?php echo HOME_TOP_LOST;?> Results</h3> 
                        </div>
                    </div>

					<!-- <div class="row">
                        <div class="col-12">
                            <div class="container">
                                
                            </div>
                        </div>
                    </div> -->
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <nav>
                                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link <?php if($_GET['tab'] == "1"){echo "active";}?>" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home"><?php echo TITLE_DRAW_DETAILS;?></a>
                                        <a class="nav-item nav-link <?php if($_GET['tab'] == "2"){echo "active";}?>" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile"><?php echo TITLE_PRIZE_BREAKDOWN;?></a>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade <?php if($_GET['tab'] == "1"){echo "show active";}?>" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="winning_numbers_inner clr">
                                            <div class="mgT20">
                                            <h4 class="textColorW"><?php echo date("D, d M Y", strtotime($RecDataHistory[0]['date']));?><br>
                                            Jackpot: <?php echo number_format($RecDataHistory[0]['jackpot']);?> Toman</h4>
                                            </div>
                                            <div>
                                                <h4 class="header_medium clr">
                                                    <span class="mainWin">Ball numbers</span>
                                                    <span class="optionalWin">Lucky Stars</span>
                                                </h4>
                                            </div>
                                            <?php
                                                $ballNumLidst = explode('-',$RecDataHistory[0]['ball_numbers']);
                                                $LuckyNumLidst = explode('-',$RecDataHistory[0]['lucky_stars']);
                                            ?>
                                            <div class="draw_numbers clr">
                                                <ul class="draw_numbers_list clr">
                                                    <li class="normal normal_first"><?php echo $ballNumLidst[0];?></li>
                                                    <li class="normal"><?php echo $ballNumLidst[1];?></li>
                                                    <li class="normal"><?php echo $ballNumLidst[2];?></li>
                                                    <li class="normal"><?php echo $ballNumLidst[3];?></li>
                                                    <li class="normal normal_last"><?php echo $ballNumLidst[4];?></li>
                                                    <li class="special special_first"><span class="vh">Lucky Stars</span> <?php echo $LuckyNumLidst[0];?></li>
                                                    <li class="special special_last"><span class="vh">Lucky Stars</span> <?php echo $LuckyNumLidst[1];?></li>
                                                </ul>
                                                <!-- <div class="raffle_details clr">
                                                <h2 class="txt_large">Iranian Milioner Maker code</h2>
                                                <p>1 prize of 1,000,000.00</p>
                                                <div class="raffle_list">
                                                    TTJC 60715
                                                </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade <?php if($_GET['tab'] == "2"){echo "show active";}?>" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <table class="table table-responsive" summary="Table displaying prize breakdown for specific draw with one level column headings. Each prize tier is displayed as a row of data. Prize tiers are displayed in descending order with higher prize listed at the top.">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    No. of matches
                                                </th>
                                                <th scope="col">
                                                    All winners
                                                </th>
                                                <th scope="col">
                                                    Prize per Iranian winner
                                                </th>
                                                <th scope="col">
                                                    Iranian cash prize fund
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                
                                                $RecDataHistory = $db->select("SELECT * FROM iranian_milioner_prize WHERE history_id = '".$_GET['id']."' ORDER BY id ASC");
                                                foreach ($RecDataHistory as $key => $value) {
                                                ?>
                                                <tr class="even">
                                                    <td id="match_count_<?php echo $i;?>" data-th="No. of matches">
                                                        <?php echo $value['matches'];?>
                                                    </td>
                                                    <td id="winners_count_<?php echo $i;?>" data-th="All winners">
                                                        <?php echo number_format($value['all_winners']);?>
                                                    </td>
                                                    <td id="prize_per_player_<?php echo $i;?>" data-th="Prize per Iranian winner" class="">
                                                        <?php echo number_format($value['prize_per']);?>
                                                    </td>
                                                    <td id="prize_fund_<?php echo $i;?>" data-th="Iranian cash prize fund">
                                                        <?php echo number_format($value['cash_prize']);?>                                         
                                                    </td>
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                            <!-- <tfoot>
                                                <tr class="even">
                                                    <th id="match_count_total" scope="row">
                                                        Totals
                                                    </th>
                                                    <td id="winners_count_total" data-th="Totals All winners">
                                                        <?php echo number_format($allWin);?>
                                                    </td>
                                                    <td class="prize_per_player"></td>
                                                    <td id="prize_fund_total" data-th="Totals Iranian cash prize fund">
                                                        <?php echo number_format($totalWinPrize);?>
                                                    </td>
                                                </tr>
                                            </tfoot> -->
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr style="border: 1px solid;">
                        <div class="text-center mgT20"><button class="genric-btn primary circle arrow" onclick="window.location.href='iranian_milioner_results_history.php'"><< Back</button></div>
                    </div>
				</div>	
			</section>
			<!-- End feature Area -->
        </div>

        <?php include_once("footer.php");?>	
        
		<?php include_once("footer_script.php");?>	
	</body>
</html>