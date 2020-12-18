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
   0 =>'g_name', 
   1 =>'g_img',
 );
 
 // getting total number records without any search
 $sql = "SELECT *";
 $sql.=" FROM game_row";
 $query=mysqli_query($conn, $sql) or die("game_rowone_ajax.php: get game_row");
 $totalData = mysqli_num_rows($query);
 $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
 
 
 $sql = "SELECT *";
 $sql.=" FROM game_row WHERE `g_row` = '1'";
 if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
   $sql.=" AND ( g_name LIKE '".$requestData['search']['value']."%')";

 }
 $query=mysqli_query($conn, $sql) or die("game_rowone_ajax.php: get game_row");
 $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
 $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
 /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
 $query=mysqli_query($conn, $sql) or die("game_rowone_ajax.php: get game_row");
 
 $data = array();
 while( $row=mysqli_fetch_array($query) ) {  // preparing an array

   $nestedData=array(); 
 
   $nestedData[] = $row["g_name"];
   $nestedData[] = "<a href=\"".$row["g_link"]."\" target=\"_blank\"><img src=".FRONTSITE."/upload/game/".$row["g_img"]." height=\"150\"></a>";
   $nestedData[] = "<center class=\"btAction\"><button class=\"btn btn-primary btn-xs\" title=\"Edit\" onClick=\"window.location='game_rowone_edit.php?id=".$row["id"]."'\"><i class=\"fa fa-pencil\"></i></button><button class=\"btn btn-danger btn-xs\" title=\"Delete\" onClick=\"deleteGame('".$row["id"]."','".$row["g_name"]."','".$row["g_img"]."')\"><i class=\"fa fa-trash\"></i></button></center>";

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