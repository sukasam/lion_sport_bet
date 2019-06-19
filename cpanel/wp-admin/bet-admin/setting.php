<?php

include_once("../../function/cpanel/app_top.php");
include_once("../../function/poker_config.php");
include_once("../../function/poker_api.php");
include_once('../../_inc/config.php');

if($_GET['action'] == 'resetpoint'){

  if($_GET['ref'] == "top_hand"){
    
    // $postfields = array(
    //     'point_type'=> "top_hand", 
    //     'date'=> date("Y-m-d"),
    //     'time'=> date("H:i:s"),
    //     'action'=>$_SESSION['PlayerAdmin'],
    //     'logs'=>'resetpoint_login',
    // );
    // $response = curl_post(API_SITE,$postfields);

    // $qH = $db->DeleteAll('top_hand');

    // header("Location:setting.php");

  }else if($_GET['ref'] == "top_win"){
    
    // $params = array(
    //   "Command"  => "AccountsList",
    //    "Fields" => "Player,PRake"
    // );

    // $apiUser = Poker_API($params);

    

    // if ($apiUser -> Result == "Ok"){

    //    for($i=0;$i<$apiUser->Accounts;$i++){
    //      set_time_limit(0);
    //     //echo $apiUser -> Player[$i]." ".$apiUser -> PRake[$i]."<br>";
    //     $params2 = array(
    //       "Command"  => "AccountsEdit",
    //        "Player" => $apiUser -> Player[$i],
    //        "PRake" => "0",
    //     );
    //     $apiUser2 = Poker_API($params2);

    //   }

      $qL = $db->DeleteAll('rank_topwin');

      $postfields = array(
          'point_type'=> "top_win", 
          'date'=> date("Y-m-d"),
          'time'=> date("H:i:s"),
          'action'=>$_SESSION['PlayerAdmin'],
          'logs'=>'resetpoint_login',
      );
      
      $response = curl_post(API_SITE,$postfields);

    // }

    header("Location:setting.php");

  }else if($_GET['ref'] == "bad_bit"){
    $postfields = array(
        'point_type'=> "bad_bit", 
        'date'=> date("Y-m-d"),
        'time'=> date("H:i:s"),
        'action'=>$_SESSION['PlayerAdmin'],
        'logs'=>'resetpoint_login',
    );
    $response = curl_post(API_SITE,$postfields);

    $qL = $db->DeleteAll('top_lost');

    header("Location:setting.php");

  }else{
    header("Location:setting.php");
  }
}

if($_GET['action'] == 'submit'){

      $array_fields = array(
        'commission' => $db->CleanDBData($_POST['commission']),
        'currency' => $db->CleanDBData($_POST['currency']),
        'currency_withdraw' => $db->CleanDBData($_POST['currency_withdraw']),
        'maintenance' => $db->CleanDBData($_POST['maintenance']),
        'per_play' => $db->CleanDBData($_POST['per_play']),
        // 'per_lines' => $db->CleanDBData($_POST['per_lines']),
        'per_jackpot' => $db->CleanDBData($_POST['per_jackpot']),
        'game_close' => $db->CleanDBData($_POST['game_close']),
        //'lobby' => $db->CleanDBData($_POST['lobbygame']),
        //'withdraw' => $db->CleanDBData($_POST['withdraw']),
        'card_destination' => $db->CleanDBData($_POST['card_destination']),
        'match1' => $db->CleanDBData($_POST['match1']),
        'match2' => $db->CleanDBData($_POST['match2']),
        'match3' => $db->CleanDBData($_POST['match3']),
        'match4' => $db->CleanDBData($_POST['match4']),
        'match5' => $db->CleanDBData($_POST['match5']),
        'match6' => $db->CleanDBData($_POST['match6']),
        'match7' => $db->CleanDBData($_POST['match7']),
        'match8' => $db->CleanDBData($_POST['match8']),
        'match9' => $db->CleanDBData($_POST['match9']),
        'match10' => $db->CleanDBData($_POST['match10']),
        'match11' => $db->CleanDBData($_POST['match11']),
        'match12' => $db->CleanDBData($_POST['match12']),
        'match13' => $db->CleanDBData($_POST['match13']),
        
      );

      $array_where = array(    
        'sid' => $db->CleanDBData($_POST['sid']),
      );

      $Qry = $db->Update('setting', $array_fields, $array_where);

      header("Location:setting.php");
}else{
    $RecData = $db->select("SELECT * FROM setting WHERE sid ='1' ORDER BY sid DESC");
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>Lion Royal Casino</title>

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />

  <link rel="stylesheet" type="text/css" href="lib/bootstrap-datepicker/css/datepicker.css" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-daterangepicker/daterangepicker.css" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-timepicker/compiled/timepicker.css" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-datetimepicker/css/datetimepicker.css" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
  

  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
  <section id="container">
    <?php include_once("top_bar.php");?>
    <?php include_once("sidebar_menu.php");?>
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Setting</h3>
        <div class="row mt">
          <div class="col-lg-12">
          <div class="form-panel">
              <form class="form-horizontal style-form" method="post" action="setting.php?action=submit">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Commission</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="commission" value="<?php echo $RecData[0]['commission'];?>"> 
                  </div>
                  <div class="col-sm-1"><label class="col-sm-2 control-label">%</label></div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Convert 1 USD (Deposit)</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="currency" value="<?php echo $RecData[0]['currency'];?>"> 
                  </div>
                   <label class="col-sm-1 control-label">Toman</label>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Convert 1 USD (Withdraw)</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="currency_withdraw" value="<?php echo $RecData[0]['currency_withdraw'];?>"> 
                  </div>
                   <label class="col-sm-1 control-label">Toman</label>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Card Destination</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="card_destination" value="<?php echo $RecData[0]['card_destination'];?>"> 
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Site Maintenance</label>
                  <div class="col-sm-10">
                  <select class="form-control" name="maintenance" title="Maintenance">
                      <option value="0" <?php if( $RecData[0]['maintenance'] == '0'){echo 'selected=""';}?>>No</option>
                      <option value="1" <?php if( $RecData[0]['maintenance'] == '1'){echo 'selected=""';}?>>Yes</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label"><strong>Iranian Milioner</strong></label>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Per Play</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="per_play" value="<?php echo $RecData[0]['per_play'];?>"> 
                  </div>
                </div>
                <!-- <div class="form-group">
                  <label class="col-sm-2 control-label">How many Lines?</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="per_lines" value="<?php echo $RecData[0]['per_lines'];?>"> 
                  </div>
                </div> -->

                <div class="form-group">
                  <label class="col-sm-2 control-label">Jackpot : </label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="per_jackpot" value="<?php echo $RecData[0]['per_jackpot'];?>"> 
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Game closes in</label>
                  <div class="col-sm-9">
                    <input size="16" type="text" value="<?php echo $RecData[0]['game_close'];?>" name="game_close" readonly="" class="form_datetime form-control">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label"><strong>Prize breakdown</strong></label>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Match 5 + 2 Stars : </label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="match1" value="<?php echo $RecData[0]['match1'];?>"> 
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Match 5 + 1 Star : </label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="match2" value="<?php echo $RecData[0]['match2'];?>"> 
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Match 5 : </label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="match3" value="<?php echo $RecData[0]['match3'];?>"> 
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Match 4 + 2 Stars : </label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="match4" value="<?php echo $RecData[0]['match4'];?>"> 
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Match 4 + 1 Stars : </label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="match5" value="<?php echo $RecData[0]['match5'];?>"> 
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Match 4 : </label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="match6" value="<?php echo $RecData[0]['match6'];?>"> 
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Match 3 + 2 Stars : </label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="match7" value="<?php echo $RecData[0]['match7'];?>"> 
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Match 3 + 1 Stars : </label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="match8" value="<?php echo $RecData[0]['match8'];?>"> 
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Match 3 : </label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="match9" value="<?php echo $RecData[0]['match9'];?>"> 
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Match 2 + 2 Stars : </label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="match10" value="<?php echo $RecData[0]['match10'];?>"> 
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Match 2 + 1 Stars : </label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="match11" value="<?php echo $RecData[0]['match11'];?>"> 
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Match 2 : </label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="match12" value="<?php echo $RecData[0]['match12'];?>"> 
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Match 1 + 2 Stars : </label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="match13" value="<?php echo $RecData[0]['match13'];?>"> 
                  </div>
                </div>

                <!-- <div class="form-group">
                  <label class="col-sm-2 control-label">Game closes in</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="game_close" value="<?php echo $RecData[0]['game_close'];?>"> 
                  </div>
                </div> -->
                
                
                <!-- <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Lobby game</label>
                  <div class="col-sm-10">
                  <select class="form-control" name="lobbygame" title="Lobby Game">
                      <option value="0" <?php if( $RecData[0]['lobby'] == '0'){echo 'selected=""';}?>>Disable</option>
                      <option value="1" <?php if( $RecData[0]['lobby'] == '1'){echo 'selected=""';}?>>Enable</option>
                    </select>
                  </div>
                </div> -->
                <!-- <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Withdraw Option</label>
                  <div class="col-sm-10">
                  <select class="form-control" name="withdraw" title="Withdraw">
                      <option value="0" <?php if( $RecData[0]['withdraw'] == '0'){echo 'selected=""';}?>>Disable</option>
                      <option value="1" <?php if( $RecData[0]['withdraw'] == '1'){echo 'selected=""';}?>>Enable</option>
                    </select>
                  </div>
                </div> -->
                <div class="form-group">
                  <div class="col-sm-12 text-center">
                  <button class="btn btn-theme" type="submit">Save</button>
                  <input type="hidden" class="form-control" name="sid" value="1">
                  <!-- <button class="btn btn-theme04" type="button" onClick="window.location='setting.php';">Cancel</button> -->
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <?php include_once("footer_bar.php");?>
  </section>

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Reset point (<span class="textDetail"></span>)</h4>
          </div>
          <div class="modal-body">
          Are you sure you want to reset point (<span class="textDetail"></span>)?
          <input type="hidden" name="point_type" id="point_type" value="">
          </div>
          <div class="modal-footer text-center">
            <button type="button" class="btn btn-primary udelBt">Yes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
    
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <!-- <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.js"></script> -->
  <!-- <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script> -->
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="lib/advanced-datatable/js/DT_bootstrap.js"></script>

  <script type="text/javascript" src="lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="lib/bootstrap-daterangepicker/date.js"></script>
  <script type="text/javascript" src="lib/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
  <script type="text/javascript" src="lib/bootstrap-daterangepicker/moment.min.js"></script>
  <script type="text/javascript" src="lib/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>

  <!--common script for all pages-->
  <!-- <script src="lib/common-scripts.js"></script> -->
  <!--script for this page-->

  <script>
  
  $(document).ready(function() {

    $( ".topHandBT" ).click(function() {
      $(".textDetail").text("Top Hand");
      $("#point_type").val("top_hand");
      $("#myModal").modal('show');
    });    

    $( ".topWinBT" ).click(function() {
      $(".textDetail").text("Top Win");
      $("#point_type").val("top_win");
      $("#myModal").modal('show');
    });

     $( ".badBitBT" ).click(function() {
      var player = $(this).val();
      $(".textDetail").text("Bad Bit");
      $("#point_type").val("bad_bit");
      $("#myModal").modal('show');
    });

    $( ".udelBt" ).click(function() {
      window.location.href = 'setting.php?action=resetpoint&ref='+$("#point_type").val();
    });

    $(".form_datetime").datetimepicker({
      format: "mm/dd/yyyy HH:ii P",
      showMeridian: true,
      autoclose: true,
      todayBtn: true
    });
    
  });
  </script>

</body>

</html>
