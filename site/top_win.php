<?php
	include_once("function/app_top.php");

    //$RecData = $db->select("SELECT * FROM top_hand ORDER BY id DESC");
    
    $params = array("Command"  => "AccountsList",
        "Fields" => "Player,PRake"
    );
    $api = Poker_API($params);

    $topWin = [];

    foreach ($api->Player as $key => $value) {
        $countPRake = floor($api->PRake[$key]*0.01);
        if($countPRake >= 1){
            array_push($topWin[$value]=$countPRake);
        }
    }

    arsort($topWin);

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
			<section class="feature-area section-gap " id="topwin_page">
				<div class="container card-content">					
					<div class="row">
                        <div class="col-12">
                            <h3 class="text-heading"><?php echo TOPWIN_HEAD_TITLE;?></h3> 
                        </div>
						<div class="col-12">
                            <table id="topwin" class="table table-striped table-bordered display responsive nowrap" style="width: 100%;">
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
                                    foreach ($topWin as $player => $point) {  
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
            $('#topwin').DataTable();
            
        } );
        </script>
        
	</body>
</html>