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
                        <div class="col-12">
                            <h3 class="text-heading"><?php echo HOME_TOP_LOST;?> draw history</h3> 
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                            <table id="drawhistory" class="table table-striped table-bordered display responsive nowrap" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th class="text-center">Jackpot</th>
                                        <th class="text-center">Ball numbers</th>
                                        <th class="text-center">Lucky Stars</th>
                                        <th class="text-center">Draw details</th>
                                        <th class="text-center">Prize breakdown</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $RecDataDrawHistory = $db->select("SELECT * FROM iranian_milioner_history ORDER BY date DESC");
                                    foreach ($RecDataDrawHistory as $key => $value) {
                                    
                                        $dateTime =  date("D, d M Y", strtotime($value['date']));

                                        ?>
                                        <tr>
                                            <th><?php echo $key+1;?>.</th>
                                            <th><?php echo $dateTime;?></th>
                                            <th class="text-center"><?php echo number_format($value['jackpot']);?></th>
                                            <th class="text-center"><?php echo $value['ball_numbers'];?></th>
                                            <th class="text-center"><?php echo $value['lucky_stars'];?></th>
                                            <th class="text-center"><a href="iranian_milioner_results.php?id=<?php echo $value['id'];?>&tab=1" style="color:#f1b824">Draw details</a></th>
                                            <th class="text-center"><a href="iranian_milioner_results.php?id=<?php echo $value['id'];?>&tab=2" style="color:#f1b824">Prize breakdown</a></th>
                                            </th>
                                        </tr>
                                    <?php }?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th class="text-center">Jackpot</th>
                                        <th class="text-center">Ball numbers</th>
                                        <th class="text-center">Lucky Stars</th>
                                        <th class="text-center">Draw details</th>
                                        <th class="text-center">Prize breakdown</th>
                                    </tr>
                                </tfoot>
                            </table>		
                            </div>
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

            $('#drawhistory').DataTable(
                /*responsive: true*/
            );
        });
        </script>
	</body>
</html>