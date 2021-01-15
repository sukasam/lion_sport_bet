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
						<div class="col-12 mb-60">
                        <table id="deposit" class="table table-striped table-bordered display responsive nowrap" style="width: 100%;">
                            <thead>
								<tr>
									<th>#</th>
                                    <th><?php echo TITLE_AMOUNT; ?></th>
                                    <th class="text-center"><?php echo TITLE_DATE_TIME; ?></th>
                                    <!-- <th class="text-center"><?php echo TITLE_TYPE; ?></th> -->
                                    <th class="text-center"><?php echo TITLE_TRANID; ?></th>
                                    <th class="text-center"><?php echo TITLE_STATUS; ?></th>
                                    <!-- <th class="text-center">Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(!empty($RecDataDeposit)){
                                foreach ($RecDataDeposit as $key => $value) {
                                    ?>
                                    <tr>
                                        <th><?php echo $key + 1; ?>.</th>
                                        <th><?php if ($value['deposit_type'] == "CC") {echo number_format($value['amount'] * $value['currency']);} else {echo number_format($value['amount']);}?></th>
                                        <th class="text-center"><?php echo date("m/d/Y", strtotime($value['date'])); ?> <?php echo $value['time']; ?></th>
                                        <!-- <th class="text-center"><?php echo $value['deposit_type']; ?></th> -->
                                        <th class="text-center"><?php echo $value['tran_id']; ?></th>
                                        <th class="text-center"><?php if ($value['status'] == 1) {echo '<button class="genric-btn success circle" style="width: 130px;">' . TITLE_COMPLATED . '</button>';} else if ($value['status'] == 2) {echo '<button class="genric-btn danger circle" style="width: 130px;">' . TITLE_CANCEL . '</button>';} else {echo '<button class="genric-btn info circle" style="width: 130px;">' . TITLE_PROCESSING . '</button>';}?></th>
                                        <!-- <th class="text-center"><a href="javascript:void(0);" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-info-circle" style="font-size: 3.3em;color: #ffb320;"></i></a>&nbsp&nbsp&nbsp&nbsp&nbsp<a href="https://t.me/lionroyalsup" target="_blank"><i class="fa fa-telegram fa-3x" style="color: #FFFFFF;"></i></a> -->
                                    </tr>
                                <?php }
                            }    
                            ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo TITLE_AMOUNT; ?></th>
                                    <th class="text-center"><?php echo TITLE_DATE_TIME; ?></th>
                                    <!-- <th class="text-center"><?php echo TITLE_TYPE; ?></th> -->
                                    <th class="text-center"><?php echo TITLE_TRANID; ?></th>
                                    <th class="text-center"><?php echo TITLE_STATUS; ?></th>
                                    <!-- <th class="text-center">Action</th> -->
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
            $('#deposit').DataTable();
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