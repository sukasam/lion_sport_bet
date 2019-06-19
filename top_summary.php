<?php
	include_once("function/app_top.php");

    // $topHandData = $db->select("SELECT * FROM rank_tophand ORDER BY point DESC LIMIT 0,10");
    // $topWinData = $db->select("SELECT * FROM rank_topwin ORDER BY point DESC LIMIT 0,10");
    // $RecTophand = $db->select("SELECT COUNT(*) as count FROM `top_hand` WHERE `player` = '".$_SESSION['Player']."'");
    // $RecToplost = $db->select("SELECT SUM(point) as point FROM `top_lost` WHERE `player` = '".$_SESSION['Player']."'");
    // $RecDataPoint = $db->select("SELECT * FROM point_history WHERE player = '".$_SESSION['Player']."' ORDER BY id DESC");
    
    $params = array(
        "Command"  => "AccountsGet",
        "Player" => $_SESSION['Player'],
    );
    $api = Poker_API($params);

   if($api->PRake != 0){
        $countPRake = $api->PRake*0.01;
    }else{
        $countPRake = 0;
    }

    if(!isset($_GET['action'])){
        $_SESSION['errors_code2'] = "";
    }
    
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
    #tophand_length,#tophand_filter,#tophand_info,#tophand_paginate{
        display:none;
    }
    #topwin_length,#topwin_filter,#topwin_info,#topwin_paginate{
        display:none;
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
                        <div class="col-12 col-md-6 mb-40" style="padding: inherit;">
                            <div class="col-12">
                                <h3 class="text-heading"><?php echo TOPHAND_HEAD_TITLE;?></h3> 
                            </div>
                            <div class="col-12">
                                <table id="tophand" class="table table-striped table-bordered display responsive nowrap" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?php echo TITLE_NAME;?></th>
                                            <th class="text-center"><?php echo TITLE_POINT;?></th>
                                            <th class="text-center"><?php echo TITLE_REWORD;?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                       $listReword = ["100000","90000","80000","70000","60000","50000","40000","30000","20000","10000"];
                                        foreach ($topHandData as $key => $vals) {  
                                    ?>
                                        <tr>
                                            <td><?php echo $key+1?>.</td>
                                            <td><?php echo $vals['player'];?></td>
                                            <td class="text-center"><?php echo '<a href="javascript:void(0);" class="genric-btn success circle" style="width: 50px;">'.number_format($vals['point']).'</a>';?></td>
                                            <td class="text-center"><?php echo $listReword[$key];?></td>
                                        </tr>
                                        <?php
                                        
                                        }
                                    ?>
                                    </tbody>
                                </table>						
                            </div>	
                        </div>	
                        <div class="col-12 col-md-6 mb-40" style="padding: inherit;">
                            <div class="col-12">
                                <h3 class="text-heading"><?php echo TOPWIN_HEAD_TITLE;?></h3> 
                            </div>
                            <div class="col-12">
                                <table id="topwin" class="table table-striped table-bordered display responsive nowrap" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?php echo TITLE_NAME;?></th>
                                            <th class="text-center"><?php echo TITLE_POINT;?></th>
                                            <th class="text-center"><?php echo TITLE_REWORD;?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $listReword = ["200000","180000","160000","140000","120000","100000","80000","60000","40000","20000"];
                                        foreach ($topWinData as $key => $vals) {  
                                            ?>
                                                <tr>
                                                    <td><?php echo $key+1?>.</td>
                                                    <td><?php echo $vals['player'];?></td>
                                                    <td class="text-center"><?php echo '<a href="javascript:void(0);" class="genric-btn success circle" style="width: 50px;">'.number_format($vals['point']).'</a>';?></td>
                                                    <td class="text-center"><?php echo $listReword[$key];?></td>
                                                </tr>
                                                <?php
                                                
                                                }
                                    ?>
                                    </tbody>
                                </table>						
                            </div>
                        </div>	
                        <div class="col-12 mb-20">
                            <h3 class="text-heading"><?php echo TITLE_YOUR_POINT;?></h3> 
                        </div>
                        <div class="col-12 mb-20">
                            <div class="text-center"><?php echo TITLE_CONDITION_POINT;?></div> 
                        </div>
                        <div class="col-12 mb-20">
                            <div class="col-md-10 col-md-offset-1 ">
                                <?php if($_SESSION['errors_code2'] != ""){?>
                                <div class="alert <?php echo $_SESSION['errors_code2'];?> mb-20">
                                    <?php echo $_SESSION['errors_msg2'];?>
                                </div>
                                <?php }?>
                                <div class="row">
                                    <div class="col-12 col-md-4 mb-40">
                                        <div class="text-center headTitle">
                                            <span><?php echo HOME_TOP_HAND;?></span>
                                            <br><br>
                                            <span class="spanO"><?php echo number_format($RecTophand[0]['count']);?></span> <?php echo TITLE_POINT;?>
                                            <br><br>
                                            <form name="frmTophand" id="frmTophand" action="top_summary.php" method="post">
                                                <!-- <input type="hidden" name="point_tophand" value="<?php echo number_format($RecTophand[0]['count']);?>"> -->
                                                <?php
                                                if($RecTophand[0]['count'] > 0){
                                                ?>
                                                    <div class="text-center">
                                                     <input type="hidden" name="amount" value="<?php echo $RecTophand[0]['count'];?>">
                                                     <input type="hidden" name="point_type" value="top_hand">
                                                     <input type="hidden" name="player" value="<?php echo $_SESSION['Player'];?>">
                                                     <input type="hidden" name="dateC" value="<?php echo date("Y-m-d");?>">
                                                     <input type="hidden" name="timeC" value="<?php echo date("H:i:s");?>">
                                                     <button class="genric-btn primary circle arrow" id='exTophand' onclick="exchangePoint('1');" type="button"><?php echo TITLE_CONFIRMATION;?>&nbsp&nbsp<i class="fa fa-spinner fa-spin hide" aria-hidden="true" id='spexTophand'></i></button>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                                <input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>"/>
                                            </form>
                                        </div>

                                    </div>
                                    <div class="col-12 col-md-4 mb-40">
                                        <div class="text-center headTitle">
                                            <span><?php echo HOME_TOP_WIN;?></span>
                                            <br><br>
                                            <span class="spanO"><?php echo number_format($countPRake);?></span> <?php echo TITLE_POINT;?>
                                            <br><br>
                                            <form name="frmTopwin" id="frmTopwin" action="top_summary.php" method="post">
                                                <?php
                                                if($countPRake > 0){
                                                ?>
                                                    <div class="text-center">
                                                     <input type="hidden" name="amount" value="<?php echo $countPRake;?>">
                                                     <input type="hidden" name="point_type" value="top_win">
                                                     <input type="hidden" name="player" value="<?php echo $_SESSION['Player'];?>">
                                                     <input type="hidden" name="dateC" value="<?php echo date("Y-m-d");?>">
                                                     <input type="hidden" name="timeC" value="<?php echo date("H:i:s");?>">
                                                     <button class="genric-btn primary circle arrow" id='exTopwin' onclick="exchangePoint('2');" type="button"><?php echo TITLE_CONFIRMATION;?> <i class="fa fa-spinner fa-spin hide" aria-hidden="true" id='spexTopwin'></i></button>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                                <input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>"/>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 mb-40">
                                        <div class="text-center headTitle">
                                            <span><?php echo HOME_TOP_LOST;?></span>
                                            <br><br>
                                            <span class="spanO"><?php echo number_format($RecToplost[0]['point']);?></span> <?php echo TITLE_POINT;?>
                                            <br><br>
                                            <form name="frmToplost" id="frmToplost" action="top_summary.php" method="post">
                                                <!-- <input type="hidden" name="point_toplost" value="<?php echo number_format($RecToplost[0]['point']);?>"> -->
                                                <?php
                                                if($RecToplost[0]['point'] > 0){
                                                ?>
                                                    <div class="text-center">
                                                     <input type="hidden" name="amount" value="<?php echo $RecToplost[0]['point'];?>">
                                                     <input type="hidden" name="point_type" value="top_lost">
                                                     <input type="hidden" name="player" value="<?php echo $_SESSION['Player'];?>">
                                                     <input type="hidden" name="dateC" value="<?php echo date("Y-m-d");?>">
                                                     <input type="hidden" name="timeC" value="<?php echo date("H:i:s");?>">
                                                     <button class="genric-btn primary circle arrow" id='exToplost' onclick="exchangePoint('3');" type="button"><?php echo TITLE_CONFIRMATION;?> <i class="fa fa-spinner fa-spin hide" aria-hidden="true" id='spexToplost'></i></button>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                                <input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>"/>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <h3 class="text-heading"><?php echo TITLE_EXCHANGE_POINT_HISTORY;?></h3> 
                        </div>
						<div class="col-12">
                            <table id="point" class="table table-striped table-bordered display responsive nowrap" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo TITLE_POINT;?></th>
                                        <th><?php echo TITLE_DATE_TIME;?></th>
                                        <th><?php echo TITLE_TYPE;?></th>
                                        <th><?php echo TITLE_STATUS;?></th>
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
                                        <th><?php if($value['point_type'] == "top_lost"){echo HOME_TOP_LOST;}else if($value['point_type'] == "top_win"){echo HOME_TOP_WIN;}else{echo HOME_TOP_HAND;}?></th>
                                        <th class="text-center"><?php echo '<button class="genric-btn success circle" style="width: 60px;">'.TITLE_COMPLATED.'</button>';?></th>
                                    </tr>
                                    <?php }?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo TITLE_POINT;?></th>
                                        <th><?php echo TITLE_DATE_TIME;?></th>
                                        <th><?php echo TITLE_TYPE;?></th>
                                        <th><?php echo TITLE_STATUS;?></th>
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
            $('#tophand').DataTable();
            $('#topwin').DataTable();
            $('#point').DataTable();
        } );

        function exchangePoint(ref){

            var request;
            var urlCall="";

            if(ref == 1){

                $("#spexTophand").removeClass('hide');
                $('#exTophand').prop('disabled', true);

                // Serialize the data in the form
                var serializedData = $('#frmTophand').serialize();

                urlCall = "./function/exchange_tophand.php";

            }else if(ref == 2){

                $("#spexTopwin").removeClass('hide');
                $('#exTopwin').prop('disabled', true);

                // Serialize the data in the form
                var serializedData = $('#frmTopwin').serialize();

                urlCall = "./function/exchange_topwin.php";

            // console.log(JSON.stringify(formVel));

            }else if(ref == 3){

                $("#spexToplost").removeClass('hide');
                $('#exToplost').prop('disabled', true);

                // Serialize the data in the form
                var serializedData = $('#frmToplost').serialize();
                urlCall = "./function/exchange_toplost.php";

            }
           

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
                    window.location='top_summary.php?action=success';
                }
            });

            // // Callback handler that will be called on failure
            request.fail(function (jqXHR, textStatus, errorThrown){
                // Log the error to the console
                //console.error("The following error occurred: "+textStatus+" "+errorThrown);
                    window.location='top_summary.php?action=success';
            });

            }
        </script>
        
	</body>
</html>