<?php

include_once "function/app_top.php";

$RecDataDepositSQL = "SELECT * FROM deposit_history WHERE player = ? AND deposit_type = 'CC' ORDER BY id DESC";
$values = array($_SESSION['Player']);
$RecDataDeposit = $model->doSelect($RecDataDepositSQL, $values);

?>
<!DOCTYPE html>
	<html lang="en" class="no-js">
    <?php include_once "header.php";?>
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
                <?php include_once "topmenu.php";?>
			</section>
            <!-- End banner Area -->

            <!-- About Generic Start -->
		<div class="main-wrapper ">
            <!-- Start feature Area -->
			<section class="feature-area section-gap " id="secvice">
				<div class="container card-content">
					<div class="row">

                        <div class="col-12">
                            <h3 class="text-heading"><?php echo TOP_MENU_DEPOSITS_CC_HISTORY; ?></h3>
                        </div>
						<div class="col-12 mb-60" style="overflow-x:auto;">
                        <table id="deposit" class="table table-striped table-bordered display responsive nowrap" style="width: 100%;">
                            <thead>
								<tr>
									<th class="text-center align-middle">Number</th>
                                    <th class="text-center align-middle">Registered</th>
                                    <th class="text-center align-middle">Amount (T)</th>
                                    <th class="text-center align-middle">Amount (USD)</th>
                                    <th class="text-center align-middle">Amount (Crypto)</th>
                                    <th class="text-center align-middle">Crypto</th>
                                    <th class="text-center align-middle">Toman Rate</th>
                                    <th class="text-center align-middle">Status</th>
                                    <th class="text-center align-middle">Done</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(!empty($RecDataDeposit)){
                                foreach ($RecDataDeposit as $key => $value) {
                                    ?>
                                    <tr>
                                        <th class="text-center align-middle"><?php echo sprintf("%05d",$value['id']); ?>.</th>
                                        <th class="text-center align-middle"><?php echo date("Y-m-d", strtotime($value['date'])); ?> <?php echo $value['time']; ?></th>
                                        <th class="text-center align-middle"><?php echo number_format($value['amountT']);?></th>
                                        <th class="text-center align-middle"><?php echo number_format($value['amountU'],2);?></th>
                                        <th class="text-center align-middle"><?php echo $value['amountC'];?></th>
                                        <th class="text-center align-middle"><?php echo $value['Crypto'];?></th>
                                        <th class="text-center align-middle"><?php echo number_format($value['currency']);?></th>
                                        <th class="text-center align-middle"><?php if ($value['status'] == 1) {echo TITLE_COMPLATED;} else if ($value['status'] == 2) {echo TITLE_CANCEL;} else {echo TITLE_PROCESSING;}?></th>
                                        <th class="text-center align-middle"><?php echo date("Y-m-d H:i:s", strtotime($value['update_done']));?></th>
                                    </tr>
                                <?php }
                            }    
                            ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center align-middle">Number</th>
                                    <th class="text-center align-middle">Registered</th>
                                    <th class="text-center align-middle">Amount (T)</th>
                                    <th class="text-center align-middle">Amount (USD)</th>
                                    <th class="text-center align-middle">Amount (Crypto)</th>
                                    <th class="text-center align-middle">Crypto</th>
                                    <th class="text-center align-middle">Toman Rate</th>
                                    <th class="text-center align-middle">Status</th>
                                    <th class="text-center align-middle">Done</th>
                                </tr>
                            </tfoot>
                        </table>
                        </div>
                    </div>
				</div>
			</section>
			<!-- End feature Area -->
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer" style="justify-content: center;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>

        <?php include_once "footer.php";?>

        <?php include_once "footer_script.php";?>

        <script>

        $(document).ready(function() {
            $('#deposit').DataTable(
                responsive: true
            );
            
        } );

        $( "#deposit_captcha_code" ).keypress(function( event ) {
            if ( event.which == 13 ) {
                event.preventDefault();
            }
        });

        $("#btDeposit").click(function() {


            if($('#amount').val() == ""){
                $('#amount').focus();
                return false;
            }
            
            $('#frm_deposit').submit();

        });

        </script>
	</body>
</html>