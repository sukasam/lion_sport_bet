<?php  
    include_once("../../function/cpanel/app_top.php");

    if(!isset($_GET['status'])){
      header("Location:withdraw2_.php?status=3");
    }
    
    if($_GET['action'] == "changeStatus"){

      //  print_r($_POST);
      //  exit();

      $array_fields = array(
        'status' => $_POST['statusCh'],
        'comment' => $_POST['comment'],
        'comment_date'=> date("Y-m-d"),
        'comment_time'=> date("H:i:s"),
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

      header("Location:withdraw2_.php");

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
  


  
  $dateDayli = strtotime("-1 day");
  //echo "SELECT sum(amount) as sumAmount FROM withdraw_history WHERE withdraw_type='2' AND status = '1' AND comment_date BETWEEN '".date("Y-m-d",$dateDayli)." 00:00:00' AND '".date("Y-m-d",$dateDayli)." 23:59:59'";
  $dayliTotalAprove = $db->select("SELECT sum(amount) as sumAmount FROM withdraw_history WHERE withdraw_type='2' AND status = '1' AND comment_date BETWEEN '".date('Y-m-d',$dateDayli)." 00:00:00' AND '".date('Y-m-d',$dateDayli)." 23:59:59'");
  $dayliTotalAproveShow = number_format($dayliTotalAprove[0]['sumAmount']);

  // $dayliYes = $db->select("SELECT * FROM withdraw_history WHERE withdraw_type='2' AND status = '1' AND `comment_time` IS NULL AND `date` BETWEEN '2019-06-04 00:00:00' AND '2019-06-04 23:59:59'");
  // foreach ($dayliYes as $key => $value) {
  //   set_time_limit(0);
  //   // echo $value['id'];
  //   // exit();
  //   $array_fields = array(
  //     'comment_date'=> $value['date'],
  //     'comment_time'=> $value['time'],
  //   );
    
  //   $array_where = array(    
  //   'id' => $value['id'],
  //   );

  //   $q = $db->Update('withdraw_history', $array_fields, $array_where);
  // }


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
        <h3><i class="fa fa-angle-right"></i> Withdraw (Online Card)</h3>
        <div style="margin-bottom: 20px;"><a href="withdraw2_.php?status=1"><button class="btn btn-success">Total Amount : <?php echo $totalAmount;?></button></a> <a href="withdraw2_.php?status=0"><button class="btn btn-primary">Processing Amount : <?php echo $processAmount;?></button></a> <a href="withdraw2_.php?status=2"><button class="btn btn-danger">Cancel Amount : <?php echo $cancelAmount;?></button></a> <button class="btn btn-warning">Dayli Total Aprove (<?php echo date('Y-m-d',$dateDayli);?>) : <?php echo $dayliTotalAproveShow;?></button></div>
        <div class="row mb">

          <!-- page start-->
          <div class="content-panel" style="margin-left: 15px;margin-right: 15px;padding-left: 15px;padding-right: 15px;">
            <div class="adv-table">
              <table cellpadding="0" cellspacing="0" class="display responsive table table-bordered" id="hidden-table-info">
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
  <!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
    </div> -->

  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <!-- <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.js"></script> -->
  <!-- <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script> -->
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <!-- <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="lib/advanced-datatable/js/DT_bootstrap.js"></script> -->
  <!--common script for all pages-->
  <!-- <script src="lib/common-scripts.js"></script> -->

<script src="js/jquery.dataTables.min.js"></script>

  <!--script for this page-->
  <script type="text/javascript">


    $(document).ready(function() {

      console.log(<?php echo $_GET['status'];?>);

      var delayInMilliseconds = 500; 
      setTimeout(function() {
      //add your code here to execute

      var dataTable = $('#hidden-table-info').DataTable( {
					"processing": true,
					"serverSide": true,
          "iDisplayLength": 25,
					"ajax":{
						url :"withdraw2_ajax.php", // json datasource
						type: "post",  // method  , by default get
            data: "<?php echo $_GET['status'];?>",
						error: function(){  // error handling
							$(".hidden-table-info-error").html("");
							$("#hidden-table-info").append('<tbody class="hidden-table-info-error"><tr><th colspan="2">No data found in the server</th></tr></tbody>');
							$("#hidden-table-info_processing").css("display","none");
						
						}
          },
          "order": [[ 0, "desc" ]],
				} );

      }, delayInMilliseconds);

    });

    // $( "#target" ).click(function() {
    //   alert( "Handler for .click() called." );
    // });

    function getOnchange(status,id){
     //console.log(status+" "+id);
     
     $("#statusCh"+id).val(status);
     
     setTimeout(function(){ $("#frmWd"+id).submit(); }, 1500);
     
    }

  </script>
</body>

</html>
