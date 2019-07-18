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
   1 =>'player', 
   2 => 'around',
   3 => 'date',
 );
 
 // getting total number records without any search
 $sql = "SELECT *";
 $sql.=" FROM bet_lotorry_play";
 $query=mysqli_query($conn, $sql) or die("bet_lotorry_play_ajax.php: get bet_lotorry_play");
 $totalData = mysqli_num_rows($query);
 $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
 
 
 $sql = "SELECT *";
 $sql.=" FROM bet_lotorry_play WHERE 1=1";
 if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
   $sql.=" AND ( `id` LIKE '".$requestData['search']['value']."%' ";   
   $sql.=" OR `player` LIKE '".$requestData['search']['value']."%' "; 
   $sql.=" OR `around` LIKE '".$requestData['search']['value']."%' ";
   $sql.=" OR `date` LIKE '".$requestData['search']['value']."%' )";

 }
 $query=mysqli_query($conn, $sql) or die("bet_lotorry_play_ajax.php: get bet_lotorry_play");
 $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
 $sql.=" ORDER BY id DESC LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
 /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
 $query=mysqli_query($conn, $sql) or die("bet_lotorry_play_ajax.php: get bet_lotorry_play");
 
 $data = array();
 $numRow = 1;
 while( $row=mysqli_fetch_array($query) ) {  // preparing an array

   $nestedData=array(); 
   $nestedData[] = $row["player"];
   $nestedData[] = date("D, Y-m-d", strtotime($row["date"]))." ".$row["time"];
   $nestedData[] = date("D, Y-m-d", strtotime($row["around"]));
   $nestedData[] = "<center><button class=\"btn btn-primary btn-xs\" title=\"Edit\" onclick=\"window.location='bet_lotorry_detail.php?Player=".$row["player"]."&id=".$row["id"]."'\"><i class=\"fa fa-gamepad\" aria-hidden=\"true\"></i></button></center>";
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