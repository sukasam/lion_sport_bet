<?php

include_once("../../function/cpanel/app_top.php");
include_once("../../function/poker_config.php");
include_once("../../function/poker_api.php");
include_once('../../_inc/config.php');

if($_GET['action'] == 'submit'){

      $array_fields = array(
        'poker_register' => $db->CleanDBData($_POST['poker_register']),
        'poker_login' => $db->CleanDBData($_POST['poker_login']),
      );

      $array_where = array(    
        'sid' => $db->CleanDBData($_POST['sid']),
      );

      $Qry = $db->Update('setting', $array_fields, $array_where);

      header("Location:poker_setting.php");
}else{
    $RecData = $db->select("SELECT `poker_register`,`poker_login` FROM setting WHERE sid ='1' ORDER BY sid DESC");
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
        <h3><i class="fa fa-angle-right"></i>Poker Setting</h3>
        <div class="row mt">
          <div class="col-lg-12">
          <div class="form-panel">
              <form class="form-horizontal style-form" method="post" action="poker_setting.php?action=submit">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Register Link</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="poker_register" value="<?php echo $RecData[0]['poker_register'];?>"> 
                  </div>
                  <div class="col-sm-1"><label class="col-sm-2 control-label"></label></div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Login Link</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="poker_login" value="<?php echo $RecData[0]['poker_login'];?>"> 
                  </div>
                  <div class="col-sm-1"><label class="col-sm-2 control-label"></label></div>
                </div>
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
