<?php
	include_once("function/app_top.php");

    $topHand = [];
    $RecData = $db->select("SELECT * FROM `top_hand` GROUP BY `player` ORDER BY `id` DESC");
     foreach($RecData as $key => $val){
        $RecData2 = $db->select("SELECT COUNT(*) as count FROM `top_hand` WHERE `player` = '".$val['player']."'");
        array_push($topHand[$val['player']]=$RecData2[0]['count']);
     }
     arsort($topHand);
    
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
			<section class="feature-area section-gap " id="tophand_page">
				<div class="container card-content">					
					<div class="row">
                        <div class="col-12">
                            <h3 class="text-heading"><?php echo TOPHAND_HEAD_TITLE;?></h3> 
                        </div>
						<div class="col-12">
                            <table id="tophand" class="table table-striped table-bordered display responsive nowrap" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo TITLE_NAME;?></th>
                                        <th><?php echo TITLE_POINT;?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $numRow = 0;
                                    foreach ($topHand as $player => $point) {  
                                ?>
                                    <tr>
                                        <td><?php echo $numRow+1?>.</td>
                                        <td><?php echo $player;?></td>
                                        <td class="text-center"><?php echo '<a href="javascript:void(0);" class="genric-btn success circle" style="width: 50px;">'.number_format($point).'</a>';?></td>
                                    </tr>
                                    <?php
                                    $numRow++;
                                    }
                                ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo TITLE_NAME;?></th>
                                        <th><?php echo TITLE_POINT;?></th>
                                    </tr>
                                </tfoot>
                            </table>						
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
            $('#tophand').DataTable(
                /*responsive: true*/
            );
            
        } );
        </script>
        
	</body>
</html>