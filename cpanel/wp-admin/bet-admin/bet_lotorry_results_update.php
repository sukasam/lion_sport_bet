<?php
 
  include_once("../../function/cpanel/app_top.php");
  include_once("../../function/poker_config.php");
  include_once("../../function/poker_api.php");
  include_once("../../function/fucntion.php");

  if($_GET['action'] == "submit"){

    $id = $db->CleanDBData($_POST['id']);
    $bethome = $_POST['bethome'];
    $betresults = $_POST['betresults'];
    $betaway = $_POST['betaway'];
    
    $array_whereD = array(    
			'id' => $id,
			);
    $qH = $db->Delete('bet_lotorry_results',$array_whereD);

    for($i=0;$i<=count($bethome);$i++){
      if($bethome[$i]){
        //echo $bethome[$i]." - ".$betresults[$i]." - " .$bethome[$i]."<br/>";
        $insert_arrays = array(
          'id'=> $id, 
          'home'=> $bethome[$i], 
          'results'=> $betresults[$i], 
          'away'=> $bethome[$i], 
        );
      
        $q = $db->insert('bet_lotorry_results', $insert_arrays);

      }
    } 

    $array_whereD = array(    
			'history_id' => $id,
			);
    $qP = $db->Delete('bet_lotorry_prize',$array_whereD);

    $configDTP = $db->select("SELECT * FROM setting WHERE sid ='1' ORDER BY sid DESC");
  
    $listLabel = ["Match 15","Match 14","Match 5","Match 13","Match 12","Match 11","Match 10","Match 9","Match 8","Match 7","Match 6","Match 5","Match 4","Match 3","Match 2","Match 1"];
    $prizeVal = [$configDTP[0]['lotorry_match1'],$configDTP[0]['lotorry_match2'],$configDTP[0]['lotorry_match3'],$configDTP[0]['lotorry_match4'],$configDTP[0]['lotorry_match5'],$configDTP[0]['lotorry_match6'],$configDTP[0]['lotorry_match7'],$configDTP[0]['lotorry_match8'],$configDTP[0]['lotorry_match9'],$configDTP[0]['lotorry_match10'],$configDTP[0]['lotorry_match11'],$configDTP[0]['lotorry_match12'],$configDTP[0]['lotorry_match13'],$configDTP[0]['lotorry_match14'],$configDTP[0]['lotorry_match15']];
    

    $listWin = chkWinLotorry($db,$_POST['dateC'],$betresults);

    $sumAllWin = 0;
    $sumTotalPrizePer = 0;

    for($i=0;$i<count($listLabel);$i++){
      set_time_limit(0);

      $sumPrizePer = $listWin[$i] * $prizeVal[$i];

      $insert_arrays2 = array(
        'history_id'=> $id, 
        'around'=> $db->CleanDBData($_POST['dateC']), 
        'matches'=> $listLabel[$i], 
        'all_winners'=> (int)$listWin[$i], 
        'prize_per'=> $prizeVal[$i],
        'cash_prize'=> $sumPrizePer,
      );

      $q2  = $db->insert('bet_lotorry_prize',$insert_arrays2);

      $sumAllWin = $sumAllWin+$listWin[$i];
      $sumTotalPrizePer = $sumTotalPrizePer+$sumPrizePer;
      
    }

    $insert_arrays3 = array(
      'history_id'=> $_POST['id'], 
      'around'=> $db->CleanDBData($_POST['dateC']), 
      'matches'=> "Totals", 
      'all_winners'=> (int)$sumAllWin, 
      'prize_per'=> "",
      'cash_prize'=> $sumTotalPrizePer,
    );
    
    $q3  = $db->insert('bet_lotorry_prize',$insert_arrays3);

    header("Location:bet_lotorry_results.php");


  }
  
  $RecDataDrawHistory = $db->select("SELECT * FROM bet_lotorry_history WHERE id = '".$_GET['id']."'");
  $RecDataDrawResults = $db->select("SELECT * FROM bet_lotorry_results WHERE id = '".$RecDataDrawHistory[0]['id']."'");

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
        <h3><i class="fa fa-angle-right"></i> Bet lotorry Results (Add)</h3>
        <div class="row mt">
          <div class="col-lg-12">
          <div class="form-panel">
              <form class="form-horizontal style-form" method="post" action="bet_lotorry_results_update.php?action=submit">
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Date</label>
                  <div class="col-sm-10">
                  <?php 
                   $date = date_create($RecDataDrawHistory[0]['bet_lotorry_date']);
                   $dayMach = date_format($date,"Y-m-d");?>
                   <input class="form-control form-control-inline input-medium" size="16" type="text" data-inputmask="'mask': '9999-99-99'" value="<?php echo $dayMach;?>" readonly>
                   <input class="form-control form-control-inline input-medium" name="dateC" size="16" type="hidden" data-inputmask="'mask': '9999-99-99'" value="<?php echo $dayMach;?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Jackpot</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="text" value="<?php echo $RecDataDrawHistory[0]['bet_lotorry_jackpot'];?>" readonly>
                    <input name="bet_lotorry_jackpot" type="hidden" class="form-control" value="<?php echo $RecDataDrawHistory[0]['bet_lotorry_jackpot'];?>">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                  <table class="table table-betlotorry">
                    <thead>
                      <tr>
                        <th>No.</th>
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
                        <td><input type="text" name="bethome[]" class="form-control" value="<?php echo $vals['home'];?>" required></td>
                        <td><input type="radio" name="betresults[<?php echo $key;?>]" value="1" <?php if($vals['results'] === "1"){echo 'checked';}?>></td>
                        <td><input type="radio" name="betresults[<?php echo $key;?>]" value="2" <?php if($vals['results'] === "2"){echo 'checked';}?>></td>
                        <td><input type="radio" name="betresults[<?php echo $key;?>]" value="3" <?php if($vals['results'] === "3"){echo 'checked';}?>></td>
                        <td><input type="text" name="betaway" class="form-control" value="<?php echo $vals['away'];?>" required></td>
                      </tr>
                      <?php
                      }
                      ?>
                    </tbody>
                    </table>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 text-center">
                  <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
                  <button class="btn btn-theme" type="submit">Save</button>
                  <button class="btn btn-theme04" type="button" onClick="window.location='bet_lotorry_results.php';">Cancel</button>
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
