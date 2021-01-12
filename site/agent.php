<?php
	// header ("location:/maintenance");
    include_once("function/app_top.php");
    
    // if($_SESSION['Player'] != "roxy" && $_SESSION['Player'] != "aghpaapaa"){
    //     Header ("location :/maintenance");
    // }

    if($_GET['action'] === 'commission'){
        include_once("function/commission.php");	
    }
    if(!isset($_GET['action'])){
        $_SESSION['errors_code'] = "";
    }
    $ketInvite = encode($_SESSION['Player'],KEY_HASH);
    $affiliate = SiteRootDir."register.php?affiliate=".$ketInvite;
    
    //$RecData = $db->select("SELECT * FROM affiliate WHERE player = '".$_SESSION['Player']."' ORDER BY id DESC");
    $RecData = $db->select("SELECT * FROM commission_invite WHERE player = '".$_SESSION['Player']."' ORDER BY id DESC");
    $RecDataUser = $db->select("SELECT * FROM user_profile WHERE Player = '".$_SESSION['Player']."'");
    $RecDataCommission = $db->select("SELECT * FROM commission_history WHERE player = '".$_SESSION['Player']."' ORDER BY id DESC");
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
			<section class="feature-area section-gap " id="invite">
				<div class="container card-content">
                    <?php if($RecDataUser[0]['inviteUser'] == 1){
                        //if(true){
                        ?>
                        <div class="row">
                        <div class="col-12">
                            <h3 class="text-heading"><?php echo INVITE_HEAD_TITLE;?></h3> 
                        </div>
						<div class="col-12 mb-60">
                            <div class="row">
                                <div class="col-md-9 col-12 mb-20">
                                    <div class="headLine"><h4><?php echo INVITE_LINK;?></h4> </div>
                                    <div class="card">
                                        <div class="card-body">
                                        <div class="text-danger"><a href="<?php echo $affiliate;?>" target="_blank" style="font-weight: bold;"><?php echo $affiliate;?></a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="headLine"><h4><?php echo INVITE_QRCODE;?></h4> </div>
                                    <div class="card">
                                        <div class="card-body text-center">
											<div id="qrcodeTable" style=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>				
						</div>	
						<div class="col-12">
                            <h3 class="text-heading"><?php echo INVITE_REPORT;?></h3> 
						</div>	
						<div class="col-12 mb-40">
						<table id="invite-table" class="table table-striped table-bordered display responsive nowrap" style="width: 100%;">
                            <thead>
								<tr>
									<th>#</th>
                                    <th><?php echo TITLE_NAME;?></th>
                                    <th><?php echo TITLE_DATE_TIME;?></th>
                                    <th><?php echo INVITE_COMMISTION;?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $someCom = 0;
                                $affiliateS = [];
                                $inCom = [];
								foreach ($RecData as $key => $value) {
                                    //break;
                                    set_time_limit(0);
                                    // $params = array("Command"  => "AccountsList",
                                    //                 "Players" => $value['affiliate'],
                                    //                 "Fields" => "Player,ERake"
                                    //             );
                                    // $api = Poker_API($params);
                                    // // echo "<pre>";
                                    // // echo  print_r($api);
                                    // // echo "</pre>";
                                    // if($api->ERake[0] != 0){
                                    //     $comRate = ($api->ERake[0] * ($configDT[0]['commission'] / 100));
                                    //     $committion = number_format($comRate);
                                    //     array_push($affiliate,$value['affiliate']);
                                    //     array_push($inCom,number_format($comRate));
                                    // }else{
                                    //     $committion = "0";
                                    // }
                                    if($value['commistion'] != "0" || $value['commistion'] != 0){
                                        array_push($affiliateS,$value['affiliate']);
                                        array_push($inCom,$value['commistion']);
                                    }

                                    $committion = number_format($value['commistion']);
                                    $someCom += $value['commistion'];

									?>
                                <tr>
                                    <td><?php echo $key+1?>.</td>
                                    <td><?php echo $value['affiliate'];?></td>
                                    <td><?php echo date("m/d/Y", strtotime($value['date']));?> <?php echo $value['time'];?></td>
                                    <td class="text-center"><?php echo '<a href="javascript:void(0);" class="genric-btn success circle" style="width: 100px;">'.$committion.'</a>';?></td>
                                </tr>
                                <?php
                                //break;
								}
							?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo TITLE_NAME;?></th>
                                    <th><?php echo TITLE_DATE_TIME;?></th>
                                    <th><?php echo INVITE_COMMISTION;?></th>
                                </tr>
                            </tfoot>
                        </table>
                        </div>	
                        <div class="col-12 text-center">
                            <h3 class="text-heading"><?php echo INVITE_TOTAL_COMMISTION;?> : <span class="spanO"><?php echo number_format($someCom);
								/////////////////////////
									$plyer=hash('sha256',$_SESSION['Player']);
									$tcu=(strval(intval($someCom)*615));
									$tcu=base64_encode($tcu)."QNTQ2QEw";
									$token=md5(uniqid(rand(),TRUE));
									$str=$plyer."-".$tcu."-".$token;
									$_SESSION['tcutknivt']=base64_encode($str);
									
								/////////////////////////							?></span> <?php echo TITLE_TOMAN;?></h3>
                        </div>
                        <div class="col-md-8 offset-md-2 mb-60">
                            <?php if($_SESSION['errors_code'] != ""){
                                if($_GET['action'] === "success"){
                                    ?>
                                    <div class="alert <?php echo $_SESSION['errors_code'];?>">
                                        <?php echo $_SESSION['errors_msg'];?>
                                    </div>
                                    <?php
                                }else{
                                    ?>
                                    <div class="alert alert-danger">
                                         <?php echo $_SESSION['errors_msg'];?>
                                    </div>
                                    <?php
                                } 
                            }?>
                            <?php 
                            if($someCom > 0){
                                ?>
                                <div class="row mb-60">
                                    <div class="col-12">
                                        <!-- <div class="input-group form-group justify-content-center">
                                            <img id="captcha" src="include/captcha.php?v=<?php echo date("YmdHis");?>" alt="CAPTCHA Image" class="img-thumbnail img-thumbnail-captcha">
                                        </div> -->
                                        <form name="frmCommission" id="frmCommission" action="invite.php" method="post">
                                        <!-- <div class="input-group form-group">
                                            <div class="input-group-prepend"></div>
                                            <input type="password" class="form-control text-center" placeholder="<?php echo TITLE_SECURED_CODE;?>" name="commission_captcha_code" autocomplete="off" required>
                                        </div> -->
                                        <div class="text-center">
                                            <input type="hidden" name="player" value="<?php echo $_SESSION['Player'];?>">
                                            <input type="hidden" name="totalC" value="<?php echo $someCom;?>">
                                            <input type="hidden" name="dateC" value="<?php echo date("Y-m-d");?>">
                                            <input type="hidden" name="timeC" value="<?php echo date("H:i:s");?>">
                                            <?php
                                             foreach($affiliateS as $key => $value){
                                                echo '<input type="hidden" name="affiliate[]" value="'.$value.'">';
                                                echo '<input type="hidden" name="inCom[]" value="'.$inCom[$key].'">';
                                             }
                                            ?>
                                            <?php 
                                            //if($_SESSION['Player'] == "adminT-T"){
                                                ?>
                                                <button class="genric-btn primary circle arrow" id='exCommission' onclick="exchangeCommission('');" type="button"><?php echo TITLE_CONFIRMATION;?>&nbsp&nbsp<i class="fa fa-spinner fa-spin hide" aria-hidden="true" id='spexCommission'></i></button>
                                                <?php
                                            //}
                                            ?>
                                        </div>
                                        <input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>"/>
                                        </form>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col-12">
                            <h3 class="text-heading"><?php echo TITLE_EXCHANGE_COMMISSION_HISTORY;?></h3> 
                        </div>
						<div class="col-12">
                            <table id="commission-table" class="table table-striped table-bordered display responsive nowrap" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center"><?php echo TITLE_POINT;?></th>
                                        <th class="text-center"><?php echo TITLE_DATE_TIME;?></th>
                                        <th class="text-center"><?php echo TITLE_STATUS;?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($RecDataCommission as $key => $value) {
                                    ?>
                                    <tr>
                                        <th><?php echo $key+1;?>.</th>
                                        <th class="text-center"><?php echo number_format($value['amount']);?></th>
                                        <th class="text-center"><?php echo date("m/d/Y", strtotime($value['date']));?> <?php echo $value['time'];?></th>
                                        <th class="text-center"><?php echo '<button class="genric-btn success circle" style="width: 60px;">'.TITLE_COMPLATED.'</button>';?></th>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>				
						</div>													
					</div>
                    <?php
                    }else{
                    ?>
                    <div class="text-center invite-desc">
                        <div class="mb-30"><?php echo TITLE_INVITE_DESC;?></div>
                        <div class="text-center">
                            <a href="https://t.me/lionroyalsup" target="_blank" style="color: #FFFFFF;"><i class="fa fa-telegram fa-3x"></i></a>
                        </div>
                    </div>
                    <?php
                    }?>					
				</div>	
			</section>
			<!-- End feature Area -->
			        <?php include_once("footer.php");?>	
		<?php include_once("footer_script.php");?>	
		<script type="text/javascript" src="js/jquery.qrcode.js"></script>
		<script type="text/javascript" src="js/qrcode.js"></script>
		<script>
		jQuery('#qrcodeTable').qrcode({
			text	: "<?php echo $affiliate;?>",
			width : "200",
			height : "200",
		});	
		$(document).ready(function() {
            $('#invite-table').DataTable();
            $('#commission-table').DataTable();
        } );
        function exchangeCommission(){
            var request;
            var urlCall="";
            $("#spexCommission").removeClass('hide');
            $('#exCommission').prop('disabled', true);
            // Serialize the data in the form
            var serializedData = $('#frmCommission').serialize();
            urlCall = "./function/exchange_commission.php";
            // Fire off the request to /form.php
            request = $.ajax({
                url: urlCall,
                type: "post",
                data: serializedData
            });
            //Callback handler that will be called on success
            request.done(function (response, textStatus, jqXHR){
                // Log a message to the console
                //console.log("Hooray, it worked! "+response);
                if(response){
                    if(response == "0" || response == 0){
                        window.location='invite.php?action=success'; 
                    }else{
                        window.location='invite.php?action=failed';
                    }
                   
                }
            });
            // // Callback handler that will be called on failure
            request.fail(function (jqXHR, textStatus, errorThrown){
                // Log the error to the console
                //console.error("The following error occurred: "+textStatus+" "+errorThrown);
                   window.location='invite.php?action=failed';
            });
        }
		</script>			
	
        </div>
	
	</body>
</html>