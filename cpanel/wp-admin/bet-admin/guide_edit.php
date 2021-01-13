<?php

include_once "../../function/cpanel/app_top.php";
include_once "../../function/poker_config.php";
include_once "../../function/poker_api.php";
include_once "../../function/fucntion.php";
include_once "fckeditor/fckeditor.php";

if (isset($_GET['action']) && $_GET['action'] === "submit") {

    $id = $db->CleanDBData($_POST['id']);
    $g_name = $db->CleanDBData($_POST['g_name']);
    $g_detail = addslashes($_POST['g_detail']);
    $g_status = $db->CleanDBData($_POST['g_status']);

    $array_fields = array(
      'g_name' => $g_name,
      'g_detail' => $g_detail,
      'status' => $g_status,
    );
    $array_where = array(
        'id' => $id,
    );

    $q = $db->Update('guide', $array_fields, $array_where);

    header("Location:guide.php");

}

$RecDataGuide = $db->select("SELECT * FROM guide WHERE `id` = '" . $_GET['id'] . "'");

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
        <h3><i class="fa fa-angle-right"></i> Guide (Edit)</h3>
        <div class="row mt">
          <div class="col-lg-12">
          <div class="form-panel">
              <form class="form-horizontal style-form" method="post" action="guide_edit.php?action=submit">
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Name</label>
                  <div class="col-sm-10">
                    <input name="g_name" type="text" class="form-control" value="<?php echo $RecDataGuide[0]['g_name']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Detail</label>
                  <div class="col-sm-10">
                  <?php  //--------เรียกใช้ fckeditor--------------------- 
                    $oFCKeditor = new FCKeditor('g_detail') ;
                    $oFCKeditor->BasePath = 'fckeditor/';
                    //$oFCKeditor->ToolbarSet	= 'Default' ;
                    $oFCKeditor->ToolbarSet	= 'Basic' ;
                    $oFCKeditor->Height	= 400;
                    $oFCKeditor->Value = stripslashes($RecDataGuide[0]['g_detail']);
                    $oFCKeditor->Create() ;
                ?>
                  <!-- <textarea rows="20" id="g_detail" name="g_detail" class="form-control"><?php echo strip_tags($RecDataGuide[0]['g_detail']); ?></textarea> -->
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Status</label>
                  <div class="col-sm-10">
                  <select class="form-control" name="g_status" title="g_status">
                      <option value="0" <?php if( $RecDataGuide[0]['status'] == '0'){echo 'selected=""';}?>>Enable</option>
                      <option value="1" <?php if( $RecDataGuide[0]['status'] == '1'){echo 'selected=""';}?>>Disable</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 text-center">
                  <input name="id" type="hidden" class="form-control" value="<?php echo $RecDataGuide[0]['id']; ?>">
                  <button class="btn btn-theme" type="submit">Save</button>
                  <button class="btn btn-theme04" type="button" onClick="window.location='guide.php';">Cancel</button>
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
    <?php include_once "footer_bar.php";?>
  </section>

  <!-- js placed at the end of the document so the pages load faster -->
  <!-- <script src="lib/jquery/jquery.min.js"></script> -->
  <!-- <script src="lib/bootstrap/js/bootstrap.min.js"></script> -->
  <!-- <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.js"></script> -->
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <!-- <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="lib/advanced-datatable/js/DT_bootstrap.js"></script> -->

  <script type="text/javascript" src="lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="lib/bootstrap-daterangepicker/date.js"></script>
  <script type="text/javascript" src="lib/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
  <script type="text/javascript" src="lib/bootstrap-daterangepicker/moment.min.js"></script>
  <script type="text/javascript" src="lib/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
  <script type="text/javascript" src="lib/jquery.inputmask.bundle.min.js"></script>

  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <!--script for this page-->

</body>

</html>
