<?php

include_once("../../function/cpanel/app_top.php");
include_once("../../function/poker_config.php");
include_once("../../function/poker_api.php");
include_once('../../_inc/config.php');

if($_GET['action'] == 'submit'){

  $insert_arrays = array(
		'tid' => $_POST['tid'],
		'player' => $_SESSION['PlayerAdmin'],
		'detail' => addslashes($_POST['detail']),
		'date' => date("Y-m-d"),
		'time' => date("H:i:s"),
		'action' => "1",
	);

	//if ran successfully it will reture last insert id, else 0 for error
     $q  = $db->insert('tickets_detail',$insert_arrays);

     $insert_arrays = array(
      'player' => $_POST['player'],
      'noti_type' => "tickets",
      'noti_id' => $_POST['tid'],
      'noti_title' => addslashes($_POST['detail']),
      'noti_link' => "tickets_detail.php?id=".$_POST['tid'],
      'date' => date("Y-m-d"),
      'time' => date("H:i:s"),
      'status' => "0",
    );
  
    //if ran successfully it will reture last insert id, else 0 for error
       $q  = $db->insert('notification',$insert_arrays);

      header("Location:tickets_edit.php?id=".$_POST['tid']);

}else{
    $RecData = $db->select("SELECT * FROM tickets WHERE id ='".$_GET['id']."' ORDER BY id DESC");
    $RecData2 = $db->select("SELECT * FROM tickets_detail WHERE tid = '".$_GET['id']."'");
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
  <title>Lion Royal Casino</title>

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
        <h3><i class="fa fa-angle-right"></i>Tickets (#<?php echo $RecData[0]['tkid'];?>)</h3>
        <div class="chat-room mt">
          <aside class="mid-side">
            <div class="chat-room-head">
              <h3><?php echo $RecData[0]['subject'];?></h3>
            </div>
            <div class="room-desk" style="margin-bottom: 0px;padding-bottom: 0px;">
              <h5 class="text-primary"><?php echo $RecData[0]['player'];?> : <?php echo date("m/d/Y", strtotime($RecData[0]['date']));?> <?php echo $RecData[0]['time'];?></h5>
              <div class="room-box">
                <p class="text-muted" style="margin:0"><?php echo $RecData[0]['detail'];?></p>
              </div>
            </div>

            <?php
								foreach ($RecData2 as $key2 => $value2) {
						?>
            <div class="room-desk" style="margin-bottom: 0px;padding-bottom: 0px;">
              <h5 class="text-primary"><?php if($value2['action'] == "0"){echo $value2['player'];}else{echo "Support";}?> : <?php echo date("m/d/Y", strtotime($RecData[0]['date']));?> <?php echo $RecData[0]['time'];?></h5>
              <div class="room-box">
                <p class="text-muted" style="margin:0"><?php echo stripslashes($value2['detail']);?></p>
              </div>
            </div> 

            <?php }?>

             <div class="room-desk">
               
             <hr>
             <form class="contact-form php-mail-form" role="form" action="tickets_edit.php?action=submit" method="post">
              <div class="form-group">
                  <textarea class="form-control" name="detail" id="contact-message" placeholder="Your Message" rows="5" data-rule="required" data-msg="Please write something for us" required></textarea>
                  <input type="hidden" name="tid" value="<?php echo $_GET['id'];?>">
                  <input type="hidden" name="player" value="<?php echo $RecData[0]['player'];?>"> 
                </div>
              <div class="form-group text-center">
              <button type="button" class="btn btn-danger" onclick="window.location.href='tickets.php'" style="width: 110px;">Back</button> <button type="submit" class="btn btn-large btn-primary">Send Message</button>
              </div>
             </form>

            </div>
          </aside>
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
