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
   0 =>'date', 
   1 =>'jackpot',
   2=> 'ball_numbers',
   3=> 'lucky_stars',
 );
 
 // getting total number records without any search
 $sql = "SELECT *";
 $sql.=" FROM iranian_milioner_history";
 $query=mysqli_query($conn, $sql) or die("iranian_milioner_results_ajax.php: get iranian_milioner_history");
 $totalData = mysqli_num_rows($query);
 $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
 
 
 $sql = "SELECT *";
 $sql.=" FROM iranian_milioner_history WHERE 1=1";
 if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
   $sql.=" AND ( `date` LIKE '".$requestData['search']['value']."%' ";    
   $sql.=" OR `jackpot` LIKE '".$requestData['search']['value']."%' ";
   $sql.=" OR `ball_numbers` LIKE '".$requestData['search']['value']."%' ";
   $sql.=" OR `lucky_stars` LIKE '".$requestData['search']['value']."%' )";

 }
 $query=mysqli_query($conn, $sql) or die("iranian_milioner_results_ajax.php: get iranian_milioner_history");
 $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
 $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
 /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
 $query=mysqli_query($conn, $sql) or die("iranian_milioner_results_ajax.php: get iranian_milioner_history");
 
 $data = array();
 while( $row=mysqli_fetch_array($query) ) {  // preparing an array

   $nestedData=array(); 
   $nestedData[] = $row["date"]." ".$row["time"];
   $nestedData[] = number_format($row["jackpot"]);
   $nestedData[] = $row["ball_numbers"];
   $nestedData[] = $row["lucky_stars"];
   $nestedData[] = "<center class=\"btAction\"><button class=\"btn btn-primary btn-xs\" title=\"Edit\" onClick=\"window.location='iranian_milioner_results_update.php?id=".$row["id"]."'\"><i class=\"fa fa-pencil\"></i></button><button class=\"btn btn-warning btn-xs\" title=\"Prize breakdown\" onClick=\"window.location='iranian_milioner_prize.php?id=".$row["id"]."&date=".$row["date"]."'\"><i class=\"fa fa-btc\"></i></button><button class=\"btn btn-danger btn-xs\" title=\"Delete\" onClick=\"window.location='iranian_milioner_results.php?id=".$row["id"]."&action=delete'\"><i class=\"fa fa-times\"></i></button>";

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