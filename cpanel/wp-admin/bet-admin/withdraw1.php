<?php  
    include_once("../../function/cpanel/app_top.php");

    if(isset($_GET['action']) && $_GET['action'] === "submit"){
      $array_fields = array(
			'status' => $_REQUEST['status'],
			);
		
			$array_where = array(    
			'id' => $_REQUEST['id'],
			);
		
      $q = $db->Update('withdraw_history', $array_fields, $array_where);
      
    header("Location:withdraw.php");
  }

  $RecData = $db->select("SELECT * FROM withdraw_history WHERE withdraw_type='1' ORDER BY id DESC");
  $RecDataSum = $db->select("SELECT sum(amount) as sumAmount FROM withdraw_history WHERE withdraw_type='1' AND status = '1'");
  $totalAmount = number_format($RecDataSum[0]['sumAmount']);

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
  <link href="lib/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="lib/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="lib/advanced-datatable/css/DT_bootstrap.css" />
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
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Withdraw (E-Voucher)</h3>
        <div style="margin-bottom: 20px;"><button class="btn btn-success">Total Amount : <?php echo $totalAmount;?></button></div>
        <div class="row mb">
          <!-- page start-->
          <div class="content-panel" style="margin-left: 15px;margin-right: 15px;padding-left: 15px;padding-right: 15px;">
            <div class="adv-table">
              <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                <thead>
                  <tr>
                    <th>Player</th>
                    <th>Amount</th>
                    <th class="text-center">Date/Time</th>
                    <!-- <th class="text-center">Bank Name</th>
                    <th class="text-center">Fullname</th>
                    <th class="text-center">Card number</th>
                    <th class="text-center">Sheba number</th> -->
                    <th class="text-center">E-Voucher</th>
                    <th class="text-center">Activation Code</th>
                    <th class="text-center">Voucher Amount</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($RecData as $key => $value) {

                      $RecDataBank = $db->select("SELECT * FROM bank_info WHERE player = '".$value['player']."'  ORDER BY id DESC");

                        ?>
                        <tr role="row">
                            <td><?php echo $value['player'];?>.</td>
                            <td><?php echo $value['amount']."0";?></td>
                            <td class="sorting_1 text-center"><?php echo date("m/d/Y", strtotime($value['date']));?> <?php echo $value['time'];?></td>
                            <!-- <td class="text-center"><?php echo $RecDataBank[0]['bank_name'];?></td>
                            <td class="text-center"><?php echo $RecDataBank[0]['fullname'];?></td>
                            <td class="text-center"><?php echo $RecDataBank[0]['bank_card'];?></td>
                            <td class="text-center"><?php echo $RecDataBank[0]['bank_sheba'];?></td> -->
                            <td class="text-center"><?php echo $value['evoucher'];?></td>
                            <td class="text-center"><?php echo $value['activation_code'];?></td>
                            <td class="text-center"><?php echo $value['evoucher_amount'];?> USD</td>
                            <td class="text-center"><?php if($value['status'] == 1){echo '<button class="btn btn-success" style="width: 100px;">Complated</button>';}else if($value['status'] == 2){echo '<button class="btn btn-danger" style="width: 100px;">Cancel</button>';}else{echo '<button class="btn btn-primary" style="width: 100px;">Processing</button>';}?></td>
                            <td class="center">
                            <?php if($value['status'] == 0){?>
                              <div class="row">
                                <div class="<?php if($value['evoucher'] == "" && $value['activation_code'] == "" && $value['status'] == "0"){echo 'col-md-7 text-right';}else{echo 'col-md-12 text-center';}?>" <?php if($value['evoucher'] == "" && $value['activation_code'] == "" && $value['status'] == "0"){echo 'style="padding-right: 0;"';}?>>
                                  <div class="btn-group">
                                    <button type="button" class="btn btn-theme dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                      Action <span class="caret"></span>
                                      </button>
                                    <ul class="dropdown-menu" role="menu" style="left: -81px;">
                                      <!-- <li><a href="withdraw.php?action=submit&status=0&id=<?php echo $value['id']?>">Processing</a></li> -->
                                      <li><a href="withdraw.php?action=submit&status=1&id=<?php echo $value['id']?>">Approved</a></li>
                                    </ul>
                                  </div>
                                </div>
                                <?php
                                  if($value['evoucher'] == "" && $value['activation_code'] == "" && $value['status'] == "0"){
                                    ?>
                                    <div class="col-md-5 text-left">
                                    <form name="frmEvoucher" id="frmEvoucher" action="withdraw_evoucher.php" method="post">
                                      <input type="hidden" name="amount" value="<?php echo $value['amount'];?>">
                                      <input type="hidden" name="player" value="<?php echo $value['player'];?>">
                                      <input type="hidden" name="id" value="<?php echo $value['id'];?>">
                                      <button class="btn btn-warning btn-xs" id="btCallEvoucher" type="button" title="E-Voucher" style="padding: 7px 13px;"><i class="fa fa-money"></i></button>
                                    </form>
                                    </div>
                                    <?php
                                  }
                                ?>
                              </div>
                              <?php }?>
                          </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- page end-->
        </div>
        <!-- /row -->
      </section>
      <!-- /wrapper -->
    </section>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Perfect Money</h4>
          </div>
          <div class="modal-body" id="reText">
                    
          </div>
          <div class="modal-footer text-center">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>

    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <?php include_once("footer_bar.php");?>
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>
  <!-- <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.js"></script> -->
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="lib/advanced-datatable/js/DT_bootstrap.js"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <!--script for this page-->
  <script type="text/javascript">


    $(document).ready(function() {

     
    $("#btCallEvoucher").click(function(){
      $('#btCallEvoucher').attr('disabled' , true);
      $("#frmEvoucher").submit();
    });
      


      $.urlParam = function(name){
          var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
          if (results==null) {
            return null;
          }
          return decodeURI(results[1]) || 0;
      }

      if($.urlParam('action') != "" && $.urlParam('action') == "failed"){
        //console.log($.urlParam('msg'));
        var text = '<span style="font-size: 20px;">'+$.urlParam('msg')+'</span>';
        $("#reText").html(text);
        $("#myModal").modal('show');
      }

      if($.urlParam('action') != "" && $.urlParam('action') == "success"){
       
        var text = '<span style="font-size: 20px;">E-Voucher : '+$.urlParam('evoucher')+'</span><br>';
            text += '<span style="font-size: 20px;">Activation Code : '+$.urlParam('activation_code')+'</span><br>';
            text += '<span style="font-size: 20px;">E-Voucher Amount : '+$.urlParam('amount')+' USD</span><br>';

        $("#reText").html(text);
        $("#myModal").modal('show');
      }

      /*
       * Insert a 'details' column to the table
       */

      var oTable = $('#hidden-table-info').dataTable({
        "aoColumnDefs": [{
          "bSortable": false,
          "aTargets": [0]
        }],
        "aaSorting": [
          [2, 'desc']
        ],
        "iDisplayLength": 50,
      });

    });
  </script>
</body>

</html>
