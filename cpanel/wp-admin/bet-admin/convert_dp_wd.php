<?php

include_once "../../function/cpanel/app_top.php";

if (isset($_GET['action']) && $_GET['action'] === 'submit') {

    $sid = $db->CleanDBData($_POST['sid']);
    $currency = $db->CleanDBData($_POST['currency']);
    $currency_cc = $db->CleanDBData($_POST['currency_cc']);
    $currency_withdraw = $db->CleanDBData($_POST['currency_withdraw']);

    $sqlu2 = "update setting set currency=?,currency_cc=?, currency_withdraw=? where sid=?";
    $values2 = array($currency, $currency_cc, $currency_withdraw, $sid);
    $model->doUpdate($sqlu2, $values2);

    header("Location:convert_dp_wd.php");

} else {
    $RecDataSQL = "SELECT * FROM setting WHERE `sid` = ? LIMIT 1";
    $valuesRecDataSQL = array('1');
    $RecData = $model->doSelect($RecDataSQL, $valuesRecDataSQL);
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
    <?php include_once "top_bar.php";?>
    <?php include_once "sidebar_menu.php";?>
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Convert DP & WD</h3>
        <div class="row mt">
          <div class="col-lg-12">
          <div class="form-panel">
              <form class="form-horizontal style-form" method="post" action="convert_dp_wd.php?action=submit">
                <!-- <div class="form-group">
                  <label class="col-sm-2 control-label">Commission</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="commission" value="<?php echo $RecData[0]['commission']; ?>">
                  </div>
                  <div class="col-sm-1"><label class="col-sm-2 control-label">%</label></div>
                </div> -->
                <div class="form-group">
                  <label class="col-sm-2 control-label">Convert 1 USD (Deposit)<br>Perfect Money</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="currency" value="<?php echo $RecData[0]['currency']; ?>">
                  </div>
                   <label class="col-sm-1 control-label">Toman</label>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Convert 1 USD (Deposit)<br>Cryptocurrency</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="currency_cc" value="<?php echo $RecData[0]['currency_cc']; ?>">
                  </div>
                   <label class="col-sm-1 control-label">Toman</label>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Convert 1 USD (Cash Outs)<br>Perfect Money</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="currency_withdraw" value="<?php echo $RecData[0]['currency_withdraw']; ?>">
                  </div>
                   <label class="col-sm-1 control-label">Toman</label>
                </div>
                <!-- <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Site Maintenance</label>
                  <div class="col-sm-10">
                  <select class="form-control" name="maintenance" title="Maintenance">
                      <option value="0" <?php if ($RecData[0]['maintenance'] == '0') {echo 'selected=""';}?>>No</option>
                      <option value="1" <?php if ($RecData[0]['maintenance'] == '1') {echo 'selected=""';}?>>Yes</option>
                    </select>
                  </div>
                </div> -->
                <!-- <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Lobby game</label>
                  <div class="col-sm-10">
                  <select class="form-control" name="lobbygame" title="Lobby Game">
                      <option value="0" <?php if ($RecData[0]['lobby'] == '0') {echo 'selected=""';}?>>Disable</option>
                      <option value="1" <?php if ($RecData[0]['lobby'] == '1') {echo 'selected=""';}?>>Enable</option>
                    </select>
                  </div>
                </div> -->
                <!-- <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Withdraw Option</label>
                  <div class="col-sm-10">
                  <select class="form-control" name="withdraw" title="Withdraw">
                      <option value="0" <?php if ($RecData[0]['withdraw'] == '0') {echo 'selected=""';}?>>Disable</option>
                      <option value="1" <?php if ($RecData[0]['withdraw'] == '1') {echo 'selected=""';}?>>Enable</option>
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



                <!-- <div class="form-group">
                  <label class="col-sm-2 control-label">Game closes in</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="game_close" value="<?php echo $RecData[0]['game_close']; ?>">
                  </div>
                </div> -->


                <!-- <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Lobby game</label>
                  <div class="col-sm-10">
                  <select class="form-control" name="lobbygame" title="Lobby Game">
                      <option value="0" <?php if ($RecData[0]['lobby'] == '0') {echo 'selected=""';}?>>Disable</option>
                      <option value="1" <?php if ($RecData[0]['lobby'] == '1') {echo 'selected=""';}?>>Enable</option>
                    </select>
                  </div>
                </div> -->
                <!-- <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Withdraw Option</label>
                  <div class="col-sm-10">
                  <select class="form-control" name="withdraw" title="Withdraw">
                      <option value="0" <?php if ($RecData[0]['withdraw'] == '0') {echo 'selected=""';}?>>Disable</option>
                      <option value="1" <?php if ($RecData[0]['withdraw'] == '1') {echo 'selected=""';}?>>Enable</option>
                    </select>
                  </div>
                </div> -->


              </form>
            </div>
          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <?php include_once "footer_bar.php";?>
  </section>

  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <!-- <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.js"></script> -->
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
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
  <script src="lib/common-scripts.js"></script>
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
