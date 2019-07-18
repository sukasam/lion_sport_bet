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
   2 =>'amount',
   3=> 'date',
   4=> 'Type',
   5=> 'tran_id',
   6=> 'status',
 );
 
 // getting total number records without any search
 $sql = "SELECT *";
 $sql.=" FROM deposit_history WHERE deposit_type = 'Online Card'";
 $query=mysqli_query($conn, $sql) or die("deposit2_ajax.php: get deposit_history");
 $totalData = mysqli_num_rows($query);
 $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
 
 
 $sql = "SELECT *";
 $sql.=" FROM deposit_history WHERE deposit_type = 'Online Card'";
 if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
   $sql.=" AND ( player LIKE '".$requestData['search']['value']."%' ";    
   $sql.=" OR amount LIKE '".$requestData['search']['value']."%' ";
   $sql.=" OR date LIKE '".$requestData['search']['value']."%' ";
   $sql.=" OR tran_id LIKE '".$requestData['search']['value']."%' ";
   $sql.=" OR status LIKE '".$requestData['search']['value']."%' )";

 }
 $query=mysqli_query($conn, $sql) or die("deposit2_ajax.php: get deposit_history");
 $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
 $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
 /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
 $query=mysqli_query($conn, $sql) or die("deposit2_ajax.php: get deposit_history");
 
 $data = array();
 while( $row=mysqli_fetch_array($query) ) {  // preparing an array

   $nestedData=array(); 

   $buttonActionP = '';
   
   if($row["status"] == 1){
    $buttonAction = '<button class="btn btn-success" style="width: 150px;">Complated</button>';
    $buttonActionP = '';
   }else{
    $buttonAction = '<button class="btn btn-danger" style="width: 150px;">Payment failed</button>';

    $buttonActionP .= '<div class="btn-group">';
    $buttonActionP .= ' <button type="button" class="btn btn-theme dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
    $buttonActionP .= ' Action <span class="caret"></span>';
    $buttonActionP .= ' </button>';
    $buttonActionP .= ' <ul class="dropdown-menu" role="menu" style="left: -81px;">';
    $buttonActionP .= ' <li><a href="deposit2.php?action=submit&status=1&id='.$row['id'].'&Player='.$row['player'].'&amount='.$row['amount'].'">Complated</a></li>';
    $buttonActionP .= ' </ul>';
    $buttonActionP .= '</div>';
   }
 
   $nestedData[] = $row["player"];
   $nestedData[] = number_format($row["amount"]);
   $nestedData[] = "<center>".$row["date"]." ".$row['time']."</center>";
   $nestedData[] = "<center>".$row["tran_id"]."</center>";
   $nestedData[] = "<center class=\"btAction\">".$buttonAction."</center>";
   $nestedData[] = "<center class=\"btAction\">".$buttonActionP."</center>";

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