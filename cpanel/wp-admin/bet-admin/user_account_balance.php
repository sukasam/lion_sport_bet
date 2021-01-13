<?php

include_once "../../function/cpanel/app_top.php";
include_once "../../function/poker_config.php";
include_once "../../function/poker_api.php";

if (isset($_GET['action']) && $_GET['action'] === "submit") {

    if ($_POST['IncreaseDBalance'] != "") {

        $RecDataUserBalanceSQL = "SELECT DBalance FROM user_profile WHERE Player = ? LIMIT 1";
        $valuesRecDataUserBalanceSQL = array($_POST['Player']);
        $RecDataUserBalance = $model->doSelect($RecDataUserBalanceSQL, $valuesRecDataUserBalanceSQL);

        $RecDataConvestSQL = "SELECT currency,currency_cc FROM setting WHERE `sid` = ? LIMIT 1";
        $valuesRecDataConvestSQL = array('1');
        $RecDataConvest = $model->doSelect($RecDataConvestSQL, $valuesRecDataConvestSQL);

        $UserBalance = $RecDataUserBalance[0]['DBalance'];

        if($_POST['deposit_type'] === "PM"){
          $currency = $RecDataConvest[0]['currency'];
          $newBalance = $UserBalance + ($_POST['IncreaseDBalance'] * $currency);
        }else if($_POST['deposit_type'] === "CC"){
          $currency = $RecDataConvest[0]['currency_cc'];
          $newBalance = $UserBalance + ($_POST['IncreaseDBalance'] * $currency);
        }else{
          
        }

        $sqlu2 = "update user_profile set DBalance=? where Player=?";
        $values2 = array($newBalance, $_POST['Player']);
        $model->doUpdate($sqlu2, $values2);

        $sqliH = "insert into deposit_history (player,amount,deposit_type,date,time,tran_id,currency,status) values (?,?,?,?,?,?,?,?)";
        $valuesH = array($_POST['Player'], $_POST['IncreaseDBalance'], $_POST['deposit_type'], date("Y-m-d"), date("H:i:s"), $_POST['tran_id'],$currency,'1');
        $model->doinsert($sqliH, $valuesH);

    }

    header("Location:user_account.php");

} else {
    $RecDataUserSQL = "SELECT * FROM user_profile WHERE Player = ?";
    $valuesRecDataUserSQL = array($_GET['Player']);
    $RecDataUser = $model->doSelect($RecDataUserSQL, $valuesRecDataUserSQL);
}

/*echo "<pre>";
print_r($apiUser);
echo "</pre>";*/

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
        <h3><i class="fa fa-angle-right"></i> User Account <i class="fa fa-angle-right"></i> Active Users <i class="fa fa-angle-right"></i> (Balance -> <?php echo $_GET['Player'] ?>)</h3>
        <div class="row mt">
          <div class="col-lg-12">
          <div class="form-panel">
              <form class="form-horizontal style-form" method="post" action="user_account_balance.php?action=submit">
                <div class="form-group">
                  <label class="col-lg-2 col-sm-2 control-label">Player</label>
                  <div class="col-lg-10">
                    <p class="form-control-static"><?php echo $RecDataUser[0]['Player']; ?></p>
                    <input type="hidden" name="Player" class="form-control" value="<?php echo $RecDataUser[0]['Player']; ?>">
                  </div>
                </div>
                <!-- <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Deposits Balance</label>
                  <div class="col-sm-10">
                    <p class="form-control-static"><?php echo number_format($RecDataUser[0]['DBalance']); ?></p>
                  </div>
                </div> -->
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Increase Deposits (USD)</label>
                  <div class="col-sm-10">
                    <input type="text" name="IncreaseDBalance" class="form-control" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Transaction ID</label>
                  <div class="col-sm-10">
                    <input type="text" name="tran_id" class="form-control" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Deposits Type</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="deposit_type" title="Deposit Type">
                      <option value="PM">Perfect Money</option>
                      <option value="CC">Cryptocurrency</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 text-center">
                  <button class="btn btn-theme" type="submit">Save</button>
                  <button class="btn btn-theme04" type="button" onClick="window.location='user_account.php';">Cancel</button>
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
