<?php  
    include_once("../../function/cpanel/app_top.php");
    
    if(isset($_GET['action']) && $_GET['action'] === "delete"){

      $array_where = array(    
        'id' => $db->CleanDBData($_GET['id']),
        );
      $ql = $db->Delete('iranian_milioner_history',$array_where);

      $array_whereD = array(    
        'history_id' => $db->CleanDBData($_GET['id']),
        );
      $qH = $db->Delete('iranian_milioner_prize',$array_whereD);

      header("Location:iranian_milioner_results.php");   
    }

    $configDT = $db->select("SELECT * FROM setting WHERE sid ='1' ORDER BY sid DESC");

    $date = date_create($configDT[0]['game_close']);
    $dayMach = date_format($date,"Y-m-d");

    $RecDataDrawHistory = $db->select("SELECT * FROM iranian_milioner_history WHERE date = '".$dayMach."'");
    
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
    <?php include_once("top_bar.php");?>
    <?php include_once("sidebar_menu.php");?>
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> IranianMilioner Results</h3>
        <?php
          if($RecDataDrawHistory[0]['id'] == ""){
            ?>
        <div><a href="iranian_milioner_results_add.php"><button class="btn btn-primary">Add Results</button></a></div></div><br>
        <?php
          }
        ?>
        <div class="row mb">

          <!-- page start-->
          <div class="content-panel" style="margin-left: 15px;margin-right: 15px;padding-left: 15px;padding-right: 15px;">
            <div class="adv-table">
              <table cellpadding="0" cellspacing="0" class="display responsive table table-bordered" id="hidden-table-info">
                <thead>
                  <tr>
                    <th>Date (Around)</th>
                    <th>Jackpot</th>
                    <th>Ball Numbers</th>
                    <th>Lucky Stars</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
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

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Delete User Account</h4>
          </div>
          <div class="modal-body">
          Are you sure you want to delete this account (<span id="userPlayer"></span>)?
          </div>
          <div class="modal-footer text-center">
            <button type="button" class="btn btn-primary udelBt">Yes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>

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

      // $( ".deleteBT" ).click(function() {
      //   var player = $(this).val();
      //   $("#userPlayer").text(player);
      //   $("#myModal").modal('show');
      // });

      // $( ".udelBt" ).click(function() {
      //   var player = $("#userPlayer").text();
      //   window.location.href = 'iranian_milioner_results.php?action=delete&user='+player;
      // });
      
      var dataTable = $('#hidden-table-info').DataTable( {
					"processing": true,
					"serverSide": true,
          "aaSorting": [
            [0, 'desc']
          ],
          "iDisplayLength": 25,
					"ajax":{
						url :"iranian_milioner_results_ajax.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".hidden-table-info-error").html("");
							$("#hidden-table-info").append('<tbody class="hidden-table-info-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#hidden-table-info_processing").css("display","none");
						
            }
					},
          "order": [[ 0, "desc" ]]
          ,initComplete: function() {
              $('#hidden-table-info_filter input').unbind();
              $('#hidden-table-info_filter input').bind('keyup', function(e) {
                  if(e.keyCode == 13) {
                    dataTable.search(this.value).draw();
                  }
              });
          },
				} );


    });
  </script>
</body>

</html>
