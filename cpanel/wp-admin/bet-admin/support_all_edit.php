<?php

include_once "../../function/cpanel/app_top.php";

if (isset($_GET['Player']) && $_GET['Player'] != "") {
    $RecDataSQL = "SELECT * FROM support WHERE player = ? ORDER BY id DESC";
    $values = array($_GET['Player']);
    $RecData = $model->doSelect($RecDataSQL, $values);
} else {
    header("Location:support_all.php");
}

if (isset($_GET['action']) && $_GET['action'] === "submit") {

    $s_message = nl2br($db->CleanDBData($_POST['s_message']));
    $sqli = "insert into support (player,s_message,date,time,s_action) values (?,?,?,?,?)";
    $values = array($_POST['Player'], $s_message, date("Y-m-d"), date("H:i:s"), 'support');
    $model->doinsert($sqli, $values);

    $sqlu2 = "update support set status=? where player=?";
    $values2 = array('1', $_POST['Player']);
    $model->doUpdate($sqlu2, $values2);

    header("Location:support_edit.php?Player=" . $_POST['Player']);

}

// echo "<pre>";
// print_r($RecDataUser[0]);
// echo "</pre>";

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
    <?php include_once "top_bar.php";?>
    <?php include_once "sidebar_menu.php";?>
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Support (Message -> <?php echo $_GET['Player']; ?>)</h3>
        <div class="row mt">
          <div class="col-lg-12">
          <div class="form-panel">
              <form class="form-horizontal style-form" method="post" action="support_edit.php?action=submit">
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Chat Message</label>
                  <div class="col-sm-10">
                  <span id="ContentPlaceHolder1_lblChat" class="lblChat">
                  <?php
foreach ($RecData as $key => $value) {
    $description = str_replace("\\r\\n", ' ', $value['s_message']);
    $description = str_replace("\\", '', $description);
    ?>
                      <span class="<?php if ($value['s_action'] === "user") {echo "chat-you";} else {echo "chat-support";}?>" title="<?php echo $value['date'] . " " . $value['time']; ?>"><b><?php if ($value['s_action'] === "user") {echo $_GET['Player'];} else {echo "Support";}?>:</b><?php echo $description; ?></span>
                      <?php }?>
                  </span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-12 control-label"><strong>Reply Message</strong></label>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Message</label>
                  <div class="col-sm-10">
                  <textarea class="form-control" name="s_message" id="s_message" placeholder="Your Message" rows="5" required></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 text-center">
                  <input type="hidden" name="Player" class="form-control" value="<?php echo $_GET['Player']; ?>">
                  <button class="btn btn-theme" type="submit">Save</button>
                  <button class="btn btn-theme04" type="button" onClick="window.location='support_all.php';">Cancel</button>
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
