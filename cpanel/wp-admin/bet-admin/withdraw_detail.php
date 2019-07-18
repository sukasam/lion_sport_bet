<?php
 
  include_once("../../function/cpanel/app_top.php");

  if($_GET['action'] == "submit"){
      $array_fields = array(
			'status' => $_POST['status'],
			);
		
			$array_where = array(    
			'id' => $_POST['id'],
			);
		
      echo $q = $db->Update('withdraw_history', $array_fields, $array_where);
      
    header("Location:withdraw.php");
  }

  $RecDataWithdraw = $db->select("SELECT * FROM withdraw_history WHERE id = '".$_GET['id']."'");
  $RecDataBank = $db->select("SELECT * FROM bank_info WHERE player = '".$RecDataWithdraw[0]['player']."'  ORDER BY id DESC");

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
        <h3><i class="fa fa-angle-right"></i>Withdraw (User Account -> <?php echo $RecDataWithdraw[0]['player'];?>)</h3>
        <div class="row mt">
          <div class="col-lg-12">
          <div class="form-panel">
              <form class="form-horizontal style-form" method="post" action="withdraw_detail.php?action=submit">
                <div class="form-group">
                  <label class="col-lg-2 col-sm-2 control-label">Player</label>
                  <div class="col-lg-10">
                    <p class="form-control-static"><?php echo $RecDataWithdraw[0]['player'];?></p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Amount</label>
                  <div class="col-sm-10">
                  <p class="form-control-static"><?php echo number_format($RecDataWithdraw[0]['amount']);?></p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Bank Name</label>
                  <div class="col-sm-10">
                    <p class="form-control-static"><?php echo $RecDataBank[0]['bank_name'];?></p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Fullname</label>
                  <div class="col-sm-10">
                    <p class="form-control-static"><?php echo $RecDataBank[0]['fullname'];?></p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Card number</label>
                  <div class="col-sm-10">
                    <p class="form-control-static"><?php echo $RecDataBank[0]['bank_card'];?></p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Sheba number</label>
                  <div class="col-sm-10">
                    <p class="form-control-static"><?php echo $RecDataBank[0]['bank_sheba'];?></p>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Status</label>
                    <div class="col-sm-10">
                    <select class="form-control" name="status" title="status">
                      <option value="0" <?php if($RecDataWithdraw[0]['status'] == '0'){echo 'selected=""';}?>>Processing</option>
                      <option value="1" <?php if($RecDataWithdraw[0]['status'] == '1'){echo 'selected=""';}?>>Complated</option>
                      <!-- <option value="2" <?php if($RecDataWithdraw[0]['status'] == '2'){echo 'selected=""';}?>>Cancel</option> -->
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 text-center">
                  <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
                  <button class="btn btn-theme" type="submit">Save</button>
                  <button class="btn btn-theme04" type="button" onClick="window.location='withdraw.php';">Cancel</button>
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
