<?php
include_once "../../function/cpanel/app_top.php";

$RecDataSQL = "SELECT * FROM setting WHERE `sid` = ? LIMIT 1";
$valuesRecDataSQL = array('1');
$RecData = $model->doSelect($RecDataSQL, $valuesRecDataSQL);

$timestamp = time();
$date_time = date("Y-m-d (D) H:i:s", $timestamp);

$dateToday = date("Y-m-d", $timestamp);
$TimeToday = date("H:i:s", $timestamp);

$dateYesterday = date( "Y-m-d", strtotime( $dateToday . "-1 day"));

$RecDepositPMSQL = "SELECT SUM(`amount` * `currency`) AS total FROM deposit_history WHERE `date` = ? AND `deposit_type`=?";
$valuesRecDepositPMSQL = array($dateToday,'PM');
$RecDepositPM = $model->doSelect($RecDepositPMSQL, $valuesRecDepositPMSQL);

$RecDepositCCSQL = "SELECT SUM(`amount` * `currency`) AS total FROM deposit_history WHERE `date` = ? AND `deposit_type`=?";
$valuesRecDepositCCSQL = array($dateToday,'CC');
$RecDepositCC = $model->doSelect($RecDepositCCSQL, $valuesRecDepositCCSQL);

$TotalDepositToday = $RecDepositPM[0]['total']+$RecDepositCC[0]['total'];

$RecWithdrawTodaySQL = "SELECT SUM(`amount`) AS total FROM withdraw_history WHERE `date` = ? AND `status`=?";
$valuesRecWithdrawTodaySQL = array($dateToday,'1');
$RecWithdrawToday = $model->doSelect($RecWithdrawTodaySQL, $valuesRecWithdrawTodaySQL);

$RecWithdrawTodayPenSQL = "SELECT SUM(`amount`) AS total FROM withdraw_history WHERE `date` = ? AND `status`=?";
$valuesRecWithdrawTodayPenSQL = array($dateToday,'0');
$RecWithdrawTodayPen = $model->doSelect($RecWithdrawTodayPenSQL, $valuesRecWithdrawTodayPenSQL);

$RecWithdrawYesPenSQL = "SELECT SUM(`amount`) AS total FROM withdraw_history WHERE `date` = ? AND `status`=?";
$valuesRecWithdrawYesPenSQL = array($dateYesterday,'0');
$RecWithdrawYesPen = $model->doSelect($RecWithdrawYesPenSQL, $valuesRecWithdrawYesPenSQL);

$RecWithdrawYesRemainPenSQL = "SELECT COUNT(`amount`) AS total FROM withdraw_history WHERE `date` = ? AND `status`=?";
$valuesRecWithdrawYesRemainPenSQL = array($dateYesterday,'0');
$RecWithdrawYesRemainPen = $model->doSelect($RecWithdrawYesRemainPenSQL, $valuesRecWithdrawYesRemainPenSQL);


$RecDPBalanceSQL = "SELECT SUM(`DBalance`) AS total FROM user_profile WHERE `DBalance` != ?";
$valuesRecDPBalanceSQL = array('0');
$RecDPBalance = $model->doSelect($RecDPBalanceSQL, $valuesRecDPBalanceSQL);

$RecCOBalanceSQL = "SELECT SUM(`CBalance`) AS total FROM user_profile WHERE `DBalance` != ?";
$valuesRecCOBalanceSQL = array('0');
$RecCOBalance = $model->doSelect($RecCOBalanceSQL, $valuesRecCOBalanceSQL);


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
  <!-- <link href="lib/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="lib/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="lib/advanced-datatable/css/DT_bootstrap.css" /> -->

  <link rel="stylesheet" href="css/jquery.dataTables.min.css" />

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
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Dashboard</h3>
        <div class="row">
						<div class="col-lg-12 col-12">
							<div class="small-box bg-info">
								<div class="inner">
									<h3>
										<span class="text-wrap"><?php echo $date_time;?></span>
									</h3>
									<p>Today</p>
								</div>
								<div class="icon">
									<i class="ion ion-bag"></i>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-12">
							<div class="small-box bg-success">
								<div class="inner">
									<h4><?php echo number_format($RecDepositPM[0]['total'])?></h4>
									<p>Today Deposit (Perface Money)</p>
								</div>
								<div class="icon">
									<i class="ion ion-stats-bars"></i>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-12">
							<div class="small-box bg-warning">
								<div class="inner">
									<h4><?php echo number_format($RecDepositCC[0]['total'])?></h4>
									<p>Today Deposit (Cryptocurrency)</p>
								</div>
								<div class="icon">
									<i class="ion ion-person-add"></i>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-12">
							<div class="small-box bg-success">
								<div class="inner">
									<h4><?php echo number_format($RecDPBalance[0]['total'])?></h4>
									<p>Total Balance Deposits (All Users)</p>
								</div>
								<div class="icon">
									<i class="ion ion-stats-bars"></i>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-12">
							<div class="small-box bg-warning">
								<div class="inner">
									<h4><?php echo number_format($RecCOBalance[0]['total'])?></h4>
									<p>Today Balance Cashouts (All Users)</p>
								</div>
								<div class="icon">
									<i class="ion ion-person-add"></i>
								</div>
							</div>
						</div>
						
						<div class="col-lg-3 col-12">
							<div class="small-box bg-success">
								<div class="inner">
									<h4><?php echo number_format($RecWithdrawToday[0]['total'])?></h4>
									<p>Today Withdraw</p>
								</div>
								<div class="icon">
									<i class="ion ion-stats-bars"></i>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-12">
							<div class="small-box bg-warning">
								<div class="inner">
									<h4><?php echo number_format($RecWithdrawTodayPen[0]['total'])?></h4>
									<p>Today Pending Withdraw</p>
								</div>
								<div class="icon">
									<i class="ion ion-person-add"></i>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-12">
							<div class="small-box bg-info">
								<div class="inner">
									<h4><?php echo number_format($RecWithdrawYesRemainPen[0]['total'])?></h4>
									<p>Withdraw Remaining from yesterday</p>
								</div>
								<div class="icon">
									<i class="ion ion-pie-graph"></i>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-12">
							<div class="small-box bg-danger">
								<div class="inner">
									<h4><?php echo number_format($RecWithdrawYesPen[0]['total'])?></h4>
									<p>Withdraw Pending from yesterday</p>
								</div>
								<div class="icon">
									<i class="ion ion-pie-graph"></i>
								</div>
							</div>
						</div>

						<div class="col-lg-6 col-12">
							<div class="small-box bg-info">
								<div class="inner">
									<h4><?php echo number_format($TotalDepositToday);?></h4>
									<p>Today Total Deposit (Perface Money + Cryptocurrency)</p>
								</div>
								<div class="icon">
									<i class="ion ion-pie-graph"></i>
								</div>
							</div>
						</div>

						<div class="col-lg-6 col-12">
							<div class="small-box bg-success">
								<div class="inner">
									<h4><?php echo number_format($RecData[0]['currency'])?></h4>
									<p>Convert 1 USD (Deposit) (Perface Money) (Toman)</p>
								</div>
								<div class="icon">
									<i class="ion ion-pie-graph"></i>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-12">
							<div class="small-box bg-danger">
								<div class="inner">
									<h4><?php echo number_format($RecData[0]['currency_withdraw'])?></h4>
									<p>Convert 1 USD (Withdraw) (Toman)</p>
								</div>
								<div class="icon">
									<i class="ion ion-pie-graph"></i>
								</div>
							</div>
            </div>

            <div class="col-lg-6 col-12">
							<div class="small-box bg-info">
								<div class="inner">
									<h4><?php echo number_format($RecData[0]['currency_cc'])?></h4>
									<p>Convert 1 USD (Deposit) (Cryptocurrency) (Toman)</p>
								</div>
								<div class="icon">
									<i class="ion ion-pie-graph"></i>
								</div>
							</div>
						</div>


					</div>
        <!-- /row -->
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
  <!-- <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="lib/advanced-datatable/js/DT_bootstrap.js"></script> -->
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>

  <!--script for this page-->
  <script type="text/javascript">


    $(document).ready(function() {

    });
  </script>
</body>

</html>
