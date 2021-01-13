<?php

include_once "../../function/cpanel/app_top.php";

if (isset($_GET['action']) && $_GET['action'] === "submit") {

    if ($_POST['Password'] != "") {
        $sqlu = "update user_profile set Email=?, Telephone=?, permission=?, password=?, uactive=?, eactive=? where Player=?";
        $values = array($_POST['Email'], $_POST['Telephone'], $_POST['permission'], encode($_POST['Password'], KEY_HASH), $_POST['uactive'], $_POST['eactive'], $_POST['Player']);

    } else {
        $sqlu = "update user_profile set Email=?, Telephone=?, permission=?, uactive=?, eactive=? where Player=?";
        $values = array($_POST['Email'], $_POST['Telephone'], $_POST['permission'], $_POST['uactive'], $_POST['eactive'], $_POST['Player']);
    }

    $model->doUpdate($sqlu, $values);

    /// Updated Banks
    $sqlu2 = "update pm_info set pm_account=? where player=?";
    $values2 = array($_POST['pm_account'], $_POST['Player']);
    $model->doUpdate($sqlu2, $values2);

    header("Location:user_unaccount.php");

} 

$RecDataUserSQL = "SELECT * FROM user_profile WHERE Player = ?";
$valuesRecDataUserSQL = array($_GET['Player']);
$RecDataUser = $model->doSelect($RecDataUserSQL, $valuesRecDataUserSQL);

$RecDataBankSQL = "SELECT * FROM pm_info WHERE player = ?";
$valuesRecDataBankSQL = array($_GET['Player']);
$RecDataBank = $model->doSelect($RecDataBankSQL, $valuesRecDataBankSQL);


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
        <h3><i class="fa fa-angle-right"></i> User Account <i class="fa fa-angle-right"></i> Unactive Users <i class="fa fa-angle-right"></i> (Edit -> <?php echo $_GET['Player']; ?>)</h3>
        <div class="row mt">
          <div class="col-lg-12">
          <div class="form-panel">
              <form class="form-horizontal style-form" method="post" action="user_unaccount_edit.php?action=submit">
                <div class="form-group">
                  <label class="col-lg-2 col-sm-2 control-label">Player</label>
                  <div class="col-lg-10">
                    <p class="form-control-static"><?php echo $RecDataUser[0]['Player']; ?></p>
                    <input type="hidden" name="Player" class="form-control" value="<?php echo $RecDataUser[0]['Player']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Email</label>
                  <div class="col-sm-10">
                    <input type="text" name="Email" class="form-control" value="<?php echo $RecDataUser[0]['Email']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Phone</label>
                  <div class="col-sm-10">
                    <input type="text" name="Telephone" class="form-control" value="<?php echo $RecDataUser[0]['Telephone']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                    <input type="text" name="Password" class="form-control" value="">
                    <input type="hidden" name="passOld" value="<?php echo $RecDataUser[0]['password']; ?>">
                    <br>Password not displayed. Leave blank to keep existing password.
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Permissions</label>
                  <div class="col-sm-10">
                  <select class="form-control" name="permission" title="Permissions">
                      <option value="Customer" <?php if ($RecDataUser[0]['permission'] == 'Customer') {echo 'selected=""';}?>>Customer</option>
                      <!-- <option value="D1" <?php if ($RecDataUser[0]['permission'] == 'D1') {echo 'selected=""';}?>>D1</option>
                      <option value="D2" <?php if ($RecDataUser[0]['permission'] == 'D2') {echo 'selected=""';}?>>D2</option> -->
                      <?php if ($RecDataUser[0]['Player'] === "adminT-T") {
    ?>
                        <option value="admin" <?php if ($RecDataUser[0]['permission'] == 'admin') {echo 'selected=""';}?>>Administrator</option>
                        <?php
}?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Active User</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="uactive" title="Active User">
                      <option value="0" <?php if ($RecDataUser[0]['uactive'] == '0') {echo 'selected=""';}?>>No</option>
                      <option value="1" <?php if ($RecDataUser[0]['uactive'] == '1') {echo 'selected=""';}?>>Yes</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Active User by Email</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="eactive" title="Active User by Email">
                      <option value="0" <?php if ($RecDataUser[0]['eactive'] == '0') {echo 'selected=""';}?>>No</option>
                      <option value="1" <?php if ($RecDataUser[0]['eactive'] == '1') {echo 'selected=""';}?>>Yes</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-12 control-label"><strong>Perfect Money Account Information</strong></label>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">P.M Account</label>
                  <div class="col-sm-10">
                    <input type="text" name="pm_account" class="form-control" value="<?php if(isset($RecDataBank[0]['pm_account'])){echo $RecDataBank[0]['pm_account'];} ?>">
                  </div>
                </div>
                <!-- <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">P.M Account Status</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="pmaction" title="P.M Account Status">
                      <option value="0" <?php if ($RecDataUser[0]['active'] == 'Enable') {echo 'selected=""';}?>>Enable</option>
                      <option value="1" <?php if ($RecDataUser[0]['active'] == 'Disable') {echo 'selected=""';}?>>Disable</option>
                    </select>
                  </div>
                </div> -->
                <div class="form-group">
                  <div class="col-sm-12 text-center">
                  <button class="btn btn-theme" type="submit">Save</button>
                  <button class="btn btn-theme04" type="button" onClick="window.location='user_unaccount.php';">Cancel</button>
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
