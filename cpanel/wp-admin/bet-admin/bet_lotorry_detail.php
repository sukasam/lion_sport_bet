<?php
 
  include_once("../../function/cpanel/app_top.php");
  include_once("../../function/poker_config.php");
  include_once("../../function/poker_api.php");

  if(!isset($_GET['id']) || $_GET['id'] === ""){
    header("Location:bet_lotorry_results.php");
  }
  $RecDataDrawResults = $db->select("SELECT * FROM bet_lotorry_play_results WHERE id = '".$_GET['id']."'");

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
        <h3><i class="fa fa-angle-right"></i> Bet Lotorry (Game -> <?php echo $_GET['Player'];?>)</h3>
        <div class="row mt">
          <div class="col-lg-12">
          <div class="form-panel">
              <form class="form-horizontal style-form" method="post" action="user_account_balance.php?action=submit">
                <div class="form-group">
                  <label class="col-lg-2 col-sm-2 control-label">Player</label>
                  <div class="col-lg-10">
                    <p class="form-control-static"><?php echo $_GET['Player'];?></p>
                    <input type="hidden" name="Player" class="form-control" value="<?php echo $RecDataUser[0]['Player'];?>">
                  </div>
                </div>
                <div class="form-group">
                  
                  <div class="col-sm-12">
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
                            <td><input type="radio" name="betresults<?php echo $key;?>" value="1" <?php if($vals['results'] == "1"){echo 'checked';}else{echo 'disabled';}?>></td>
                            <td><input type="radio" name="betresults<?php echo $key;?>" value="2" <?php if($vals['results'] == "2"){echo 'checked';}else{echo 'disabled';}?>></td>
                            <td><input type="radio" name="betresults<?php echo $key;?>" value="3" <?php if($vals['results'] == "3"){echo 'checked';}else{echo 'disabled';}?>></td>
                            <td><?php echo $vals['away'];?></td>
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
                  <button class="btn btn-theme04" type="button" onClick="window.location='bet_lotorry_play.php';"><< Back</button>
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
  <script src="lib/jquery-ui-1.9.2.custom.min.js"></script>
  <script src="lib/jquery.ui.touch-punch.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <!--script for this page-->

</body>

</html>
