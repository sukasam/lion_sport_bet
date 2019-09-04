<?php
 
  include_once("../../function/cpanel/app_top.php");
  include_once("../../function/poker_config.php");
  include_once("../../function/poker_api.php");

  if($_GET['action'] == "submit"){

    if($_POST['Password'] != ""){
      $update_arrays = array(
        'RealName' => $_POST['RealName'],
        'Email' => $_POST['Email'],
        'Telephone' => $_POST['Telephone'],
        //'Balance' => $_POST['Balance'],
        'onlineCard' => $_POST['onlineCard'],
        'permission' => $_POST['permission'],
        'password' => encode($_POST['Password'],KEY_HASH),
        'uactive' => "0",
        // 'inviteUser' => $_POST['inviteUser'],
      );
    }else{
      $update_arrays = array(
        'RealName' => $_POST['RealName'],
        'Email' => $_POST['Email'],
        'Telephone' => $_POST['Telephone'],
        //'Balance' => $_POST['Balance'],
        'onlineCard' => $_POST['onlineCard'],
        'permission' => $_POST['permission'],
        'password' => $_POST['passOld'],
        'uactive' => "0",
        // 'inviteUser' => $_POST['inviteUser'],
      );
    }

    $where_arrays = array(
      'Player' => $_POST['Player'],
    );
  
    //if ran successfully it will reture last insert id, else 0 for error
    $q  = $db->Update('user_profile',$update_arrays,$where_arrays);

    
    header("Location:user_account.php");

  }else{
    
  }

  $RecDataUser = $db->select("SELECT * FROM user_profile WHERE Player = '".$_GET['Player']."'");
 // $RecDataUserPin = $db->select("SELECT * FROM user_pin WHERE Player = '".$_GET['Player']."'");
  //$RecDataUserBlock = $db->select("SELECT * FROM user_block WHERE Player = '".$_GET['Player']."'");

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
    <?php include_once("top_bar.php");?>
    <?php include_once("sidebar_menu.php");?>
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> User Account (Edit -> <?php echo $_GET['Player'];?>)</h3>
        <div class="row mt">
          <div class="col-lg-12">
          <div class="form-panel">
              <form class="form-horizontal style-form" method="post" action="user_account_edit.php?action=submit">
                <div class="form-group">
                  <label class="col-lg-2 col-sm-2 control-label">Player</label>
                  <div class="col-lg-10">
                    <p class="form-control-static"><?php echo $RecDataUser[0]['Player'];?></p>
                    <input type="hidden" name="Player" class="form-control" value="<?php echo $RecDataUser[0]['Player'];?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">RealName</label>
                  <div class="col-sm-10">
                    <input type="text" name="RealName" class="form-control" value="<?php echo $RecDataUser[0]['RealName'];?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Email</label>
                  <div class="col-sm-10">
                    <input type="text" name="Email" class="form-control" value="<?php echo $RecDataUser[0]['Email'];?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Phone</label>
                  <div class="col-sm-10">
                    <input type="text" name="Telephone" class="form-control" value="<?php echo $RecDataUser[0]['Telephone'];?>">
                  </div>
                </div>
                <!-- <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Gender</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="Gender" title="Player's gender.">
                      <option value="Male" <?php if($apiUser->Gender == 'Male'){echo 'selected=""';}?>>Male</option>
                      <option value="Female" <?php if($apiUser->Gender == 'Female'){echo 'selected=""';}?>>Female</option>
                    </select>
                  </div>
                </div> -->
                <!-- <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Location</label>
                  <div class="col-sm-10">
                    <input type="text" name="Location" class="form-control" value="<?php echo $apiUser->Location;?>">
                  </div>
                </div> -->
                <!-- <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Balance</label>
                  <div class="col-sm-10">
                    <input type="text" name="Balance" class="form-control" value="<?php echo $apiUser->Balance;?>">
                  </div>
                </div> -->
                <!-- <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Chips Transfer</label>
                  <div class="col-sm-10">
                  <select class="form-control" name="ChipsTransfer" title="Chips Transfer">
                      <option value="Yes" <?php if($apiUser->ChipsTransfer == 'Yes'){echo 'selected=""';}?>>Yes</option>
                      <option value="No" <?php if($apiUser->ChipsTransfer == 'No'){echo 'selected=""';}?>>No</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Chips Accept</label>
                  <div class="col-sm-10">
                  <select class="form-control" name="ChipsAccept" title="Chips Accept">
                      <option value="Yes" <?php if($apiUser->ChipsAccept == 'Yes'){echo 'selected=""';}?>>Yes</option>
                      <option value="No" <?php if($apiUser->ChipsAccept == 'No'){echo 'selected=""';}?>>No</option>
                    </select>
                  </div>
                </div> -->
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                    <input type="text" name="Password" class="form-control" value="">
                    <input type="hidden" name="passOld" value="<?php echo $RecDataUser[0]['password'];?>">
                    <br>Password not displayed. Leave blank to keep existing password.
                  </div>
                </div>
                <!-- <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Player Pin</label>
                  <div class="col-sm-10">
                    <input type="text" name="playerPin" class="form-control" value="<?php echo $apiUser->Note;?>" maxlength="4">
                  </div>
                </div> -->
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Permissions</label>
                  <div class="col-sm-10">
                  <select class="form-control" name="permission" title="Permissions">
                      <option value="" <?php if($RecDataUser[0]['permission'] == ''){echo 'selected=""';}?>></option>
                      <option value="D1" <?php if($RecDataUser[0]['permission'] == 'D1'){echo 'selected=""';}?>>D1</option>
                      <option value="D2" <?php if($RecDataUser[0]['permission'] == 'D2'){echo 'selected=""';}?>>D2</option>
                      <?php if($RecDataUser[0]['Player'] == "adminT-T"){
                        ?>
                        <option value="admin" <?php if($RecDataUser[0]['permission'] == 'admin'){echo 'selected=""';}?>>Administrator</option>
                        <?php
                      }?>
                    </select>
                  </div>
                </div>
                 <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Payment Online</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="onlineCard" title="Payment Online">
                      <option value="0" <?php if($RecDataUser[0]['onlineCard'] == 0){echo 'selected=""';}?>>No</option>
                      <option value="1" <?php if($RecDataUser[0]['onlineCard'] == 1){echo 'selected=""';}?>>Yes</option>
                    </select>
                  </div>
                </div>
                <!-- <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Invite User</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="inviteUser" title="Invite User">
                      <option value="0" <?php if($RecDataUser[0]['inviteUser'] == 0){echo 'selected=""';}?>>No</option>
                      <option value="1" <?php if($RecDataUser[0]['inviteUser'] == 1){echo 'selected=""';}?>>Yes</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Block User</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="blockUser" title="Block User">
                      <option value="0" <?php if($RecDataUserBlock[0]['block'] == 0){echo 'selected=""';}?>>No</option>
                      <option value="1" <?php if($RecDataUserBlock[0]['block'] == 1){echo 'selected=""';}?>>Yes</option>
                    </select>
                  </div>
                </div> -->
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
