<?php  
    include_once("../../function/cpanel/app_top.php");

    
    if($_GET['action'] == "changeStatus"){

      // print_r($_POST);
      // exit();

      $array_fields = array(
        'status' => $_POST['statusCh'],
        'comment' => $_POST['comment'],
      );
      
      $array_where = array(    
      'id' => $_POST['acID'],
      );
    
      $q = $db->Update('withdraw_history', $array_fields, $array_where);

      if($_POST['statusCh'] == 1){
      
      }else if($_POST['statusCh'] == 2){
        $params = array("Command"  => "AccountsIncBalance",
          "Player"   => $_POST['player'],
          "Amount"  => $_POST['amount'],
        );
        $api = Poker_API($params);
      }

      header("Location:withdraw2.php");

    }

  if(isset($_GET['status']) && ($_GET['status'] == 0 || $_GET['status'] == 1 || $_GET['status'] == 2)){
    $RecData = $db->select("SELECT * FROM withdraw_history WHERE withdraw_type='2' AND status= '".$_GET['status']."' ORDER BY id DESC");
  }else{
    $RecData = $db->select("SELECT * FROM withdraw_history WHERE withdraw_type='2' ORDER BY id DESC");
  }
    
  
  $RecDataSum = $db->select("SELECT sum(amount) as sumAmount FROM withdraw_history WHERE withdraw_type='2' AND status = '1'");
  $totalAmount = number_format($RecDataSum[0]['sumAmount']);

  $RecDataSum2 = $db->select("SELECT sum(amount) as sumAmount FROM withdraw_history WHERE withdraw_type='2' AND status = '0'");
  $processAmount = number_format($RecDataSum2[0]['sumAmount']);

  $RecDataSum3 = $db->select("SELECT sum(amount) as sumAmount FROM withdraw_history WHERE withdraw_type='2' AND status = '2'");
  $cancelAmount = number_format($RecDataSum3[0]['sumAmount']);


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
        <h3><i class="fa fa-angle-right"></i> Withdraw (Online Card)</h3>
        <div style="margin-bottom: 20px;"><a href="withdraw2.php?status=1"><button class="btn btn-success">Total Amount : <?php echo $totalAmount;?></button></a> <a href="withdraw2.php?status=0"><button class="btn btn-primary">Processing Amount : <?php echo $processAmount;?></button></a> <a href="withdraw2.php?status=2"><button class="btn btn-danger">Cancel Amount : <?php echo $cancelAmount;?></button></a></div>
        <div class="row mb">
          <!-- page start-->
          <div class="content-panel" style="margin-left: 15px;margin-right: 15px;padding-left: 15px;padding-right: 15px;">
            <div class="adv-table">
              <table cellpadding="0" cellspacing="0" class="display table table-bordered" id="hidden-table-info">
                <thead>
                  <tr>
                    <th>Player</th>
                    <th>Amount</th>
                    <th class="text-center">Date/Time</th>
                    <th class="text-center">Bank Name</th>
                    <th class="text-center">Fullname</th>
                    <th class="text-center">Card number</th>
                    <th class="text-center">Sheba number</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Comment</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($RecData as $key => $value) {

                      $RecDataBank = $db->select("SELECT * FROM bank_info WHERE player = '".$value['player']."'  ORDER BY id DESC");

                        ?>
                        <tr role="row">
                          <form name="frmWd" id="frmWd<?php echo $value['id'];?>" action="withdraw2.php?action=changeStatus" method="post">
                            <td><?php echo $value['player'];?>.</td>
                            <td><?php echo $value['amount']."0";?></td>
                            <td class="sorting_1 text-center"><?php echo date("m/d/Y", strtotime($value['date']));?> <?php echo $value['time'];?></td>
                            <td class="text-center"><?php echo $RecDataBank[0]['bank_name'];?></td>
                            <td class="text-center"><?php echo $RecDataBank[0]['fullname'];?></td>
                            <td class="text-center"><?php echo $RecDataBank[0]['bank_card'];?></td>
                            <td class="text-center"><?php echo $RecDataBank[0]['bank_sheba'];?></td>
                            <td class="text-center"><?php if($value['status'] == 1){echo '<button class="btn btn-success" style="width: 100px;">Complated</button>';}else if($value['status'] == 2){echo '<button class="btn btn-danger" style="width: 100px;">Cancel</button>';}else{echo '<button class="btn btn-primary" style="width: 100px;">Processing</button>';}?></td>
                            <?php
                            if($value['status'] == 0){
                              ?>
                              <td class="text-center"><input type="text" name="comment" value="" style="width: 80px;"></td>
                              <?php
                            }else{
                              ?>
                              <td class="text-center"><?php echo $value['comment'];?></td>
                              <?php
                            }
                            ?>
                            <td class="center">
                              <?php
                              if($value['status'] == 0){
                                ?>
                                <div class="row">
                                  <div class="col-md-12 text-center">
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-theme dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        Action <span class="caret"></span>
                                        </button>
                                      <ul class="dropdown-menu" role="menu" style="left: -81px;">
                                        <!-- <li><a href="withdraw2.php?action=submit&status=1&statusOld=<?php echo $value['status'];?>&id=<?php echo $value['id']?>">Approved</a></li>
                                        <li><a href="withdraw2.php?action=submit&status=2&statusOld=<?php echo $value['status'];?>&id=<?php echo $value['id']?>">Cancel</a></li> -->
                                        <li><a href="javascript:void(0)" onclick="getOnchange('1','<?php echo $value['id'];?>');">Approved</a></li>
                                        <li><a href="javascript:void(0);" onclick="getOnchange('2','<?php echo $value['id'];?>');">Cancel</a></li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                                <?php
                              }
                              ?>
                              <input type="hidden" name="statusCh" id="statusCh<?php echo $value['id'];?>" value="">
                              <input type="hidden" name="acID" value="<?php echo $value['id'];?>">
                              <input type="hidden" name="player" value="<?php echo $value['player'];?>">
                              <input type="hidden" name="amount" value="<?php echo $value['amount'];?>">
                          </td>
                          </form>
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
    /* Formating function for row details */
   /* function fnFormatDetails(oTable, nTr) {
      var aData = oTable.fnGetData(nTr);
      var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
      sOut += '<tr><td>Rendering engine:</td><td>' + aData[1] + ' ' + aData[4] + '</td></tr>';
      sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
      sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
      sOut += '</table>';

      return sOut;
    }*/

    $(document).ready(function() {



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

      /*var nCloneTh = document.createElement('th');
      var nCloneTd = document.createElement('td');
      nCloneTd.innerHTML = '<img src="lib/advanced-datatable/images/details_open.png">';
      nCloneTd.className = "center";

      $('#hidden-table-info thead tr').each(function() {
        this.insertBefore(nCloneTh, this.childNodes[0]);
      });

      $('#hidden-table-info tbody tr').each(function() {
        this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
      });*/

      /*
       * Initialse DataTables, with no sorting on the 'details' column
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

    function getOnchange(status,id){
     // console.log(status+" "+id);
     $("#statusCh"+id).val(status);
     $("#frmWd"+id).submit();
    }

  </script>
</body>

</html>
