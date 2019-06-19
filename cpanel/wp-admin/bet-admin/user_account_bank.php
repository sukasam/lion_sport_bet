<?php  
    include_once("../../function/cpanel/app_top.php");
    include_once("../../function/poker_config.php");
    include_once("../../function/poker_api.php");
    include_once('../../_inc/config.php');

    if($_GET['action'] == "savebank"){

      $Player = $_POST['Player'];

      $array_fields = array(
        'bank_name' => $_POST['bank_name'],
        'fullname' => $_POST['fullname'],
        'bank_card' => $_POST['bank_card'],
        'bank_sheba' => $_POST['bank_sheba'],
      );
      
      $array_where = array(    
        'player' => $Player,
      );
    
      $q = $db->Update('bank_info', $array_fields, $array_where);

      header("Location:user_account_bank.php?Player=".$Player);
    }

    $RecData = $db->select("SELECT * FROM bank_info WHERE player = '".$_GET['Player']."'  ORDER BY id DESC");
    
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
        <h3><i class="fa fa-angle-right"></i> User Account (Bank Info -> <?php echo $_GET['Player']?>)</h3>
        <div class="row mb">
          <!-- page start-->
          <form name="frmbank" action="user_account_bank.php?action=savebank" method="post">
          <div class="content-panel" style="margin-left: 15px;margin-right: 15px;padding-left: 15px;padding-right: 15px;">
            <div class="adv-table">
              <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                <thead>
                  <tr>
                    <th>Player</th>
                    <th>Bank Name</th>
                    <th>Fullname</th>
                    <th class="text-center">Card number</th>
                    <th class="text-center">Sheba number</th>
                    <!-- <th class="text-center">Status</th> -->
                  </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($RecData as $key => $value) {
                        ?>
                        <tr role="row" class="gradeA">
                            <td><?php echo $value['player'];?></td>
                            <td>
                            <?php if($_GET['action'] == "edit"){
                               ?>
                               <input type="text" class="text-center" name="bank_name" value="<?php echo $value['bank_name'];?>">
                               <?php 
                              }else{
                                echo $value['bank_name'];
                              }?>
                            </td>
                            <td>
                            <?php if($_GET['action'] == "edit"){
                               ?>
                               <input type="text" class="text-center" name="fullname" value="<?php echo $value['fullname'];?>">
                               <?php 
                              }else{
                                echo $value['fullname'];
                              }?>
                            </td>
                            <td class="text-center">
                              <?php if($_GET['action'] == "edit"){
                               ?>
                               <input type="text" class="text-center" name="bank_card" value="<?php echo $value['bank_card'];?>" maxlength="16">
                               <?php 
                              }else{
                               // echo cardFormat($value['bank_card']);
                               echo $value['bank_card'];
                              }?>
                            </td>
                            <td class="text-center"><?php if($_GET['action'] == "edit"){
                              ?>
                              <input type="text" class="text-center" name="bank_sheba" value="<?php echo $value['bank_sheba'];?>" maxlength="24" style="width:170px;">
                              <?php
                            }else{echo 'IR '.$value['bank_sheba'];}?></td>
                            <!-- <td class="text-center"><span class="label label-success">Enable</span></td> -->
                            </tr>
                        <?php
                    }
                    ?>

                </tbody>
              </table>
            </div>
          </div>
          <div class="form-group">
                  <div class="col-sm-12 text-center">
                  <button class="btn btn-theme04" type="button" onClick="window.location='user_account.php';">Back</button>
                  <?php if($_GET['action'] == "edit"){
                    ?>
                    <input type="hidden" name="Player" value="<?php echo $_GET['Player'];?>">
                    <button class="btn btn-warning" type="submit" name="submitBT">Save</button>
                    <?php
                  }else{
                    ?>
                    <button class="btn btn-warning" type="button" onClick="window.location='user_account_bank.php?Player=<?php echo $_GET['Player'];?>&action=edit';">Edit</button>
                    <?php
                  }?>
                  </div>
                </div>
          <!-- page end-->
        </div>
        </form>
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
  <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.js"></script>
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
          [1, 'asc']
        ]
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
