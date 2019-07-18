<?php
    include_once("function/app_top.php");

    $RecDataWithdraw = $db->select("SELECT * FROM withdraw_history WHERE player = '".$_SESSION['Player']."' ORDER BY id DESC");
    $RecDataPoint = $db->select("SELECT * FROM point_history WHERE player = '".$_SESSION['Player']."' ORDER BY id DESC");
    $RecDataDeposit = $db->select("SELECT * FROM deposit_history WHERE player = '".$_SESSION['Player']."' ORDER BY id DESC");

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
			<section class="feature-area section-gap " id="transation">
				<div class="container card-content">					
					<div class="row">
                        <div class="col-12">
                            <h3 class="text-heading">Deposit History</h3> 
                        </div>
						<div class="col-12 mb-60">
                        <table id="deposit" class="table table-striped table-bordered display responsive nowrap" style="width: 100%;">
                            <thead>
								<tr>
									<th>#</th>
                                    <th>Amount</th>
                                    <th>Date/Time</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach ($RecDataDeposit as $key => $value) {
                                ?>
                                <tr>
									<th><?php echo $key+1;?>.</th>
                                    <th><?php if($value['deposit_type'] == "E-Voucher"){echo number_format($value['amount'] * $configDT[0]['currency']);}else{echo number_format($value['amount']);}?></th>
                                    <th><?php echo date("m/d/Y", strtotime($value['date']));?> <?php echo $value['time'];?></th>
                                    <th><?php echo $value['deposit_type'];?></th>
                                    <th class="text-center"><?php if($value['status'] == 1){echo '<button class="genric-btn success circle" style="width: 60px;">Complated</button>';}else if($value['status'] == 2){echo '<button class="genric-btn danger circle" style="width: 60px;">Cancel</button>';}else{echo '<button class="genric-btn info circle" style="width: 60px;">Processing</button>';}?></th>
                                </tr>
                                <?php }?>
                            </tbody>
                            <tfoot>
                                <tr>
									<th>#</th>
                                    <th>Amount</th>
                                    <th>Date/Time</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                </tr>
                            </tfoot>
                        </table>	
                        </div>
                        <div class="col-12">
                            <h3 class="text-heading">Withdrow History</h3> 
                        </div>
						<div class="col-12 mb-60">
                        <table id="withdrow" class="table table-striped table-bordered display responsive nowrap" style="width: 100%;">
                            <thead>
								<tr>
									<th>#</th>
                                    <th>Amount</th>
                                    <th>Date/Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($RecDataWithdraw as $key => $value) {
                                    ?>
                                    <tr>
                                        <th><?php echo $key+1;?>.</th>
                                        <th><?php echo number_format($value['amount']);?></th>
                                        <th><?php echo date("m/d/Y", strtotime($value['date']));?> <?php echo $value['time'];?></th>
                                        <th class="text-center"><?php if($value['status'] == 1){echo '<button class="genric-btn success circle" style="width: 60px;">Complated</button>';}else if($value['status'] == 2){echo '<button class="genric-btn danger circle" style="width: 60px;">Cancel</button>';}else{echo '<button class="genric-btn info circle" style="width: 60px;">Processing</button>';}?></th>
                                    </tr>
                                 <?php }?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Amount</th>
                                    <th>Date/Time</th>
                                    <th>Status</th>
                                </tr>
                            </tfoot>
                        </table>					
                        </div>
                        <div class="col-12">
                            <h3 class="text-heading">Exchange Point History</h3> 
                        </div>
						<div class="col-12">
                        <table id="point" class="table table-striped table-bordered display responsive nowrap" style="width: 100%;">
                            <thead>
								<tr>
									<th>#</th>
                                    <th>Point</th>
                                    <th>Date/Time</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($RecDataPoint as $key => $value) {
                                ?>
                                <tr>
									<th><?php echo $key+1;?>.</th>
                                    <th><?php echo number_format($value['point']);?></th>
                                    <th><?php echo date("m/d/Y", strtotime($value['date']));?> <?php echo $value['time'];?></th>
                                    <th><?php if($value['point_type'] == "top_lost"){echo "Bad Bit";}else if($value['point_type'] == "top_win"){echo "Top Win";}else{echo "Top Hand";}?></th>
                                    <th class="text-center"><?php echo '<button class="genric-btn success circle" style="width: 60px;">Complated</button>';?></th>
                                </tr>
                                <?php }?>
                            </tbody>
                            <tfoot>
                                <tr>
									<th>#</th>
                                    <th>Point</th>
                                    <th>Date/Time</th>
                                    <th>Type</th>
                                    <th>Status</th>
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
            $('#deposit').DataTable(
                /*responsive: true*/
            );
            $('#withdrow').DataTable(
                /*responsive: true*/
            );
            $('#point').DataTable(
                /*responsive: true*/
            );
            
        } );
        </script>

	</body>
</html>