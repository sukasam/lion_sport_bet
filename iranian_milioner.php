<?php
    include_once("function/app_top.php");

    $csrf = new csrf();
    
    // Generate Token Id and Valid
    $token_id = $csrf->get_token_id();
    $token_value = $csrf->get_token($token_id);

    if($_GET['action'] === 'saveNumbers'){
        include_once("function/iranian_milioner.php");
        exit();
    }
    
    if(!isset($_GET['action'])){
        $_SESSION['errors_code1'] = "";
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
                            <h3 class="text-heading"><?php echo HOME_TOP_LOST;?></h3> 
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
                                            <span class="headline">This Friday</span><br>
                                            <span class="amount amount_large"><?php echo $configDT[0]['per_jackpot'];?></span>
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
                                    <form name="irnumber" id="irnumber" action="iranian_milioner.php?action=saveNumbers" method="post">
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
                                                <span class="sub_primary">Play Iranian Milioner</span><br>
                                                <span class="sub_secondary">Enter 5 numbers from 1 to 50 and 2 Lucky Stars from 1 to 12.</span>
                                            </p>
                                        </div>
                                        <div class="col-3 gameOpen hide">
                                            <p class="pricePlay">Per play<br><span class="strong"><?php echo $configDT[0]['per_play'];?></span> toman</p>
                                        </div>
                                        <div class="col-12 gameOpen hide">
                                            <div>
                                                <?php
                                                for($i=1;$i<=$configDT[0]['per_lines'];$i++){
                                                    ?>
                                                    <ul class="drowNum">
                                                        <!-- <li><button class="genric-btn default arrow mb-10 btLuckDip" id="btLuckDip<?php echo $i;?>" value="1" onclick="luckDip(<?php echo $i;?>);"><span style="padding-right: 10px;">Lucky Dip</span></button></li> -->
                                                        <li><input type="tel" maxlength="2" name="number1[]" id="number1<?php echo $i;?>" value="" class="inputText lkd<?php echo $i;?>" onkeypress="return isNumberKey(event);" onfocusout="checkNumFomat('1','number1','<?php echo $i;?>')"></li>
                                                        <li><input type="tel" maxlength="2" name="number2[]" id="number2<?php echo $i;?>" value="" class="inputText lkd<?php echo $i;?>" onkeypress="return isNumberKey(event);" onfocusout="checkNumFomat('1','number2','<?php echo $i;?>')"></li>
                                                        <li><input type="tel" maxlength="2" name="number3[]" id="number3<?php echo $i;?>" value="" class="inputText lkd<?php echo $i;?>" onkeypress="return isNumberKey(event);" onfocusout="checkNumFomat('1','number3','<?php echo $i;?>')"></li>
                                                        <li><input type="tel" maxlength="2" name="number4[]" id="number4<?php echo $i;?>" value="" class="inputText lkd<?php echo $i;?>" onkeypress="return isNumberKey(event);" onfocusout="checkNumFomat('1','number4','<?php echo $i;?>')"></li>
                                                        <li><input type="tel" maxlength="2" name="number5[]" id="number5<?php echo $i;?>" value="" class="inputText lkd<?php echo $i;?>" onkeypress="return isNumberKey(event);" onfocusout="checkNumFomat('1','number5','<?php echo $i;?>')"></li>
                                                        <li><input style="border: 1px solid #000;" type="tel" maxlength="2" name="number6[]" id="number6<?php echo $i;?>" value="" class="inputText lkd<?php echo $i;?>" onkeypress="return isNumberKey(event);" onfocusout="checkNumFomat('2','number6','<?php echo $i;?>')"><span class="game_icon" role="presentation"><!-- --></span></li>
                                                        <li><input style="border: 1px solid #000;" type="tel" maxlength="2" name="number7[]" id="number7<?php echo $i;?>" value="" class="inputText lkd<?php echo $i;?>" onkeypress="return isNumberKey(event);" onfocusout="checkNumFomat('2','number7','<?php echo $i;?>')"><span class="game_icon" role="presentation"></span></li>
                                                        <li><button class="genric-btn default arrow mb-10 btLuckDip" onclick="cancelLuckDip(<?php echo $i;?>);"><span style="padding-right: 10px;">X</span></button></li>
                                                    </ul>
                                                    <p class="txtErr txtErrors<?php echo $i;?> hide"></p>
                                                    <?php
                                                }
                                                ?>
                                                <input type="hidden" name="totalPrice" id="totalPrice" value="0">
                                            </div>
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
                                        Iranian Milioner Closed.
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
                                            How to play Iranian Milioner
                                            </h5>
                                        </a>
                                        </div>

                                        <!-- Card body -->
                                        <div id="collapseTwo1" class="collapse" role="tabpanel" aria-labelledby="headingTwo1"
                                        data-parent="#accordionEx1">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    <h2>How to play Iranian Milioner</h2><br><br>
                                                </div>
                                                <div class="col-12 col-md-4 text-center">
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
                                                </div>
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
                                <h3 class="text-heading">Iranian Milioner History</h3>
                                <table id="withdrow" class="table table-striped table-bordered display responsive nowrap" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Ball Numbers</th>
                                            <th class="text-center">Lucky Stars</th>
                                            <th class="text-center">Around</th>
                                            <th class="text-center">Results</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $RecDataBall = $db->select("SELECT * FROM iranian_milioner_play WHERE player = '".$_SESSION['Player']."' ORDER BY id DESC");
                                        foreach ($RecDataBall as $key => $value) {
                                        
                                            $dateTime =  date("D, d M Y", strtotime($value['date']))." ".$value['time'];


                                            ?>
                                            <tr>
                                                <th><?php echo $key+1;?>.</th>
                                                <th class="text-center"><?php echo $dateTime;?></th>
                                                <th class="text-center"><?php echo $value['ball_numbers'];?></th>
                                                <th class="text-center"><?php echo $value['lucky_stars'];?></th>
                                                <th class="text-center"><?php echo $value['around'];?></th>
                                                <th class="text-center"><?php if($value['status'] == 1){echo '<button class="genric-btn success circle" style="width: 80px;">'.TITLE_COMPLATED.'</button>';}else if($value['status'] == 2){echo '<button class="genric-btn danger circle" style="width: 80px;">'.TITLE_CANCEL.'</button>';}else{echo '<button class="genric-btn info circle" style="width: 80px;">'.TITLE_PROCESSING.'</button>';}?></th>
                                                </th>
                                            </tr>
                                        <?php }?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Ball Numbers</th>
                                            <th class="text-center">Lucky Stars</th>
                                            <th class="text-center">Around</th>
                                            <th class="text-center">Results</th>
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
            var numList1 = ["","","","","","",""];
            var numList2 = ["","","","","","",""];
            var numList3 = ["","","","","","",""];
            var numList4 = ["","","","","","",""];

            function checkNumFomat(numR,numE,id){

                var elm = parseInt(numE.slice(-1)-1);
                if(id == 1){
                    numList1[elm] = $("#"+numE+id).val();
                    checkCondition(numList1,id,numR);
                }else if(id == 2){
                    numList2[elm] = $("#"+numE+id).val();
                    checkCondition(numList2,id,numR);
                }else if(id == 3){
                    numList3[elm] = $("#"+numE+id).val();
                    checkCondition(numList3,id,numR);
                }else{
                    numList4[elm] = $("#"+numE+id).val();
                    checkCondition(numList4,id,numR);
                }
                
            }

            function find_duplicate_in_array(arra1) {
                var object = {};
                var result = [];

                arra1.forEach(function (item) {
                if(!object[item])
                    object[item] = 0;
                    object[item] += 1;
                })

                for (var prop in object) {
                if(object[prop] >= 2) {
                    //console.log(prop);
                    if(prop !== "NaN"){
                        result.push(prop);
                    }
                }
                }

                return result;

            }

            function checkPay(numlist){

                var listErrC1 = 0;
                var dupPicat1 = 0;

                var listErrC2 = 0;
                var dupPicat2 = 0;

                var checkDup1 = [];
                var checkDup2= [];

                //console.log(numlist);

                $.each(numlist, function( key, value ) {
                    //alert( key + ": " + value );

                    if(key == 5 || key == 6){
                        
                        if(parseInt(value) > 12 || parseInt(value) < 1){
                            listErrC2 = 1;
                        }
                        
                        checkDup2.push(parseInt(value));
                        
                    }else{

                        if(parseInt(value) > 50 || parseInt(value) < 1){
                            listErrC1 = 1;
                        }
                        
                        checkDup1.push(parseInt(value));
                        
                    }

                });

                if(find_duplicate_in_array(checkDup2).length >= 1){
                    listErrC2 = 1;
                    dupPicat2 = 1;
                }

                if(find_duplicate_in_array(checkDup1).length >= 1){
                    listErrC1 = 1;
                    dupPicat1 = 1;
                }

                if(listErrC1 == 1){
                    if(dupPicat1 == 1){
                        // $(".txtErrors"+id).html('You entered a number twice');
                        // $(".txtErrors"+id).removeClass('hide');
                        // //$("#btIrMSave").prop('disabled', false);
                        return false;
                    }else{
                        // $(".txtErrors"+id).html('Enter numbers between 1 - 50');
                        // $(".txtErrors"+id).removeClass('hide');
                        // //$("#btIrMSave").prop('disabled', false);
                        return false;
                    }
                }else{
                    if(listErrC2 == 1){
                        if(dupPicat2 == 1){
                            // $(".txtErrors"+id).html('You entered a number twice');
                            // $(".txtErrors"+id).removeClass('hide');
                            //$("#btIrMSave").prop('disabled', false);
                            return false;
                        }else{
                            // $(".txtErrors"+id).html('Enter numbers between 1 - 12');
                            // $(".txtErrors"+id).removeClass('hide');
                            //$("#btIrMSave").prop('disabled', false);
                            return false;
                        }
                    }else{
                        // $(".txtErrors"+id).html('');
                        // $(".txtErrors"+id).addClass('hide');
                        //$("#btIrMSave").prop('disabled', false);
                        if(numlist[5] != "" && numlist[6] != ""){
                            return true;
                        }else{
                            return false;
                        }
                    }
                }

            }

            function submitForm(){
                //console.log("Submit Form");

                $("#erMSG").addClass('hide');
                $("#erMSG2").addClass('hide');
                $("#btIrMSave").prop('disabled', true);
                $("#spexIrMSave").removeClass('hide');

                checkPrice();

                setTimeout(function(){ 

                    var conD1 = 0;
                    var conD2 = 0;
                    var conD3 = 0;
                    var conD4 = 0;
                    
                    if(numList1[0] != ""){
                        if(numList1[0] != ""){
                            if(checkPay(numList1) === false){
                                conD1 = 1;
                            }
                        }

                        if(numList2[0] != ""){
                            if(checkPay(numList2) === false){
                                conD2 = 1;
                            }
                        }

                        if(numList3[0] != ""){
                            if(checkPay(numList3) === false){
                                conD3 = 1;
                            }
                        }

                        if(numList4[0] != ""){
                            if(checkPay(numList4) === false){
                                conD4 = 1;
                            }
                        }
                    }else{
                        $("#erMSG").removeClass('hide');
                        $("#btIrMSave").prop('disabled', false);
                        $("#spexIrMSave").addClass('hide');
                        return false;
                    }
                    

                    if(conD1 == 0 && conD2 == 0 && conD3 == 0 && conD4 == 0){
                        $("#irnumber").submit();
                    }else{
                        $("#btIrMSave").prop('disabled', false);
                        $("#spexIrMSave").addClass('hide');
                        $("#erMSG").removeClass('hide');
                        return false;
                    }
                }, 500);
                

                // console.log("conD1 = "+conD1);
                // console.log("conD2 = "+conD2);
                // console.log("conD3 = "+conD3);
                // console.log("conD4 = "+conD4);
            }

            function checkCondition(numlist,id,numR){

                var listErrC1 = 0;
                var dupPicat1 = 0;
                
                var listErrC2 = 0;
                var dupPicat2 = 0;

                var checkDup1 = [];
                var checkDup2= [];

                //console.log(numlist);

                $.each(numlist, function( key, value ) {
                    //alert( key + ": " + value );

                    if(key == 5 || key == 6){
                        
                        if(parseInt(value) > 12 || parseInt(value) < 1){
                            listErrC2 = 1;
                        }
                        
                        checkDup2.push(parseInt(value));
                        
                    }else{

                        if(parseInt(value) > 50 || parseInt(value) < 1){
                            listErrC1 = 1;
                        }
                        
                        checkDup1.push(parseInt(value));
                        
                    }

                });

                if(find_duplicate_in_array(checkDup2).length >= 1){
                    listErrC2 = 1;
                    dupPicat2 = 1;
                }

                if(find_duplicate_in_array(checkDup1).length >= 1){
                    listErrC1 = 1;
                    dupPicat1 = 1;
                }

                if(listErrC1 == 1){
                    if(dupPicat1 == 1){
                        $(".txtErrors"+id).html('You entered a number twice');
                        $(".txtErrors"+id).removeClass('hide');
                        //$("#btIrMSave").prop('disabled', false);
                    }else{
                        $(".txtErrors"+id).html('Enter numbers between 1 - 50');
                        $(".txtErrors"+id).removeClass('hide');
                        //$("#btIrMSave").prop('disabled', false);
                    }
                }else{
                    if(listErrC2 == 1){
                        if(dupPicat2 == 1){
                            $(".txtErrors"+id).html('You entered a number twice');
                            $(".txtErrors"+id).removeClass('hide');
                            //$("#btIrMSave").prop('disabled', false);
                        }else{
                            $(".txtErrors"+id).html('Enter numbers between 1 - 12');
                            $(".txtErrors"+id).removeClass('hide');
                            //$("#btIrMSave").prop('disabled', false);
                        }
                    }else{
                        $(".txtErrors"+id).html('');
                        $(".txtErrors"+id).addClass('hide');
                        //$("#btIrMSave").prop('disabled', false);
                    }
                }

                // console.log("listErrC1 = "+listErrC1);
                // console.log("dupPicat1 = "+dupPicat1);
                // console.log("listErrC2 = "+listErrC2);
                // console.log("dupPicat2 = "+dupPicat2);

                checkPrice();
            }

            function checkPrice(){
                // console.log(JSON.stringify(numList1));
                // console.log(JSON.stringify(numList2));
                // console.log(JSON.stringify(numList3));
                // console.log(JSON.stringify(numList4));

                var numPrice = parseInt(<?php echo $configDT[0]['per_play'];?>);
                var totalPrice = 0;

                if(numList1[0] != ""){
                    totalPrice = parseInt(totalPrice + numPrice);
                }
                if(numList2[0] != ""){
                    totalPrice = parseInt(totalPrice + numPrice);
                }
                if(numList3[0] != ""){
                    totalPrice = parseInt(totalPrice + numPrice);
                }
                if(numList4[0] != ""){
                    totalPrice = parseInt(totalPrice + numPrice);
                }

                $("#totalPlay").html(totalPrice);
                $("#totalPrice").val(totalPrice);
                //console.log("numPrice = "+totalPrice);
            }

            function luckDip(id){

                if(id == 1){
                    numList1 = ["","","","","","",""];
                }else if(id == 2){
                    numList2 = ["","","","","","",""];
                }else if(id == 3){
                    numList3 = ["","","","","","",""];
                }else{
                    numList4 = ["","","","","","",""];
                }

                if($("#btLuckDip"+id).val() == 1){
                    $(".lkd"+id).prop('disabled', true);
                    $(".lkd"+id).addClass('inputDisabled');
                    $("#btLuckDip"+id).val(2);
                    $(".lkd"+id).val('');
                    $(".lkd"+id).addClass('luckyDisabled');
                    $(".txtErrors"+id).addClass('hide');
                    
                }else{
                    $(".lkd"+id).prop('disabled', false);
                    $(".lkd"+id).removeClass('inputDisabled');
                    $("#btLuckDip"+id).val(1);
                    $(".lkd"+id).val('');
                    $(".lkd"+id).removeClass('luckyDisabled');
                    $(".txtErrors"+id).addClass('hide');

                }

            }
            function cancelLuckDip(id){

                if(id == 1){
                    numList1 = ["","","","","","",""];
                }else if(id == 2){
                    numList2 = ["","","","","","",""];
                }else if(id == 3){
                    numList3 = ["","","","","","",""];
                }else{
                    numList4 = ["","","","","","",""];
                }

                $(".lkd"+id).prop('disabled', false);
                $(".lkd"+id).removeClass('inputDisabled');
                $("#btLuckDip"+id).val(1);
                $(".lkd"+id).val('');
                $(".lkd"+id).removeClass('luckyDisabled');
                $(".txtErrors"+id).addClass('hide');

                checkPrice();
                
            }

            function isNumberKey(evt){
                var charCode = (evt.which) ? evt.which : evt.keyCode
                return !(charCode > 31 && (charCode < 48 || charCode > 57));
            }

            onload = CountDownTimer('<?php echo $configDT[0]['game_close'];?>', 'countdown');

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