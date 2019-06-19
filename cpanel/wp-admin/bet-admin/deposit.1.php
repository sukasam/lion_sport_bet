<?php  
    include_once("../../function/cpanel/app_top.php");

    if($_GET['action'] == "submit"){
      $array_fields = array(
			'status' => $_REQUEST['status'],
			);
		
			$array_where = array(    
			'id' => $_REQUEST['id'],
			);
		
      $q = $db->Update('deposit_history', $array_fields, $array_where);

      if($_REQUEST['status'] == "1" && $_REQUEST['statusOld'] == "0"){
        $params = array("Command"  => "AccountsIncBalance",
          "Player"   => $_REQUEST['Player'],
          "Amount"  => $_REQUEST['amount'],
        );
        $api = Poker_API($params);
      }
  
      if($_REQUEST['status'] == "0" && $_REQUEST['statusOld'] == "1"){
        $params = array("Command"  => "AccountsDecBalance",
          "Player"   => $_REQUEST['Player'],
          "Amount"  => $_REQUEST['amount'],
        );
        $api = Poker_API($params);
      }

    header("Location:deposit.php");
  }
    
    $RecData = $db->select("SELECT * FROM deposit_history WHERE deposit_type = 'E-Voucher' ORDER BY id DESC");
    $configDT = $db->select("SELECT currency FROM setting WHERE sid ='1' ORDER BY sid DESC");
    $RecDataSum = $db->select("SELECT sum(`amount`*`currency`) as sumAmount FROM deposit_history WHERE deposit_type = 'E-Voucher' AND status = '1'");
    $totalAmount = number_format($RecDataSum[0]['sumAmount'],2);

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
        <h3><i class="fa fa-angle-right"></i> Deposit (E-Voucher) </h3>
        <div style="margin-bottom: 20px;"><button class="btn btn-success">Total Amount : <?php echo $totalAmount;?></button></div>
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
                    <th class="text-center">Type</th>
                    <th class="text-center">Transaction Code</th>
                    <th class="text-center">Status</th>
                    <!-- <th class="text-center">Action</th> -->
                  </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($RecData as $key => $value) {
                      if($value['deposit_type'] == "E-Voucher"){
                        $amountBl = $value['amount'] * $value['currency'];
                      }else{
                        $amountBl = $value['amount'];
                      }
                        ?>
                        <tr role="row">
                            <td><?php echo $value['player'];?>.</td>
                            <td><?php echo number_format($amountBl);?></td>
                            <td class="sorting_1 text-center"><?php echo date("m/d/Y", strtotime($value['date']));?> <?php echo $value['time'];?></td>
                            <td class="text-center"><?php echo $value['deposit_type'];?></td>
                            <td class="text-center"><?php echo $value['tran_id'];?></td>
                            <td class="text-center"><?php if($value['status'] == 1){echo '<button class="btn btn-success" style="width: 150px;">Complated</button>';}else if($value['status'] == 2){echo '<button class="btn btn-danger" style="width: 150px;">Payment failed</button>';}else{echo '<button class="btn btn-danger" style="width: 150px;">Processing</button>';}?></td>
                            <!-- <td class="center">
                              <?php 
                              if($value['deposit_type'] == "Online Card"){
                                ?>
                                <div class="btn-group">
                                  <button type="button" class="btn btn-theme dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    Action <span class="caret"></span>
                                    </button>
                                  <ul class="dropdown-menu" role="menu" style="left: -81px;">
                                    <li><a href="deposit.php?action=submit&status=0&statusOld=<?php echo $value['status'];?>&id=<?php echo $value['id']?>&Player=<?php echo $value['player'];?>&amount=<?php echo $amountBl;?>">Processing</a></li>
                                    <li><a href="deposit.php?action=submit&status=1&statusOld=<?php echo $value['status'];?>&id=<?php echo $value['id']?>&Player=<?php echo $value['player'];?>&amount=<?php echo $amountBl;?>">Complated</a></li>
                                  </ul>
                                </div>
                                <?php
                              }
                              ?>
                          </td> -->
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

      /* Add event listener for opening and closing details
       * Note that the indicator for showing which row is open is not controlled by DataTables,
       * rather it is done here
       */
    //   $('#hidden-table-info tbody td img').live('click', function() {
    //     var nTr = $(this).parents('tr')[0];
    //     if (oTable.fnIsOpen(nTr)) {
    //       /* This row is already open - close it */
    //       this.src = "lib/advanced-datatable/media/images/details_open.png";
    //       oTable.fnClose(nTr);
    //     } else {
    //       /* Open this row */
    //       this.src = "lib/advanced-datatable/images/details_close.png";
    //       oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');
    //     }
    //   });
    });
  </script>
</body>

</html>
