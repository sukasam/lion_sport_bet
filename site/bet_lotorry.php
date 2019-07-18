<?php
    include_once("function/app_top.php");

    $csrf = new csrf();
    
    // Generate Token Id and Valid
    $token_id = $csrf->get_token_id();
    $token_value = $csrf->get_token($token_id);

    if($_GET['action'] === 'saveNumbers'){
        include_once("function/bet_lotorry.php");
        exit();
    }
    
    if(!isset($_GET['action'])){
        $_SESSION['errors_code1'] = "";
    }
    
    $date = date_create($configDT[0]['lotorry_close']);
    //08/30/2019 11:50 AM
    $dayMach = date_format($date,"l");
    $dayMachCheck = date_format($date,"Y-m-d");

    $RecDataDrawHistory = $db->select("SELECT * FROM bet_lotorry_history WHERE bet_lotorry_date = '".$dayMachCheck."'");
    $RecDataDrawResults = $db->select("SELECT * FROM bet_lotorry_results WHERE id = '".$RecDataDrawHistory[0]['id']."'");
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
                                                    <span class="number" id="numdays">00</span>
                                                    days
                                                </span>
                                                <span class="unit hours">
                                                    <span class="number" id="numhours">00</span>
                                                    hours
                                                </span>
                                                <span class="unit mins">
                                                    <span class="number" id="nummins">00</span>
                                                    <abbr title="Minutes">mins</abbr>
                                                </span>
                                                <span class="unit mins">
                                                    <span class="number" id="numsecond">00</span>
                                                    <abbr title="Minutes">second</abbr>
                                                </span>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-8 colRight pdB30">
                                    <form name="irnumber" id="irnumber" action="bet_lotorry.php?action=saveNumbers" method="post" onkeydown="return event.key != 'Enter';">
                                    <div class="row">
                                        <div class="col-12 hide mgT20" id="erMSG">
                                            <div class="alert alert-danger">
                                                We couldn't process of your entries.
                                            </div>
                                        </div>
                                        <?php if($_SESSION['errors_code1'] != ""){?>
                                        <div class="col-12 mgT20" id="erMSG2">
                                            <div class="alert <?php echo $_SESSION['errors_code1'];?>">
                                                <?php echo $_SESSION['errors_msg1'];?>
                                            </div>
                                        </div>
                                        <?php }?>
                                        <div class="col-9 gameOpen hide">
                                            <p class="heading_draw_based">
                                                <span class="sub_primary">Play Bet lotorry</span><br>
                                                <span class="sub_secondary">Choose 15 teams that you think are lucky.</span>
                                            </p>
                                        </div>
                                        <div class="col-3 gameOpen hide">
                                            <p class="pricePlay">Per play<br><span class="strong"><?php echo $configDT[0]['lotorry_per_play'];?></span> toman</p>
                                        </div>
                                        <div class="col-12 gameOpen hide">
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
                                                    <td><input type="radio" name="betresults[<?php echo $key;?>]" value="1" required></td>
                                                    <td><input type="radio" name="betresults[<?php echo $key;?>]" value="2" ></td>
                                                    <td><input type="radio" name="betresults[<?php echo $key;?>]" value="3" ></td>
                                                    <td><?php echo $vals['away'];?></td>
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                            </table>
                                            <input type="hidden" name="totalPrice" id="totalPrice" value="0">
                                        </div>
                                        <div class="col-12 gameOpen hide">
                                            <p class="pricePlay"><span class="strong">Total: </span> <span id="totalPlay">0</span> Toman</p>
                                        </div>
                                    </div>
                                    <input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>"/>
                                    </form>

                                    <div class="col-12 text-center gameOpen hide">
                                        <button class="genric-btn primary circle arrow" id="btIrMSave" onclick="submitForm();">Confirmation&nbsp;&nbsp;<i class="fa fa-spinner fa-spin hide" aria-hidden="true" id="spexIrMSave"></i></button>
                                    </div>
                                    
                                    <div class="col-12 text-center gameClose hide strong">
                                        Bet lotorry Closed.
                                    </div>
                                    
                                    <div class="col-12 text-center gameClose">
                                        <img src="img/loadding.gif" width="80">
                                    </div>
                                    
                                </div>
                                <div class="col-12 pdL0 pdR0">
                                    <!--Accordion wrapper-->
                                    <div class="accordion md-accordion" id="accordionEx1" role="tablist" aria-multiselectable="true">

                                    <!-- Accordion card -->
                                    <div class="card" style="border-radius: 0px;">

                                        <!-- Card header -->
                                        <div class="card-header" role="tab" id="headingTwo1">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx1" href="#collapseTwo1"
                                            aria-expanded="false" aria-controls="collapseTwo1">
                                            <h5 class="mb-0">
                                            How to play bet lotorry
                                            </h5>
                                        </a>
                                        </div>

                                        <!-- Card body -->
                                        <div id="collapseTwo1" class="collapse" role="tabpanel" aria-labelledby="headingTwo1"
                                        data-parent="#accordionEx1">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    <h2>How to play bet lotorry</h2><br><br>
                                                </div>
                                                <!-- <div class="col-12 col-md-4 text-center">
                                                    <div class="step_1">
                                                        <span class="step_balls textBlack strong">1</span> 
                                                        <img src="img/euro1.png" alt="">
                                                        <span class="step_instruction textBlack strong">Choose your numbers</span>
                                                    </div><br><br>
                                                </div>
                                                <div class="col-12 col-md-4 text-center">
                                                    <div class="step_2">
                                                        <span class="step_balls textBlack strong">2</span> 
                                                        <img src="img/euro2.png" alt="">
                                                        <span class="step_instruction textBlack strong">Choose your draws</span> 
                                                    </div><br><br>
                                                </div>
                                                <div class="col-12 col-md-4 text-center">
                                                    <li class="step_3"> 
                                                        <span class="step_balls textBlack strong">3</span> 
                                                        <img src="img/euro3.png" alt="">
                                                        <span class="step_instruction textBlack strong">You're ready to play</span> 
                                                    </li><br><br>
                                                </div> -->
                                                <!--<div class="col-12 col-md-6 textBlack">
                                                    <h4 class="header_small">Playing with your saved numbers</h4>
                                                    <p>You can save your lucky numbers once you've bought your ticket. You can then play with these numbers as often as you like. Simply select the link above the play slip. For each line played you will automatically get a UK Millionaire Maker code.</p>
                                                </div>
                                                <div class="col-12 col-md-6 textBlack">
                                                <h4 class="header_small">Replay your last numbers</h4>
                                                    <p>We've made it as easy as possible for you to play. You can replay your last numbers by selecting the link above the play slip. You'll get a new UK Millionaire Maker number for each play.</p>
                                                </div>
                                                 <div class="col-12 col-md-6 textBlack">
                                                    <h4 class="header_small">Buy multiple tickets</h4>
                                                    <p>You can buy up to ten play slips at a time, and play up to seven lines of numbers on each play slip. Select 'Add lines' to get started.</p>
                                                </div>
                                                <div class="col-12 col-md-6 textBlack">
                                                <h4 class="header_small">Play EuroMillions by Direct Debit</h4>
                                                    <p>You can now choose to play your EuroMillions numbers by Direct Debit. In fact, it's the most convenient way to play. Simply select 'Continuously by Direct Debit' and we'll enter your numbers into your chosen draws - until you tell us to stop, plus we'll email you if you win.</p>
                                                </div> -->
                                            </div>
                                        </div>
                                        </div>

                                    </div>
                                    <!-- Accordion card -->

                                    </div>
                                    <!-- Accordion wrapper -->
                                </div>
                                
                                <div class="col-12 pdL0 pdR0 mgT30">
                                <h3 class="text-heading">Bet lotorry History</h3>
                                <table id="withdrow" class="table table-striped table-bordered display responsive nowrap" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Around</th>
                                            <th class="text-center">Bet Lotorry</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $RecDataBall = $db->select("SELECT * FROM bet_lotorry_play WHERE player = '".$_SESSION['Player']."' ORDER BY id DESC");
                                        foreach ($RecDataBall as $key => $value) {
                                        
                                            $dateTime =  date("D, d M Y", strtotime($value['date']))." ".$value['time'];

                                            ?>
                                            <tr>
                                                <th><?php echo $key+1;?>.</th>
                                                <th class="text-center"><?php echo $dateTime;?></th>
                                                <th class="text-center"><?php echo $value['around'];?></th>
                                                <th class="text-center"><button class="genric-btn info circle" style="width: 80px;" onclick="window.location='bet_lotorry_detail.php?id=<?php echo $value['id'];?>'">Detail</button></th>
                                                <th class="text-center"><?php if($value['status'] == 1){echo '<button class="genric-btn success circle" style="width: 80px;">'.TITLE_COMPLATED.'</button>';}else if($value['status'] == 2){echo '<button class="genric-btn danger circle" style="width: 80px;">'.TITLE_CANCEL.'</button>';}else{echo '<button class="genric-btn info circle" style="width: 80px;">'.TITLE_PROCESSING.'</button>';}?></th>
                                                </th>
                                            </tr>
                                        <?php }?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Around</th>
                                            <th class="text-center">Bet Lotorry</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </tfoot>
                                </table>		
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
        
        <script>

            function submitForm(){
                //console.log("Submit Form");

                $("#erMSG").addClass('hide');
                $("#erMSG2").addClass('hide');
                $("#btIrMSave").prop('disabled', true);
                $("#spexIrMSave").removeClass('hide');

                checkPrice();

                setTimeout(function(){ 

                     var conD1 = 1;
                     var countCh = 0;

                    $('input[type=radio]:checked').each(function() {
                        //console.log($(this).val(), $(this).attr('name'));
                        countCh++;
                    });
                    
                    if(countCh == 15){conD1 = 0;}
                    else {
                        $("#totalPlay").html(0);
                        $("#totalPrice").val(0);
                    }
                    
                    if(conD1 == 0){
                        $("#irnumber").submit();
                    }else{
                        $("#btIrMSave").prop('disabled', false);
                        $("#spexIrMSave").addClass('hide');
                        $("#erMSG").removeClass('hide');
                        return false;

                        
                    }
                }, 500);
                
            }

            

            function checkPrice(){


                var countCh = 0;

                $('input[type=radio]:checked').each(function() {
                    //console.log($(this).val(), $(this).attr('name'));
                    countCh++;
                });
                if(countCh == 15){
                    $("#totalPlay").html(<?php echo $configDT[0]['lotorry_per_play'];?>);
                    $("#totalPrice").val(<?php echo $configDT[0]['lotorry_per_play'];?>);
                }else{
                    $("#totalPlay").html(0);
                    $("#totalPrice").val(0);
                }

            }

            function isNumberKey(evt){
                var charCode = (evt.which) ? evt.which : evt.keyCode
                return !(charCode > 31 && (charCode < 48 || charCode > 57));
            }

            onload = CountDownTimer('<?php echo $configDT[0]['lotorry_close'];?>', 'countdown');

            function CountDownTimer(dt, id){

                var end = new Date(dt);
                
                var _second = 1000;
                var _minute = _second * 60;
                var _hour = _minute * 60;
                var _day = _hour * 24;
                var timer;
                
                function showRemaining() {
                    var now = new Date();
                    var distance = end - now;
                    if (distance < 0) {
                        
                        clearInterval(timer);

                        document.getElementById('numdays').innerHTML = "00";
                        document.getElementById('numhours').innerHTML = "00";
                        document.getElementById('nummins').innerHTML = "00";
                        document.getElementById('numsecond').innerHTML = "00";

                        document.getElementById(id).innerHTML = 'EXPIRED!';

                        $(".gameClose").removeClass('hide');
                        $(".gameOpen").addClass('hide');
                        
                        return;
                    }
                    var days = Math.floor(distance / _day);
                    var hours = Math.floor((distance % _day) / _hour);
                    var minutes = Math.floor((distance % _hour) / _minute);
                    var seconds = Math.floor((distance % _minute) / _second);
                    
                    
                    if (String(hours).length < 2){
                        hours = 0 + String(hours);
                    }
                    if (String(minutes).length < 2){
                        minutes = 0 + String(minutes);
                    }
                    if (String(seconds).length < 2){
                        seconds = 0 + String(seconds);
                    }
                    
                    
                    var datestr = days + ' days ' + 
                                hours + ' hrs ' + 
                                minutes + ' mins ' + 
                                seconds + ' secs';
                                
                    document.getElementById('numdays').innerHTML = days;
                    document.getElementById('numhours').innerHTML = hours;
                    document.getElementById('nummins').innerHTML = minutes;
                    document.getElementById('numsecond').innerHTML = seconds;

                    $(".gameOpen").removeClass('hide');
                    $(".gameClose").addClass('hide');

                    document.getElementById(id).innerHTML = datestr;
                }
                
                timer = setInterval(showRemaining, 1000);
            }

            $(document).ready(function() {

                $('#withdrow').DataTable(
                    /*responsive: true*/
                );

            } );

        </script>
	</body>
</html>