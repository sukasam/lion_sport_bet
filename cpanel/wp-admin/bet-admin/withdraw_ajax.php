<?php
 include_once("../../function/cpanel/app_top.php");
 include_once("../../_inc/config.php"); 
 include_once("../../function/poker_config.php");
 include_once("../../function/poker_api.php");

 /* Database connection start */

$conn = mysqli_connect($db_conn['host'], $db_conn['user'], $db_conn['pass'], $db_conn['database']) or die("Connection failed: " . mysqli_connect_error());
 
 // storing  request (ie, get/post) global array to a variable  
 $requestData= $_REQUEST;
 
 
 $columns = array( 
 // datatable column index  => database column name
   0 =>'id', 
   1 =>'player', 
   2=> 'amount',
   3=> 'date',
   4=> 'evoucher',
   5=> 'activation_code',
   6=> 'evoucher_amount',
   7=> 'status',
 );
 
 // getting total number records without any search
 $sql = "SELECT *";
 $sql.=" FROM withdraw_history WHERE withdraw_type='1'";
 $query=mysqli_query($conn, $sql) or die("withdraw_ajax.php: get withdraw_history");
 $totalData = mysqli_num_rows($query);
 $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
 
 
 $sql = "SELECT *";
 $sql.=" FROM withdraw_history WHERE withdraw_type='1'";
 if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
   $sql.=" AND ( player LIKE '".$requestData['search']['value']."%' ";   
   $sql.=" OR amount LIKE '".$requestData['search']['value']."%' ";
   $sql.=" OR date LIKE '".$requestData['search']['value']."%' ";
   $sql.=" OR evoucher LIKE '".$requestData['search']['value']."%' ";
   $sql.=" OR activation_code LIKE '".$requestData['search']['value']."%' ";
   $sql.=" OR evoucher_amount LIKE '".$requestData['search']['value']."%' )";

 }

 $query=mysqli_query($conn, $sql) or die("withdraw_ajax.php: get withdraw_history");
 $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
 $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
 /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
 $query=mysqli_query($conn, $sql) or die("withdraw_ajax.php: get withdraw_history");
 
 $data = array();
 while( $row=mysqli_fetch_array($query) ) {  // preparing an array

  if($row["evoucher_amount"] != ""){
    $evAmount = $row["evoucher_amount"]." USD";
  }else{
    $evAmount = "";
  }

  $btStatus = '';

  if($row['status'] == "1"){
    $btStatus = '<button class="btn btn-success" style="width: 100px;">Complated</button>';
  }else if($row['status'] == "1"){
    $btStatus = '<button class="btn btn-danger" style="width: 100px;">Cancel</button>';
  }else{
    $btStatus = '<button class="btn btn-primary" style="width: 100px;">Processing</button>';
  }

  $evCreateEV = "";
  if($row['evoucher'] == "" && $row['activation_code'] == "" && $row['status'] == "0"){
    $evCreateEV .= '<div class="col-md-5 text-left">';
    $evCreateEV .= ' <form name="frmEvoucher" id="frmEvoucher" action="withdraw_evoucher.php" method="post">';
    $evCreateEV .= '  <input type="hidden" name="amount" value="'.$row['amount'].'">';
    $evCreateEV .= '  <input type="hidden" name="player" value="'.$row['player'].'">';
    $evCreateEV .= '  <input type="hidden" name="id" value="'.$row['id'].'">';
    $evCreateEV .= '  <button class="btn btn-warning btn-xs" id="btCallEvoucher" type="button" title="E-Voucher" style="padding: 7px 13px;"><i class="fa fa-money"></i></button>';
    $evCreateEV .= ' </form>';
    $evCreateEV .= '</div>';
  }
  $ecAvtion = '';
  if($row['status'] == "0"){
    $ecAvtion .= '<div class="col-md-7 text-right">';
    $ecAvtion .= '  <div class="btn-group">';
    $ecAvtion .= '    <button type="button" class="btn btn-theme dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
    $ecAvtion .= '     Action <span class="caret"></span>';
    $ecAvtion .= '    </button>';
    $ecAvtion .= '    <ul class="dropdown-menu" role="menu" style="left: -81px;">';
    $ecAvtion .= '      <li><a href="withdraw.php?action=submit&status=1&id='.$row['id'].'">Approved</a></li>';
    $ecAvtion .= '   </ul>';
    $ecAvtion .= '  </div>';
    $ecAvtion .= '</div>';
    
  }else{
    $evCreateEV = '';
  }

   $nestedData=array(); 
   $nestedData[] = $row["player"];
   $nestedData[] = number_format($row["amount"]);
   $nestedData[] = "<center>".$row["date"]." ".$row['time']."</center>";
   $nestedData[] = "<center>".$row["evoucher"]."</center>";
   $nestedData[] = "<center>".$row["activation_code"]."</center>";
   $nestedData[] = "<center>".$evAmount."</center>";
   $nestedData[] = "<center>".$btStatus."</center>";
   $nestedData[] = "<center>".$ecAvtion." ".$evCreateEV."</center>";
   $data[] = $nestedData;
 }
 
 
 
 $json_data = array(
       "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
       "recordsTotal"    => intval( $totalData ),  // total number of records
       "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
       "data"            => $data   // total data array
       );
 
 echo json_encode($json_data);  // send data as json format
 
 ?>