<?php
 
  include_once("../../function/cpanel/app_top.php");
  include_once("../../function/poker_config.php");
  include_once("../../function/poker_api.php");
  include_once("../../function/fucntion.php");

  if($_GET['action'] == "submit"){

    $dateA = $db->CleanDBData($_POST['dateC']);
    $ball_numbers = $db->CleanDBData($_POST['ball_numbers']);
    $lucky_stars = $db->CleanDBData($_POST['lucky_stars']);

    $insert_arrays = array(
      'date'=> $dateA, 
      'jackpot'=> $db->CleanDBData($_POST['jackpot']), 
      'ball_numbers'=> $ball_numbers, 
      'lucky_stars'=> $lucky_stars, 
      'date_create'=> $db->CleanDBData(date("Y-m-d")),
      'time_create'=> $db->CleanDBData(date("H:i:s")),
    );
    
    $q  = $db->insert('iranian_milioner_history',$insert_arrays);

    
    $configDT = $db->select("SELECT * FROM setting WHERE sid ='1' ORDER BY sid DESC");
    $RecBreakdraw = $db->select("SELECT * FROM iranian_milioner_play WHERE around = '".$_POST['dateC']."'");

    $ballNumList = explode("-",$ball_numbers);
    $luckyStarsList = explode("-",$lucky_stars);

    $listLabel = ["Match 5 + 2 Stars","Match 5 + 1 Stars","Match 5","Match 4 + 2 Stars","Match 4 + 1 Stars","Match 4","Match 3 + 2 Stars","Match 3 + 1 Stars","Match 3","Match 2 + 2 Stars","Match 2 + 1 Stars","Match 2","Match 1 + 2 Stars"];
    $prizeVal = [$configDT[0]['match1'],$configDT[0]['match2'],$configDT[0]['match3'],$configDT[0]['match4'],$configDT[0]['match5'],$configDT[0]['match6'],$configDT[0]['match7'],$configDT[0]['match8'],$configDT[0]['match9'],$configDT[0]['match10'],$configDT[0]['match11'],$configDT[0]['match12'],$configDT[0]['match13']];
    $listWin = chkWin($RecBreakdraw,$ballNumList,$luckyStarsList);

    $sumAllWin = 0;
    $sumTotalPrizePer = 0;

    for($i=0;$i<count($listLabel);$i++){
      set_time_limit(0);

      $sumPrizePer = $listWin[$i] * $prizeVal[$i];

      $insert_arrays2 = array(
        'history_id'=> $q, 
        'around'=> $db->CleanDBData($_POST['dateC']), 
        'matches'=> $listLabel[$i], 
        'all_winners'=> (int)$listWin[$i], 
        'prize_per'=> $prizeVal[$i],
        'cash_prize'=> $sumPrizePer,
      );
      
      $q2  = $db->insert('iranian_milioner_prize',$insert_arrays2);

      $sumAllWin = $sumAllWin+$listWin[$i];
      $sumTotalPrizePer = $sumTotalPrizePer+$sumPrizePer;
    }

    $insert_arrays3 = array(
      'history_id'=> $q, 
      'around'=> $db->CleanDBData($_POST['dateC']), 
      'matches'=> "Totals", 
      'all_winners'=> (int)$sumAllWin, 
      'prize_per'=> "",
      'cash_prize'=> $sumTotalPrizePer,
    );
    
    $q3  = $db->insert('iranian_milioner_prize',$insert_arrays3);

    header("Location:iranian_milioner_results.php");

  }

  $RecData = $db->select("SELECT * FROM setting WHERE sid ='1' ORDER BY sid DESC");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>Lion Royal Sports</title>

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
        <h3><i class="fa fa-angle-right"></i> Iranian Milioner Results (Add)</h3>
        <div class="row mt">
          <div class="col-lg-12">
          <div class="form-panel">
              <form class="form-horizontal style-form" method="post" action="iranian_milioner_results_add.php?action=submit">
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Date</label>
                  <div class="col-sm-10">
                  <?php 
                   $date = date_create($RecData[0]['game_close']);
                   $dayMach = date_format($date,"Y-m-d");?>
                   <input class="form-control form-control-inline input-medium" size="16" type="text" data-inputmask="'mask': '9999-99-99'" value="<?php echo $dayMach;?>" readonly>
                   <input class="form-control form-control-inline input-medium" name="dateC" size="16" type="hidden" data-inputmask="'mask': '9999-99-99'" value="<?php echo $dayMach;?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Jackpot</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="text" value="<?php echo $RecData[0]['per_jackpot'];?>" readonly>
                    <input name="jackpot" type="hidden" class="form-control" value="<?php echo $RecData[0]['per_jackpot'];?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Ball Numbers</label>
                  <div class="col-sm-10">
                    <input type="text" name="ball_numbers" class="form-control" data-inputmask="'mask': '99-99-99-99-99'" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Lucky Stars</label>
                  <div class="col-sm-10">
                    <input type="text" name="lucky_stars" class="form-control" data-inputmask="'mask': '99-99'" value="">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 text-center">
                  <button class="btn btn-theme" type="submit">Save</button>
                  <button class="btn btn-theme04" type="button" onClick="window.location='iranian_milioner_results.php';">Cancel</button>
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
  <script type="text/javascript" src="lib/jquery.inputmask.bundle.min.js"></script>

  <!--common script for all pages-->
  <!-- <script src="lib/common-scripts.js"></script> -->
  <!--script for this page-->

  <script>

  
  $(document).ready(function() {

    $('.default-date-picker').datepicker({
          format: 'yyyy-mm-dd'
    });

    $(":input").inputmask();
    
  });
  </script>


</body>

</html>
